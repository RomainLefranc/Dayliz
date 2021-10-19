<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivitiesResource;
use App\Http\Resources\ExamensResource;
use App\Http\Resources\PromotionResource;
use App\Http\Resources\UsersResource;
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


    public function getExamensUser($iduser)
    {
        //On récupère l'id de la promotion de l'user
        $user = User::where('state', '=', 1)->findOrFail($iduser);


        $promotion = $user->promotion_id;

        //On récupère les id des examens de cette promotion
        $examens = DB::table('examen_promotion')->select('examen_id')->where('promotion_id', '=', $promotion)->get();
        $examensDates = Examen::select('beginAt', 'endAt')
            ->where('id', $examens[0]->examen_id)
            ->first();

        $results = ["examTime" => json_encode($examensDates)];

        foreach ($examens as $id) {
            $activities = Activity::where('examen_id', '=', $id->examen_id)->get();
        }

        foreach ($activities as $activity) {
            array_push($results, $activity);
        }

        return response($results, 200);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = Promotion::where('state', '=', 1)->get();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $examen = Examen::findOrFail($id);
        $promotions = Promotion::where('state', '=', 1)->get();
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

      /**
     * @OA\Get(
     *      path="/examens",
     *      operationId="getExamens",
     *      tags={"Examens"},

     *      summary="Obtenir la liste des examens",
     *      description="Obtenir la liste des examens",
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
    public function getExamens()
    {
        $result = ExamensResource::collection(Examen::all());
        return response($result, 200);
    }
    /**
     * @OA\Get(
     *      path="/examens/{id}",     
     *      operationId="showExamen",
     *      tags={"Examens"},
     *      summary="Obtenir un examen",
     *      description="Obtenir un examen",
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
    public function showExamen($id)
    {
        return new ExamensResource(Examen::findOrFail($id));
    }

    /**
     * @OA\Get(
     *      path="/examens/{id}/promotion",     
     *      operationId="showExamenPromotion",
     *      tags={"Examens"},
     *      summary="Obtenir les promotions d'un examen",
     *      description="Obtenir les promotions d'un examen",
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
    public function showExamenPromotion($id) {
        $examen = Examen::findOrFail($id);
        $promotion = $examen->promotions->where('state', '=', 1)->get();
        return PromotionResource::collection($promotion);
    }
    /**
     * @OA\Get(
     *      path="/examens/{id}/activities",     
     *      operationId="showExamenActivities",
     *      tags={"Examens"},
     *      summary="Récupérer les activités d'un examen",
     *      description="Récupérer les activités d'un examen",
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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
    public function showExamenActivities($id) {
        $examen = Examen::findOrFail($id);
        $activities = $examen->activities()->where('state', '=', 1)->get();
        return ActivitiesResource::collection($activities);
    }
    /**
     * @OA\Get(
     *      path="/examens/{id}/users",     
     *      operationId="showExamenUsers",
     *      tags={"Examens"},
     *      summary="Récupérer les utilisateurs d'un examen",
     *      description="Récupérer les utilisateurs d'un examen",
     *  @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      @OA\Schema(
     *           type="integer"
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

    public function showExamenUsers($id){
        $users = User::join('promotions','users.promotion_id', '=', 'promotions.id')
            ->join('examen_promotion','promotions.id', '=', 'examen_promotion.promotion_id')
            ->join('examens','examen_promotion.examen_id', '=', 'examens.id')
            ->where('examens.id','=',$id)
            ->get('users.*');
        /* dd($users); */
        return UsersResource::collection($users);
    }
}
