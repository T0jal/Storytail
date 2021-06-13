<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;

class UserrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $users = User::all();
    //     return response()->json($users);
    // }

    public function currentUser(){
        return Auth::user();
    }

    public function getActivitiesFromUser(){
        $user = Auth::user();
        try{
            $result = DB::table('activity_book_user')
            ->where('user_id', $user->id)
            ->get();
            return response()->json([
                'data'      => $result,
                'message'   => 'Success'
            ], 200);
        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    public function bookUserRead($id){
        try{
            $user = Auth::user();
            $result = DB::table('book_user_read')
            ->where('book_id', $id)
            ->where('user_id', $user->id)->get();
            $result = (count($result)==0)?false:true;
            return response()->json([
                'data'=> $result
            ], 200);
        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    public function saveUserRead(Request $request){
        try{
            $user = Auth::user();
            $values = array('book_id' => $request->book_id,'user_id' => $user->id, 'rating'=> $request->rating, 'read_date' =>now(), 'created_at'=>now());
            DB::table('book_user_read')->insert($values);
            return response()->json([
                'message'=> 'success'
            ], 200);
        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }



    public function bookUserFavourite($id){
        try{
            $user = Auth::user();
            $result = DB::table('book_user_favourite')
            ->where('book_id', $id)
            ->where('user_id', $user->id)->get();
            $result = (count($result)==0)?false:true;
            return response()->json([
                'data'=> $result
            ], 200);
        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
    public function getBookUserFavourites(){
        try{
            $user = Auth::user();
            $result = DB::table('book_user_favourite')
            ->join('books', 'book_user_favourite.book_id', '=', 'books.id')
            ->where('book_user_favourite.user_id', $user->id)
            ->get();
            
            return response()->json([
                'data'=> $result
            ], 200);
        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    public function saveBookUserFavourite(Request $request){
        try{
            $user = Auth::user();
            $values = array('book_id' => $request->book_id,'user_id' => $user->id, 'created_at'=>now());
            $result = DB::table('book_user_favourite')
            ->where('book_id', $request->book_id)
            ->where('user_id', $user->id);
            if(count($result->get()) == 0){
                DB::table('book_user_favourite')->insert($values);
            }
            return response()->json([
                'message'=> 'success'
            ], 200);
        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    public function deleteBookUserFavourite($id){
        $user = Auth::user();
        $result = DB::table('book_user_favourite')
        ->where('book_id', $id)
        ->where('user_id', $user->id);
        if(count($result->get()) == 1){
            $result->delete();
            return 'deleted';
        }
    }
    

    public function saveOrDeleteActivity($id){
        $user = Auth::user();
        $result = DB::table('activity_book_user')
        ->where('activity_book_id', $id)
        ->where('user_id', $user->id);

        $values = array('activity_book_id' => $id,'user_id' => $user->id);

        if(count($result->get()) == 0){
            DB::table('activity_book_user')->insert($values);
            return 'inserted';
        }
        if(count($result->get()) == 1){
            $result->delete();
            return 'deleted';
        }
    }

    public function calcProgressBooks(){
        $user = Auth::user();
        
        //get all book read
        $bookUserRead = DB::table('book_user_read')
        ->join('books', 'book_user_read.book_id', '=', 'books.id')
        ->where('book_user_read.user_id', $user->id)->get();
        
        return response()->json($bookUserRead);
    }

    public function message(Request $request){
        // The message
        $message = $request->message;

        // In case any of our lines are larger than 70 characters, we should use wordwrap()
        $message = wordwrap($message, 70, "\r\n");

        // Send
        mail('teixeira_emanuel@hotmail.com', 'My Subject', $message);
        return response()->$message;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
