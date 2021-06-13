<?php

namespace App\Http\Controllers;

use App\ActivityImage;
use Illuminate\Http\Request;
use App\Activity;
use Illuminate\Support\Facades\File;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

//        $activities = Activity::orderBy('id', 'asc')->get()->all();
        $activities = Activity::withCount('activityImages')->orderBy('id', 'desc')->paginate(10);

        return view('pages.activities.index', ['activities' => $activities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activityImages = ActivityImage::all();

        return view('pages.activities.create', ['activityImages' => $activityImages]);
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
            'title'         => 'required',
            'description'   => 'required',
        ]);

        /*
        CREATING THE activity
        */

        $activity = new Activity();
        $activity->title            = $request->title;
        $activity->description      = $request->description;
        $activity->save();

        /*
        CREATING THE image(s)
        */
        if($request->image_url) {
            $counter = 1;
            $activityImagesFolderPath = 'app\\tmp\\activityImages\\' . '\\';

            foreach ($request->image_url as $image_url) {
                $activityImage = new activityImage();
                $activityImage->activity_id = $activity->id;
                $activityImage->title = $request->title . '_' . $counter;
                $activityImage->image_url = $image_url;
                $activityImage->save();

                $counter++;

                //Deleting the temporary files
                File::delete(storage_path($activityImagesFolderPath . $image_url));
            }
        }

        return redirect('/admin/activities')->with('status', 'Book created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        $nextActivityId = ($activity->id)+1;
        $nextActivity = Activity::where('id', $nextActivityId)->get()->first();
        if($nextActivity != null)
            $next = $nextActivityId;
        else
            $next = 0;

        $previousActivityId = ($activity->id)-1;
        $previousActivity = Activity::where('id', $previousActivityId)->get()->first();
        if($previousActivity != null)
            $previous = $previousActivityId;
        else
            $previous = 0;

        return view('pages.activities.show', ['activity' => $activity, 'next'=>$next, 'previous'=> $previous]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        return view('pages.activities.edit', ['activity' => $activity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        /*
        UPDATING THE activity
        */

        $activity->title            = $request->title;
        $activity->description      = $request->description;
        $activity->save();

        /*
        UPDATING THE image(s)
        */
        if($request->image_url[0] != null)
        {
            //Delete all the images.
            $oldImages = ActivityImage::where('activity_id', $activity->id)->get()->all();
            foreach($oldImages as $oldImage)
            {
                $oldImage->delete();
            }

            //Create the new images and delete the temporary files.
            $counter = 1;
            $activityImagesFolderPath = 'app\\tmp\\activityImages\\' . '\\';

            foreach ($request->image_url as $image_url) {
                $activityImage = new activityImage();
                $activityImage->activity_id = $activity->id;
                $activityImage->title = $request->title . '_img' . $counter;
                $activityImage->image_url = $image_url;
                $activityImage->save();

                $counter++;

                //Deleting the temporary files
                File::delete(storage_path($activityImagesFolderPath . $image_url));
            }
        }

        return redirect('/admin/activities')->with('status', 'Book edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect('/admin/activities')->with('status','Item deleted successfully!');
    }
}
