<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamensResource;
use App\Http\Resources\PromotionResource;
use App\Models\Activity;
use App\Models\Examen;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ExamenController extends Controller
{
    /**
     * Display a promotioning of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examens = Examen::paginate(10);
        return view('examens.index', compact('examens'));
    }
    public function getExamens()
    {
        $result = ExamensResource::collection(Examen::all());
        return response($result, 200);
    }

    public function getExamensUser($iduser)
    {
        //On récupère l'id de la promotion de l'user
        $user = User::find($iduser);


        $promotion = $user->promotion_id;

        //On récupère les id des examens de cette promotion
        $examens = DB::table('examen_promotion')->select('examen_id')->where('promotion_id', '=', $promotion)->get();

        $results = [];

        foreach ($examens as $id) {
            $activities = Activity::where('examen_id', '=', $id->examen_id)->get();
            array_push($results, $activities);
        }

        return response($results, 200);
    }

    /**
     * @OA\Get(
     *      path="/examens/promo/{id}",     
     *      operationId="getExamensPromo",
     *      tags={"Examens"},
     *      summary="Obtenir la liste d'examens d'une promotion",
     *      description="Obtenir la liste d'examens d'une promotion",
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )),
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
    public function getExamensPromo($id)
    {
        return new PromotionResource(Promotion::findOrFail($id));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = Promotion::all();
        return view('examens.create', compact('promotions'));
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
            'name' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù ]+$/',
            'beginAt' => 'required|date',
            'endAt' => 'required|date|after:beginAt',
            'promotion' => 'required'
        ]);

        $examen = new Examen([
            'name' => $request->get('name'),
            'beginAt' => $request->get('beginAt'),
            'endAt' => $request->get('endAt'),
        ]);
        $examen->save();

        $promotions = $request->get('promotion');
        $examen->promotions()->attach($promotions);

        return redirect()->route('examens.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showExamen($id)
    {
        return new ExamensResource(Examen::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $examen = Examen::findOrFail($id);
        $promotions = Promotion::all();
        $cur_ids = [];
        foreach ($examen->promotions as $promotion) {
            $cur_ids[] = $promotion->id;
        }
        return view('examens.edit', compact('examen', 'promotions', 'cur_ids'));
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
        $examen = Examen::findOrFail($id);
        $request->validate([
            'name' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù ]+$/',
            'beginAt' => 'required|date',
            'endAt' => 'required|date|after:beginAt',
            'promotion' => 'required',
        ]);

        $examen->name = $request->get('name');
        $examen->beginAt = $request->get('beginAt');
        $examen->endAt = $request->get('endAt');

        $examen->save();

        $cur_ids = [];
        foreach ($examen->promotions as $promotion) {
            $cur_ids[] = $promotion->id;
        }
        $examen->promotions()->detach($cur_ids);
        $promotions = $request->get('promotion');
        $examen->promotions()->attach($promotions);

        return redirect()->route('examens.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examen = Examen::findOrFail($id);
        $examen->delete();
        return back();
    }
}
