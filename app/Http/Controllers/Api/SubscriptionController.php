<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Subscription;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $subscription = Subscription::with('user', 'plan')->get();

            return response()->json([
                'data'      => $subscription,
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
            $subscription = Subscription::create($request->all());

            return response()->json([
                'data'      => $subscription,
                'message'   => 'Success'
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\subscription  $subscription
     * @return JsonResponse
     */
    public function show(subscription $subscription)
    {
        try{
            $subscription = Subscription::with('user', 'plan')->find($subscription->id);

            return response()->json([
                'data'      => $subscription,
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
     * @param  \App\subscription  $subscription
     * @return JsonResponse
     */
    public function update(Request $request, subscription $subscription)
    {
        try{
            $subscription->update($request->all());

            return response()->json([
                'data'      => $subscription,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\subscription  $subscription
     * @return JsonResponse
     */
    public function destroy(subscription $subscription)
    {
        try{
            $subscription->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
