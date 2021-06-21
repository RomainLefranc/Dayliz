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
        return view("activities.index",compact('activities'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9]+$/',
            'beginAt' => 'required|date',
            'endAt' => 'required|date',
            'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9]+$/'
        ]);


        if ($validator->fails()) {
            $beginAt = Carbon::createFromFormat('d/m/Y H:i', $request->get('beginAt'))->format('Y-m-d H:i:s');
            $endAt = Carbon::createFromFormat('d/m/Y H:i', $request->get('endAt'))->format('Y-m-d H:i:s');
        } else {
            $beginAt = $request->get('beginAt');
            $endAt = $request->get('endAt');
        }

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

    public function desactivate($id){
        
        $activity = Activity::find($id);
        $activity->state = false;
        $activity->save();

        return back();
    }

    public function activate($id){
        
        $activity = Activity::find($id);
        $activity->state = true;
        $activity->save();

        return back();
    }

    public function assignActivityForm()
    {
        $users = User::all();
        $activities = Activity::all();

        return view('users.assignActivity',compact('users', 'activities'));
    }


    public function assignActivityToUser(Request $request) {
        $user = User::find($request->user_id);
        $activity = Activity::find($request->activity_id);    
        
        if ($user->activities()->where('id', $activity->id)->exists()) {
            redirect()->back()->withErrors("Activité déjà attribuée");
        } else {
            $user->activities()->attach($activity->id);
        }

        return back();
     }
     
     
}
