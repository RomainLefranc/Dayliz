<?php

namespace App\Http\Controllers;



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
        $examen = Examen::find($id_examen);
        if ($examen) {
            return view("activities.index", compact('examen'));
        }
    }

    public function listActivities( $id_examen){
        //$activities = DB::table('activities')->select('id','beginAt','endAt','title','description','state');

        $examen = Examen::find($id_examen);
        if ($examen) {
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
                'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù]+$/',
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
                'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù]+$/',
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
    public function destroy($id, $id_examen)
    {
        $examen = Examen::find($id);
        $activity = Activity::find($id_examen);

        if ($examen && $activity) {
            $activity->delete();
            return back();  
        }
    }

}
