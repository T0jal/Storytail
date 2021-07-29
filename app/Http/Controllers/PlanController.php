<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::orderBy('id', 'desc')->paginate(10);

        return view('pages.plans.index', ['plans' => $plans]);
    }

    public function indexByIdAsc()
    {
        $plans = Plan::orderBy('id', 'asc')->paginate(10);

        return view('pages.plans.index', ['plans' => $plans]);
    }

    public function indexByNameAtoZ()
    {
        $plans = Plan::orderBy('name', 'asc')->paginate(10);

        return view('pages.plans.index', ['plans' => $plans]);
    }

    public function indexByNameZtoA()
    {
        $plans = Plan::orderBy('name', 'desc')->paginate(10);

        return view('pages.plans.index', ['plans' => $plans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.plans.create');
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
            'name'              =>'required',
            'price'             =>'required|numeric',
            'duration'          =>'numeric|nullable',
            'access_level'      =>'required'
        ]);

        $plan = new Plan();
        $plan->name              = $request->name;
        $plan->price             = $request->price;
        $plan->duration          = $request->duration;
        $plan->access_level      = $request->access_level;
        $plan->save();

        return redirect('/admin/plans')->with('status','Product created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('pages.plans.show', ['plan' => $plan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return view('pages.plans.edit', ['plan' => $plan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $this->validate($request, [
            'name'              =>'required',
            'price'             =>'required|numeric',
            'duration'          =>'numeric|nullable',
            'access_level'      =>'required'
        ]);

        $plan->name             = $request->name;
        $plan->price            = $request->price;
        $plan->duration         = $request->duration;
        $plan->access_level     = $request->access_level;
        $plan->save();

        return redirect('/admin/plans')->with('status','Item edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect('/admin/plans')->with('status','Item deleted successfully!');
    }
}
