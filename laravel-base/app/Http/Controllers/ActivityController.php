<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("activities.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9]+$/',
            // 'beginAt' => 'required|date_format:Y-m-d\TH:i:sP',
            // 'endAt' => 'required|date_format:Y-m-d\TH:i:sP',
            'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9]+$/'
        ]);

        $beginAt = Carbon::createFromFormat('d/m/Y H:i', $request->get('beginAt'))->format('Y-m-d H:i:s');
        $endAt = Carbon::createFromFormat('d/m/Y H:i', $request->get('endAt'))->format('Y-m-d H:i:s');

        $activity = new Activity([
            'title' => $request->get('title'),
            'beginAt' => $beginAt,
            'endAt' => $endAt,
            'description' => $request->get('description'),
            'state' => true
        ]);

        try {
            $activity->save();
        } catch (\Throwable $th) {
            dd($th);
        }

        return redirect('activities');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
