<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ActivityBook;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            //$activityBook = ActivityBook::with('book', 'activity')->get();
            //$activityBook = ActivityBook::all();
            $activityBook = ActivityBook::with('users:id')->get();
            return response()->json([
                'data'      => $activityBook,
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
            $activityBook = new ActivityBook();
            $activityBook->book_id          = $request->book_id;
            $activityBook->activity_id      = $request->activity_id;
            $activityBook->save();

            $activityBook->users()->sync($request->users);

            return response()->json([
                $activityBook->load('users')
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\activityBook  $activityBook
     * @return JsonResponse
     */
    public function show(activityBook $activityBook)
    {
        try{
            $activityBook = ActivityBook::with('book', 'activity')->find($activityBook->id);

            return response()->json([
                'data'      => $activityBook,
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
     * @param  \App\activityBook  $activityBook
     * @return JsonResponse
     */
    public function update(Request $request, activityBook $activityBook)
    {
        try{
            $activityBook->update($request->all());

            return response()->json([
                'data'      => $activityBook,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\activityBook  $activityBook
     * @return JsonResponse
     */
    public function destroy(activityBook $activityBook)
    {
        try{
            $activityBook->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
