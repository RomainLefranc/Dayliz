<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivitiesResource;
use App\Models\Examen;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_examen)
    {
        $examen = Examen::findOrFail($id_examen);
        $activities = Activity::where('examen_id', '=', $id_examen)->paginate(10);
        return view("activities.index", compact('activities', 'examen'));
    }

         /**
     * @OA\Get(
     *      path="/examens",
     *      operationId="getExamens",
     *      tags={"Examens"},

     *      summary="Get List Of Examens",
     *      description="Returns all examens",
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
    public function getActivities()
    {
        $activities = Activity::all();
        $result =  ActivitiesResource::collection($activities);
        return response($result, 200);
    }

    /**
     * @OA\Get(
     *      path="/activities/user/{iduser}",     
     *      operationId="getActivitiesUser",
     *      tags={"Users"},
     *      summary="Obtenir la liste d'activité d'un utilisateur",
     *      description="Obtenir la liste d'activité d'un utilisateur",
     *  @OA\Parameter(
     *      name="iduser",
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
    public function getActivitiesUser($iduser)
    {
        return Activity::where('user_id', '=', $iduser)->get();
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
    public function store(Request $request, $id_examen)
    {
        $examen = Examen::findOrFail($id_examen);

        $order = count($examen->activities) + 1;

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù. ]+$/',
            'duree' => 'required',
            'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù\"\'!?,;.:()]+$/i',
        ]);

        if ($validator->fails()) {
            return redirect()->route('activities.index', $examen->id);
        }

        $dureeArr = explode(':', $request->get('duree'));
        $duree = (intval($dureeArr[0]) * 3600) + (intval($dureeArr[1]) * 60);

        $activity = new Activity([
            'title' => $request->get('title'),
            'duree' => $duree,
            'order' => $order,
            'description' => $request->get('description'),
            'state' => true,
            'examen_id' => $examen->id
        ]);

        $activity->save();

        return redirect()->route('activities.index', $examen->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id_examen, $id)
    {
        $activity = Activity::findOrFail($id);
        return new ActivitiesResource($activity);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $id_examen)
    {
        $examen = Examen::findOrFail($id_examen);
        $activity = Activity::findOrFail($id);
        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_examen, $id)
    {

        $examen = Examen::findOrFail($id_examen);

        $activity = Activity::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3|max:255|regex:/^[A-Za-z0-9éàôèù. ]+$/',
            'duree' => 'required',
            'description' => 'required|min:3|max:255|regex:/^[A-Za-z0-9 éàôèù\"\'!?,;.:()]+$/i'
        ]);

        if ($validator->fails()) {
            dd($validator->errors());
            return redirect()->route('activities.index', $examen->id);
        }


        $dureeArr = explode(':', $request->get('duree'));
        $duree = (intval($dureeArr[0]) * 3600) + (intval($dureeArr[1]) * 60);

        $activity->title = $request->get('title');
        $activity->duree = $duree;
        $activity->description = $request->get('description');

        $activity->save();

        return redirect()->route('activities.index', $examen->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_examen)
    {
        $examen = Examen::findOrFail($id);
        $activity = Activity::findOrFail($id_examen);
        $activity->delete();
        return back();
    }
}
