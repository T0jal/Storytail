<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Page;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $page = Page::with('book.user.userType')->get();

            return response()->json([
                'data'      => $page,
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
            $page = Page::create($request->all());

            return response()->json([
                'data'      => $page,
                'message'   => 'Success'
            ], 201);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\page  $page
     * @return JsonResponse
     */
    public function show(page $page)
    {
        try{
            $page = Page::with('book.user.userType')->find($page->id);

            return response()->json([
                'data'      => $page,
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
     * @param  \App\page  $page
     * @return JsonResponse
     */
    public function update(Request $request, page $page)
    {
        try{
            $page->update($request->all());

            return response()->json([
                'data'      => $page,
                'message'   => 'Success'
            ], 200);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\page  $page
     * @return JsonResponse
     */
    public function destroy(page $page)
    {
        try{
            $page->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
