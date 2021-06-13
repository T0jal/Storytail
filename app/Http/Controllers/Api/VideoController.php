<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Video;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $video = Video::with('book.user.userType')->get();

            return response()->json([
                'data'      => $video,
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
            $video = Video::create($request->all());

            return response()->json([
                'data'      => $video,
                'message'   => 'Success'
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\video  $video
     * @return JsonResponse
     */
    public function show(video $video)
    {
        try{
            $video = Video::with('book.user.userType')->find($video->id);

            return response()->json([
                'data'      => $video,
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
     * @param  \App\video  $video
     * @return JsonResponse
     */
    public function update(Request $request, video $video)
    {
        try{
            $video->update($request->all());

            return response()->json([
                'data'      => $video,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\video  $video
     * @return JsonResponse
     */
    public function destroy(video $video)
    {
        try{
            $video->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
