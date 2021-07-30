<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamensResource;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::all();
        return view('promotions.index',compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promotions.create');
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
            'name' => 'required|min:3|max:255|regex:/^[A-Za-z ]+$/'
        ]);
        $promotion = new Promotion([
            'name' => $request->get('name')
        ]);
        $promotion->save();
        return redirect()->route('promotions.index')->with('status', 'Promotion ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PromotionResource(Promotion::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        return view('promotions.edit',compact('promotion'));
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
        $promotion = Promotion::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3|max:255'
        ]);
        
        $promotion->name = $request->get('name');
        $promotion->save();
        
        return redirect()->route('promotions.index')->with('status', 'Promotion modifié'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function generateToken($id)
    {
        $promotion = Promotion::findOrFail($id);
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < 6; $i++){
            $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }
        $date_ = md5(Carbon::today().($promotion->id));
        $promotion->token = $date_.md5($chaineAleatoire);
        $promotion->save();

        //$qrcode = QrCode::size(200)->generate("20fac1385e50.ngrok.io/planning/".$user->tokenRandom);
        //$qrcode = QrCode::size(200)->generate(env('APP_URL_MOBILE'));
        
        //return ($qrcode);

      
        //return redirect('/users');
        return back();

    }

    public function showActivities($token)
    {  
        // récuperation de la promotion
        $promotion = Promotion::where('token',$token)->firstOrFail();
        $verif = md5(Carbon::today() . $promotion->id);
        $dateNow = explode(' ',Carbon::now())[0];

        if (substr_compare($token,$verif,0,strlen($verif)) == 0) {
            $examens = $promotion->examens()->where('beginAt','like','%'.$dateNow.'%')->get();
            return ExamensResource::collection($examens);
        }
    }
}
