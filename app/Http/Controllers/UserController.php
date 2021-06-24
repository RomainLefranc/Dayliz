<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $roles = Role::all();
        return view('users.create',compact('roles'));
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
            'role'=>'required'
        ]);
        
        if (Role::find($request->get('role')) != null) {
            $user = new User([
                'lastName'=> $request->get('lastName'),
                'firstName'=> $request->get('firstName'),
                'email'=> $request->get('email'),
                'birthDay'=> $request->get('birthDay'),
                'phoneNumber'=> $request->get('phone'),
                'promotion'=> $request->get('promotion'),
                'role_id' => $request->get('role'),
                'state'=> true
            ]);

            $user->save();
            return redirect()->route('users.index');
        } else {
            return back()->withError('Rôle invalide');
        }
       
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    public function generateToken(Request $request)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < 6; $i++)
        {
        $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }

        $idUser = $request->id;
     
        $user = User::find($idUser);
        
        if($user)
        {
            $date_ = md5(Carbon::today().($user->id));

            $user->tokenRandom = $date_.md5($chaineAleatoire);
    
            $user->save();
        }

      
        return redirect('/users');

    }

    public function showActivities($token)
    {  
       
        $user = User::where('tokenRandom',$token)->get();
    
         //On vérifie que l'utilisateur est bien trouvé
        if (count($user) > 0)
        {
             //Variable pour tester la date
            $verif = md5(Carbon::today() . $user[0]->id);

            //On vérifie que la date est ok
            if (substr_compare($token,$verif,0,strlen($verif)) == 0)
            {
                $dateNow = explode(' ',Carbon::now())[0];
                $activities = $user[0]->activities()->where('beginAt','like','%'.$dateNow.'%')->where('state', '=', true)->get();

                //$activities = $user[0]->activities()->get();
                return ($activities);
               
            }
            else 
            {
                return ([]);
            }
        }

        else
        {
            return ([]);
        }
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
        if (User::find($id) != null) {
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
            return redirect()->route('users.index');        
        }
        return back();

    }

    public function desactivate($id){

        if (User::find($id) != null) {
            $user = User::find($id);
            $user->state = false;
            $user->save();
    
            return back();        
        }
        return back();        
    }
    
    public function activate($id){
        if (User::find($id) != null) {
            $user = User::find($id);
            $user->state = true;
            $user->save();
    
            return back();        
        }
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
