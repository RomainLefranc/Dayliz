<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();
        return view("activities.index", compact('activities'));
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
            'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù]+$/',
            'duree' => 'required',
            'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù\"\'!?,;.:()]+$/i'
        ]);

        $activity = new Activity([
            'title' => $request->get('title'),
            'duree' => $request->get('duree'),
            'description' => $request->get('description'),
            'state' => true
        ]);

        $activity->save();
        
        return redirect()->route('activities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            return $activity;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            return view('activities.edit', compact('activity'));        
        }
        return back();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            
            $request->validate([
                'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù]+$/',
                'duree' => 'required',
                'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù\"\'!?,;.:()]+$/i'
            ]);
    
            $activity->title = $request->get('title');
            $activity->duree = $request->get('duree');
            $activity->description = $request->get('description');
    
            $activity->save();
    
            return redirect()->route('activities.index');        
        }
        return back();


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

    public function desactivate($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
           
            $activity->state = false;
            $activity->save();
    
            return back();        
        }
        return back();        
    }

    public function activate($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            
            $activity->state = true;
            $activity->save();
    
            return back();        
        }
        return back();
    }

}
