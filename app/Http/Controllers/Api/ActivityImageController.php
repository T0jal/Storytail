<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ActivityImage;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $activityImage = ActivityImage::with('activity.activityImages')->get();

            return response()->json([
                'data'      => $activityImage,
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
            $activityImage = ActivityImage::create($request->all());

            return response()->json([
                'data'      => $activityImage,
                'message'   => 'Success'
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\activityImage  $activityImage
     * @return JsonResponse
     */
    public function show(activityImage $activityImage)
    {
        try{
            $activityImage = ActivityImage::with('activity.activityImages')->find($activityImage->id);

            return response()->json([
                'data'      => $activityImage,
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
     * @param  \App\activityImage  $activityImage
     * @return JsonResponse
     */
    public function update(Request $request, activityImage $activityImage)
    {
        try{
            $activityImage->update($request->all());

            return response()->json([
                'data'      => $activityImage,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\activityImage  $activityImage
     * @return JsonResponse
     */
    public function destroy(activityImage $activityImage)
    {
        try{
            $activityImage->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
