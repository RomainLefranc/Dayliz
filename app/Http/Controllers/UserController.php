<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Activity;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DataTables;
use Symfony\Component\VarDumper\Cloner\Data;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
        //return view('users.index',compact('users'));
    }

    public function listUser(Request $request){

        $users = DB::table('users')
        ->select('users.id as id','users.firstName','users.lastName','roles.name as role','promotions.name as promotion','users.state')
            ->join('roles','users.role_id','=','roles.id')
            ->join('promotions','users.promotion_id','=','promotions.id')
            ->get();

        return datatables()->of($users)
            ->addColumn('modifier',function($user){
                $btn = '<a href="/users/'.$user->id.'/edit"  class="btn btn-primary text-center"> Modifier </a> ';
                return $btn; 
            })
            ->addColumn('generate',function($user){
                $btn = '<a href="/users/'.$user->id.'/generateToken"  class="btn btn-primary text-center"> Générer un lien </a> ';
                return $btn; 
            })
            ->addColumn('activate',function($user){
                if ($user->state == 1)
                {  $btn = '<a href="users/' . $user->id . '/desactivate"  class="btn btn-danger"> Désactiver </a>';}
                else  {  $btn = '<a href="users/' . $user->id . '/activate"  class="btn btn-success"> Activer </a>';}
                  return $btn;
            })
            ->rawColumns(['modifier','generate','activate'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $promotions = Promotion::all();
        return view('users.create',compact('roles','promotions'));
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
            'promotion'=>'required',
            'role'=>'required'
        ]);
        
        if (Role::find($request->get('role')) != null) {
            $user = new User([
                'lastName'=> $request->get('lastName'),
                'firstName'=> $request->get('firstName'),
                'email'=> $request->get('email'),
                'birthDay'=> $request->get('birthDay'),
                'phoneNumber'=> $request->get('phone'),
                'promotion_id'=> $request->get('promotion'),
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

    public function generateToken($id)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < 6; $i++)
        {
        $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }

        $idUser = $id;
     
        $user = User::find($idUser);
        
        if($user)
        {
            $date_ = md5(Carbon::today().($user->id));

            $user->tokenRandom = $date_.md5($chaineAleatoire);
    
            $user->save();

            $qrcode = QrCode::size(200)->generate("20fac1385e50.ngrok.io/planning/".$user->tokenRandom);
            //$qrcode = QrCode::size(200)->generate(env('APP_URL_MOBILE'));
            
            //return ($qrcode);
        }

      
        //return redirect('/users');
        return back();

    }

    public function showActivities($token)
    {  
       
        $user = User::where('tokenRandom',$token)->get();
    
         //On vérifie que l'utilisateur est bien trouvé
        if ($user)
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
        $promotions = Promotion::all();
        if ($user) {
            return view('users.edit',compact('user','promotions'));
        }
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
        /* dd($request); */
        $user = User::find($id);
        if ($user) {
            
            /* $request->validate([
                'lastName' => 'required|min:3|max:255|regex:/^[A-Za-z]+$/',
                'firstName' => 'required|min:3|max:255|regex:/^[A-Za-z - é è ]+$/',
                'email'=> 'required|email',
                'phone'=>'required|regex:/^[0-9 - () ]+$/',
                'birthDay'=>'required',
                'promotion'=>'required'
            ]); */
            
            $user->lastName = $request->get('lastName');
            $user->firstName = $request->get('firstName');
            $user->email = $request->get('email');
            $user->promotion_id = $request->get('promotion');
            $user->phoneNumber = $request->get('phone');
            $user->birthDay = $request->get('birthDay');
            $user->save();
            return redirect()->route('users.index');        
        }
        return back();

    }

    public function desactivate($id){

        $user = User::find($id);
        if ($user) {

            $user->state = false;
            $user->save();
    
            return back();        
        }
        return back();        
    }
    
    public function activate($id){
        $user = User::find($id);
        if ($user) {
            
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
