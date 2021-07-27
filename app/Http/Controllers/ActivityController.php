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
        /*  dd($request->all()); */

        /* $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9]+$/',
            'beginAt' => 'required|date',
            'endAt' => 'required|date',
            'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9]+$/'
        ]); */
        $request->validate([
            'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù]+$/',
            'beginAt' => 'required|date',
            'endAt' => 'required|date|after:beginAt',
            'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù\"\'!?,;.:()]+$/i'
        ]);


        /* if ($validator->fails()) {
            $beginAt = Carbon::createFromFormat('d/m/Y H:i', $request->get('beginAt'))->format('Y-m-d H:i:s');
            $endAt = Carbon::createFromFormat('d/m/Y H:i', $request->get('endAt'))->format('Y-m-d H:i:s');
        } else {
            $beginAt = $request->get('beginAt');
            $endAt = $request->get('endAt');
        } */

        /* $activity = new Activity([
            'title' => $request->get('title'),
            'beginAt' => $beginAt,
            'endAt' => $endAt,
            'description' => $request->get('description'),
            'state' => true
        ]); */

        $activity = new Activity([
            'title' => $request->get('title'),
            'beginAt' => $request->get('beginAt'),
            'endAt' => $request->get('endAt'),
            'description' => $request->get('description'),
            'state' => true
        ]);

        try {
            $activity->save();
        } catch (\Throwable $th) {
            dd($th);
        }
        
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
                'beginAt' => 'required|date',
                'endAt' => 'required|date|after:beginAt',
                'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù\"\'!?,;.:()]+$/i'
            ]);
    
            $activity->title = $request->get('title');
            $activity->beginAt = $request->get('beginAt');
            $activity->endAt = $request->get('endAt');
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

    public function index_activity_user($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            
            $users = $activity->users()->get();
            return view('activities.users', compact('activity', 'users'));        
        }
        return back();

    }
    
    public function create_activity_user($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            
            $users = User::all();
    
            return view('activities.users_create', compact('activity', 'users'));        
        }
        return back();

    }

    public function store_activity_user($id, Request $request)
    {   
        $request->validate([
            'user'=>'required'
        ]);
        $user = User::find($request->get('user'));
        $activity = Activity::find($id);
        if ($activity && $user) {

            if (!$activity->users()->where('id', $user->id)->exists()) {
                $user->activities()->attach($activity->id);
            }

            return redirect()->route('activities.users.index' , $activity->id);        
        }
        return back();

    }

    public function delete_activity_user($activity_id, $user_id)
    {
        $user = User::find($user_id);
        $activity = Activity::find($activity_id);
        
        if ($activity && $user) {
            $activity->users()->detach($user->id);
        }
        return back();

    }
}
