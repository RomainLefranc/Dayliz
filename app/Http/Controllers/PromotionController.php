<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamensResource;
use App\Http\Resources\PromotionResource;
use App\Models\Promotion;
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
        $promotions = Promotion::paginate(10);
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
     * @OA\Get(
     *      path="/promotions",
     *      operationId="getPromotions",
     *      tags={"Promotions"},

     *      summary="Obtenir la liste des promotions",
     *      description="Returns all Promotions",
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
    
    public function getPromotions()
    {
        $promotions = PromotionResource::collection(Promotion::all());
        return response($promotions,200);
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
    public function showPromotion($id)
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


    public function desactivate($id){

        $promotion = Promotion::findOrFail($id);
        $promotion->state = false;
        $promotion->save();
        return back();       
    }
    
    public function activate($id){
        $promotion = Promotion::findOrFail($id);
        $promotion->state = true;
        $promotion->save();
        return back();  

    }
}
