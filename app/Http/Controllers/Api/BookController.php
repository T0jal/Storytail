<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Book;
use App\ActivityBook;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    private static function queryBuild($type, $order){
        $order = ($order == 'desc')? 'desc': 'asc';
        switch ($type) {
            case 'new':
                return Book::orderBy('id',$order)->paginate(8);
            break;
            case 'picks':
            # code...
            break;
            case 'popular':
                return Book::withCount('userFavourites')->orderBy('user_favourites_count', $order)->paginate(8);
            break;
            default:
                return Book::orderBy($type, $order)->paginate(8);
            break;
        }
    }
    public function sorting(Request $request){
        $type = request('type') ?? 'id';
        $order = request('order') ?? 'desc';
        $book = $this->queryBuild($type, $order);

    //return request('sort');
        return response()->json([
        'data'      => $book,
        'message'   => 'Success'
        ], 200);
    }

    public function search(Request $request){
        $searchTerm = request('s');
        $result = Book::query()
        ->where('title', 'LIKE', "%{$searchTerm}%") 
        ->orWhere('description', 'LIKE', "%{$searchTerm}%") 
        ->get();

        return response()->json([
            'data'      => $result,
            'message'   => 'Success'
        ], 200);
    }

    public function index()
    {
        try{
            //$book = Book::with('pages', 'video', 'user', 'authors.books','activityBooks.activity', 'userFavourites', 'userReads')->paginate(4);
            $book = Book::with('userFavourites')->paginate(8);
            return response()->json([
                'data'      => $book,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try{
            $book = new Book();
            $book->user_id          = $request->user_id;
            $book->title            = $request->title;
            $book->description      = $request->description;
            $book->cover_url        = $request->cover_url;
            $book->read_time        = $request->read_time;
            $book->age_group        = $request->age_group;
            $book->is_active        = $request->is_active;
            $book->access_level     = $request->access_level;
            $book->save();

            $book->authors()->sync($request->authors);
            $book->userFavourites()->sync($request->users);
            $book->userReads()->sync($request->users);

            return response()->json([
                $book->load('authors', 'user')
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
//        return $request;
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\book  $book
     * @return JsonResponse
     */
    public function show(book $book)
    {
        try{
            $book = Book::with('userReads','pages', 'video', 'authors.books', 'activityBooks.activity.activityImages')->find($book->id);

         //'userFavourites', 'userReads'

            return response()->json([
                'data'      => $book,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\book  $book
     * @return JsonResponse
     */
    public function update(Request $request, book $book)
    {
        try{
            $book->update($request->all());

            return response()->json([
                'data'      => $book,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\book  $book
     * @return JsonResponse
     */
    public function destroy(book $book)
    {
        try{
            $book->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
