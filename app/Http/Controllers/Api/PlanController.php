<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Plan;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $plan = Plan::with('subscriptions.user')->get();

            return response()->json([
                'data'      => $plan,
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
            $plan = Plan::create($request->all());

            return response()->json([
                'data'      => $plan,
                'message'   => 'Success'
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\plan  $plan
     * @return JsonResponse
     */
    public function show(plan $plan)
    {
        try{
            $plan = Plan::with('subscriptions.user')->find($plan->id);

            return response()->json([
                'data'      => $plan,
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
     * @param  \App\plan  $plan
     * @return JsonResponse
     */
    public function update(Request $request, plan $plan)
    {
        try{
            $plan->update($request->all());

            return response()->json([
                'data'      => $plan,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\plan  $plan
     * @return JsonResponse
     */
    public function destroy(plan $plan)
    {
        try{
            $plan->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
