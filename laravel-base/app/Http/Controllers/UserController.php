<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'lastName' => 'required|min:3|max:255|regex:/^[A-Za-z]+$/',
            'firstName' => 'required|min:3|max:255|regex:/^[A-Za-z - é è ]+$/',
            'email'=> 'required|email',
            'phone'=>'required|regex:/^[0-9 - () ]+$/',
            'birthDay'=>'required',
            'promotion'=>'required|regex:/^[A-Za-z0-9- ]+$/',
        ]);
 
        $user = new User([
            'lastName'=> $request->get('lastName'),
            'firstName'=> $request->get('firstName'),
            'email'=> $request->get('email'),
            'birthDay'=> $request->get('birthDay'),
            'phoneNumber'=> $request->get('phone'),
            'promotion'=> $request->get('promotion'),
            'role_id' => 1,
            'state'=> true
        ]);

    

        $user->save();

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'lastName' => 'required|min:3|max:255|regex:/^[A-Za-z]+$/',
            'firstName' => 'required|min:3|max:255|regex:/^[A-Za-z - é è ]+$/',
            'email'=> 'required|email',
            'phone'=>'required|regex:/^[0-9 - () ]+$/',
            'birthDay'=>'required',
            'promotion'=>'required|regex:/^[A-Za-z0-9- ]+$/',
        ]);

        $user->lastName = $request->get('lastName');
        $user->firstName = $request->get('firstName');
        $user->email = $request->get('email');
        $user->phoneNumber = $request->get('phone');
        $user->birthDay = $request->get('birthDay');
        $user->promotion = $request->get('promotion');

        $user->save();
        return redirect('/users');

    }

    public function desactivate($id){
        
        $user = User::find($id);
        $user->state = false;
        $user->save();

        return back();
    }
    
    public function activate($id){

        $user = User::find($id);
        $user->state = true;
        $user->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
