<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UserType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $userType = UserType::with('users')->get();

            return response()->json([
                'data'      => $userType,
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
            $userType = UserType::create($request->all());

            return response()->json([
                'data'      => $userType,
                'message'   => 'Success'
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\userType  $userType
     * @return JsonResponse
     */
    public function show(userType $userType)
    {
        try{
            $userType = UserType::with('users')->find($userType->id);

            return response()->json([
                'data'      => $userType,
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
     * @param  \App\userType  $userType
     * @return JsonResponse
     */
    public function update(Request $request, userType $userType)
    {
        try{
            $userType->update($request->all());

            return response()->json([
                'data'      => $userType,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\userType  $userType
     * @return JsonResponse
     */
    public function destroy(userType $userType)
    {
        try{
            $userType->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
