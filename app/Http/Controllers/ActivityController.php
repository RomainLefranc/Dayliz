<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivitiesResource;
use DataTables;
use App\Models\User;
use App\Models\Examen;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_examen)
    {
        $examen = Examen::findOrFail($id_examen);
        return view("activities.index", compact('examen'));
    }

    public function getActivities()
    {
        $activities = Activity::all();
        $result =  ActivitiesResource::collection($activities);

        return response($result,200);
    }

    public function listActivities( $id_examen){
        //$activities = DB::table('activities')->select('id','beginAt','endAt','title','description','state');

        $examen = Examen::findOrFail($id_examen);
        $activities = $examen->activities;
            
        return datatables()->of($activities)
            ->addColumn('action',function($activity){
                $btn = '';
                $btn .= '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formEditModal" data-exam="'.$activity->examen_id.'" data-id="'.$activity->id.'" onclick="getData(this)">Modifier</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
                        
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
        $examen = Examen::findOrFail($id_examen);
        $request->validate([
            'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù ]+$/',
            'duree' => 'required|date_format:H:i',
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id_examen,$id)
    {
        $activity = Activity::findOrFail($id);
        return new ActivitiesResource($activity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit($id , $id_examen)
    {
        $examen = Examen::findOrFail($id_examen);
        $activity = Activity::findOrFail($id);
        return view('activities.edit', compact('activity'));        
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
        $examen = Examen::findOrFail($id_examen);
        $activity = Activity::findOrFail($id);
        $request->validate([
            'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù ]+$/',
            'duree' => 'required|date_format:H:i',
            'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù\"\'!?,;.:()]+$/i'
        ]);

        $activity->title = $request->get('title');
        $activity->duree = $request->get('duree');
        $activity->description = $request->get('description');

        $activity->save();

        return redirect()->route('activities.index',$examen->id);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_examen)
    {
        $examen = Examen::findOrFail($id);
        $activity = Activity::findOrFail($id_examen);
        $activity->delete();
        return back();
    }

}
