<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Activity;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $activity = Activity::with('activityImages')->get();

            return response()->json([
                'data'      => $activity,
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
            $activity = Activity::create($request->all());

            return response()->json([
                'data'      => $activity,
                'message'   => 'Success'
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\activity  $activity
     * @return JsonResponse
     */
    public function show(activity $activity)
    {
        try{
            $activity = Activity::with('activityImages')->find($activity->id);

            return response()->json([
                'data'      => $activity,
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
     * @param  \App\activity  $activity
     * @return JsonResponse
     */
    public function update(Request $request, activity $activity)
    {
        try{
            $activity->update($request->all());

            return response()->json([
                'data'      => $activity,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\activity  $activity
     * @return JsonResponse
     */
    public function destroy(activity $activity)
    {
        try{
            $activity->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
