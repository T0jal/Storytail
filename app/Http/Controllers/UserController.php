<?php

namespace App\Http\Controllers;

use App\User;
use App\Plan;
use App\UserType;
use App\Subscription;
use App\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    public function indexByIdAsc()
    {
        $users = User::orderBy('id', 'asc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    public function indexByNameAtoZ()
    {
        $users = User::orderBy('last_name', 'asc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    public function indexByNameZtoA()
    {
        $users = User::orderBy('last_name', 'desc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    public function indexByUsernameAtoZ()
    {
        $users = User::orderBy('user_name', 'asc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    public function indexByUsernameZtoA()
    {
        $users = User::orderBy('user_name', 'desc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    public function indexByEmailAtoZ()
    {
        $users = User::orderBy('email', 'asc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    public function indexByEmailZtoA()
    {
        $users = User::orderBy('email', 'desc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    public function indexByUserTypeAtoZ()
    {
        $users = User::orderBy('user_type_id', 'asc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    public function indexByUserTypeZtoA()
    {
        $users = User::orderBy('user_type_id', 'desc')->paginate(20);

        return view('pages.users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $plans = Plan::orderBy('name', 'asc')->get();
        $user_types = UserType::all();

        return view('pages.users.create', ['plans' => $plans, 'user_types' => $user_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_type_id'      =>'required',
            'first_name'        =>'required',
            'last_name'         =>'required',
            'user_name'         =>'required|unique:users',
            'email'             =>'required|unique:users',
            'password'          =>'required',
            //'user_photo_url'    =>'required'
        ]);

        //Creating the User
        $user = new User();
        $user->user_type_id     = $request->user_type_id;
        $user->first_name       = $request->first_name;
        $user->last_name        = $request->last_name;
        $user->user_name        = $request->user_name;
        $user->email            = $request->email;
        $user->password         = Hash::make($request->password);
        $user->remember_token   = Str::random(10);
        if($request->user_photo_url)
        {
            $temporaryFile          = TemporaryFile::where('folder', $request->user_photo_url)->first();
            $user->user_photo_url   = $temporaryFile->filename;
        }
        else
        {
            $user->user_photo_url   = 'no_photo.jpg';
        }
        $user->save();

        //Creating the subscription
        $subscription               = new Subscription();
        $subscription->user_id      = $user->id;
        $subscription->plan_id      = $request->plan_id;
        $subscription->start_date   = now();

            // Grabbing the plan's duration to calculate the end date of the subscription
        $plan = Plan::where('id', $subscription->plan_id)->get()->first();
        if($plan->duration != 0) //Because the Free Plan has no duration = infinite and the end_date of the Subscription can be null
        {
            $duration = strval($plan->duration);
            $endDate = now();
            date_add($endDate, date_interval_create_from_date_string($duration.'days'));
            $subscription->end_date     = $endDate;
        }

        $subscription->save();

        //Deleting the temporary image file
        if($request->user_photo_url)
        {
            $image = $temporaryFile->filename;
            $folderPath = 'app\\tmp\\userPhoto\\' . $temporaryFile->folder . '\\';
            File::delete(storage_path($folderPath . $image));
            rmdir(storage_path($folderPath));
        }

        return redirect('/admin/users')->with('status','Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $subscription = Subscription::where('user_id', $user->id)->get()->first();
        $user_types = UserType::where('id', $user->user_type_id)->get();

        $nextUserId = ($user->id)+1;
        $nextUser = User::where('id', $nextUserId)->get()->first();
        if($nextUser != null)
            $next = $nextUserId;
        else
            $next = 0;

        $previousUserId = ($user->id)-1;
        $previousUser = User::where('id', $previousUserId)->get()->first();
        if($previousUser != null)
            $previous = $previousUserId;
        else
            $previous = 0;

        return view('pages.users.show', ['user' => $user, 'subscription' => $subscription, 'user_types' => $user_types, 'next'=>$next, 'previous'=> $previous]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user_types     = UserType::all();
        $plans          = Plan::all()->sortBy('name');
        $subscription   = Subscription::where('user_id', $user->id)->get()->first();

        return view('pages.users.edit', ['user' => $user, 'subscription' => $subscription, 'user_types' => $user_types, 'plans' => $plans]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'user_type_id'      =>'required',
            'first_name'        =>'required',
            'last_name'         =>'required',
            'user_name'         =>['required', Rule::unique('users')->ignore($user->id),],
            'email'             =>['required', Rule::unique('users')->ignore($user->id),],
//            'password'          =>'required',
            //'user_photo_url'    =>'required'
        ]);

        /*
        UPDATING THE user
        */
        $user->user_type_id         = $request->user_type_id;
        $user->first_name           = $request->first_name;
        $user->last_name            = $request->last_name;
        $user->user_name            = $request->user_name;
        $user->email                = $request->email;

        if($user->password)
        {
            $user->password         = Hash::make($request->password);
        }

        if($request->user_photo_url != null)
        {
            $temporaryFile          = TemporaryFile::where('folder', $request->user_photo_url)->first();
            $user->user_photo_url   = $temporaryFile->filename;
        }

        $user->save();

        //Updating the subscription
        $subscription   = Subscription::where('user_id', $user->id)->get()->first();
        if($subscription->plan_id != $request->plan_id)
        {
            $subscription->plan_id      = $request->plan_id;
            $subscription->start_date   = now();

            // Grabbing the plan's duration to calculate the end date of the subscription
            $plan = Plan::where('id', $subscription->plan_id)->get()->first();
            if($plan->duration != 0) //Because the Free Plan has no duration = infinite and the end_date of the Subscription can be null
            {
                $duration = strval($plan->duration);
                $endDate = now();
                date_add($endDate, date_interval_create_from_date_string($duration.'days'));
                $subscription->end_date     = $endDate;
            }
        }
        $subscription->save();

        //Deleting the temporary image file
        if($request->user_photo_url)
        {
            $image = $temporaryFile->filename;
            $folderPath = 'app\\tmp\\userPhoto\\' . $temporaryFile->folder . '\\';
            File::delete(storage_path($folderPath . $image));
            rmdir(storage_path($folderPath));
        }

        return redirect('/admin/users')->with('status','User edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users')->with('status','Item deleted successfully!');
    }
}
