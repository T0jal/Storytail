<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Author;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $author = Author::with('books')->get();

            return response()->json([
                'data'      => $author,
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
            $author = new Author();
            $author->first_name         = $request->first_name;
            $author->last_name          = $request->last_name;
            $author->description        = $request->description;
            $author->author_photo_url   = $request->author_photo_url;
            $author->nationality        = $request->nationality;
            $author->save();

            $author->books()->sync($request->books);

            return response()->json([
                $author->load('books')
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\author  $author
     * @return JsonResponse
     */
    public function show(author $author)
    {
        try{
            $author = Author::with('books')->find($author->id);

            return response()->json([
                'data'      => $author,
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
     * @param  \App\author  $author
     * @return JsonResponse
     */
    public function update(Request $request, author $author)
    {
        try{
            $author->update($request->all());

            return response()->json([
                'data'      => $author,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\author  $author
     * @return JsonResponse
     */
    public function destroy(author $author)
    {
        try{
            $author->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
