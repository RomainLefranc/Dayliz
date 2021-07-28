<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Examen;
use Illuminate\Http\Request;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_examen)
    {
        $examen = Examen::find($id_examen);
        return view("activities.index", compact('examen'));
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
    public function store(Request $request, $id_examen)
    {
        $examen = Examen::find($id_examen);
        if ($examen) {
            $request->validate([
                'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù]+$/',
                'duree' => 'required',
                'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù\"\'!?,;.:()]+$/i'
            ]);
    
            $activity = new Activity([
                'title' => $request->get('title'),
                'duree' => $request->get('duree'),
                'description' => $request->get('description'),
                'state' => true,
                'examen_id' => $examen->id
            ]);
    
            $activity->save();
            
            return redirect()->route('activities.index', $examen->id);        
        }

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
    public function edit($id , $id_examen)
    {
        $examen = Examen::find($id_examen);
        $activity = Activity::find($id);
        if ($examen && $activity) {
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
    public function update(Request $request, $id, $id_examen)
    {
        $examen = Examen::find($id_examen);
        $activity = Activity::find($id);
        if ($examen && $activity) {
            
            $request->validate([
                'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù]+$/',
                'duree' => 'required',
                'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù\"\'!?,;.:()]+$/i'
            ]);
    
            $activity->title = $request->get('title');
            $activity->duree = $request->get('duree');
            $activity->description = $request->get('description');
    
            $activity->save();
    
            return redirect()->route('activities.index',$examen->id);        
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

    public function desactivate($id, $id_examen)
    {
        $examen = Examen::find($id_examen);
        $activity = Activity::find($id);
        if ($examen && $activity) {
           
            $activity->state = false;
            $activity->save();
    
            return back();        
        }
        return back();        
    }

    public function activate($id, $id_examen)
    {
        $examen = Examen::find($id_examen);
        $activity = Activity::find($id);
        if ($examen && $activity) {
            
            $activity->state = true;
            $activity->save();
    
            return back();        
        }
        return back();
    }

}
