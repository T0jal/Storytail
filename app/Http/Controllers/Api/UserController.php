<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\FileUpload;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try{
            $user = User::with('userType','bookFavourites','bookReads', 'books', 'subscription.plan', 'activityBooks')->get();

            return response()->json([
                'data'      => $user,
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
        $validator = Validator::make($request->all(), [
        'user_name' => 'required|max:50|unique:users',
        'email' => 'required|email|unique:users',
        'first_name' => 'required|max:50',
        'last_name' => 'required|max:50',
        'password' => 'required|confirmed|min:6'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['status' => false, 'errors' => $errors]);
        } else {
            try{
                $user = new User();
                $user->user_type_id             = 2;
                $user->first_name               = $request->first_name;
                $user->last_name                = $request->last_name;
                $user->user_name                = $request->user_name;
                $user->email                    = $request->email;
    //            $user->email_verified_at        = $request->email_verified_at;
                $user->password                 = Hash::make($request->password);
                //$user->user_photo_url           = 'dummie_image.jpeg';
                $user->save();
    
                // $user->books()->sync($request->books);
                // $user->book()->sync($request->book);
                // $user->activityBooks()->sync($request->activityBooks);
    
                return response()->json([
                    'data' => $user
                ], 201);
    
            }catch (Exception $exception) {
                return response()->json(['error' => $exception], 500);
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\user  $user
     * @return JsonResponse
     */
    public function show(user $user)
    {
        try{;
            $user = User::with('userType', 'book', 'books', 'subscription.plan', 'activityBooks')->find($user->id);

            return response()->json([
                'data'      => Auth::user(),
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
     * @param  \App\user  $user
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['status' => false, 'errors' => $errors]);
            } else {
                try{
                    //$user = new User();
                    $user = User::find($id);
                    //$user->user_type_id             = 2;
                    $user->first_name               = $request->first_name;
                    $user->last_name                = $request->last_name;
                    $user->email                    = $request->email;
                    
                    if($request->hasFile('image')){
                        $fileName = time().'.'.$request->image->extension();  
                        $request->image->move(public_path('images'), $fileName);
                        $user->user_photo_url = $fileName;
                    }
                    $user->save();
        
                    // $user->books()->sync($request->books);
                    // $user->book()->sync($request->book);
                    // $user->activityBooks()->sync($request->activityBooks);
        
                    return response()->json([
                        'data' => $user
                    ], 201);
        
                }catch (Exception $exception) {
                    return response()->json(['error' => $exception], 500);
                }
            }
    //     try{
    //         $u = User::find($id);

    //         $u->update($request->all());
    //             return response()->json([
    //                 'data'      => $u,
    //                 'message'   => 'Success'
    //             ], 200);
    //    }catch (Exception $exception) {
    //         return response()->json(['error' => $exception], 500);
    //     }


        // try{
        //     $user->update($request->all());

        //     return response()->json([
        //         'data'      => $user,
        //         'message'   => 'Success'
        //     ], 200);

        // }catch (Exception $exception) {
        //     return response()->json(['error' => $exception], 500);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $user
     * @return JsonResponse
     */
    public function destroy(user $user)
    {
        try{
            $user->delete();

            return response()->json([
                'message'   => 'Deleted with success'
            ], 205);

        }catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }
}
