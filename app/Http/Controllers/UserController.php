<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamensResource;
use App\Http\Resources\UsersResource;
use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Promotion;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('users.index');
        $users = User::paginate(10);
        return view('users.index',compact('users'));
    }

     /**
     * @OA\Get(
     *      path="/users",
     *      operationId="getUsers",
     *      tags={"Users"},

     *      summary="Get List Of Users",
     *      description="Returns all users",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */

    public function getUsers()
    {
        $users =  UsersResource::collection(User::all());
        return response($users,200);
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
            'birthDay'=> ['required', 'regex:/^(19|20)\d{2}\-(0?[1-9]|1[012])\-(0?[1-9]|[12][0-9]|3[01])+$/'],
            'promotion'=>'required',
            'role'=>'required'
        ]);
        $role = Role::findOrFail($request->get('role'));
        $promotion = Promotion::findOrFail($request->get('promotion'));
        $user = new User([
            'lastName'=> $request->get('lastName'),
            'firstName'=> $request->get('firstName'),
            'email'=> $request->get('email'),
            'birthDay'=> $request->get('birthDay'),
            'phoneNumber'=> $request->get('phone'),
            'promotion_id'=> $promotion->id,
            'role_id' => $role->id,
            'state'=> true
        ]);
        $user->save();
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($id)
    {
        $user = User::findOrFail($id);
        return new UsersResource($user);
    }

    public function generateToken($id)
    {
        $user = User::findOrFail($id);
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < 6; $i++)
        {
        $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }
        
        
        $date_ = md5(Carbon::today().($user->id));

        $user->tokenRandom = $date_.md5($chaineAleatoire);

        $user->save();

        $qrcode = QrCode::size(200)->generate("20fac1385e50.ngrok.io/planning/".$user->tokenRandom);
        //$qrcode = QrCode::size(200)->generate(env('APP_URL_MOBILE'));
        
        //return ($qrcode);

      
        //return redirect('/users');
        return back();

    }

    public function showActivities($token)
    {  
       
        $user = User::where('tokenRandom',$token)->firstOrFail();
        //On vérifie que l'utilisateur est bien trouvé
         
        //Variable pour tester la date
        $verif = md5(Carbon::today() . $user->id);

        //On vérifie que la date est ok
        if (substr_compare($token,$verif,0,strlen($verif)) == 0)
        {
            $dateNow = explode(' ',Carbon::now())[0];

            $activities = ExamensResource::collection($user->promotion->examens()->where('beginAt','like','%'.$dateNow.'%')->get());
            return $activities;
            
        }
        return response()->json('Token invalide');
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

        $user = User::findOrFail($id);
        $user->state = false;
        $user->save();
        return back();      
    }
    
    public function activate($id){
        $user = User::findOrFail($id);
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
