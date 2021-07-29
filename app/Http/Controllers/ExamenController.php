<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExamensResource;
use App\Models\Examen;
use App\Models\Promotion;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    /**
     * Display a promotioning of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examens = Examen::all();
        return view('examens.index',compact('examens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promotions = Promotion::all();
        return view('examens.create',compact('promotions'));
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
    public function show($id)
    {
        $examen = Examen::find($id);
        if ($examen) {
            return new ExamensResource($examen);
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
        $examen = Examen::find($id);
        
        if ($examen) {

            $promotions = Promotion::all();
            $cur_ids = [];
            foreach($examen->promotions as $promotion){
                $cur_ids[] = $promotion->id;
            }
            return view('examens.edit',compact('examen','promotions','cur_ids'));
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
        $examen = Examen::find($id);
        if ($examen) {
            
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
            foreach($examen->promotions as $promotion){
                $cur_ids[] = $promotion->id;
            }
            $examen->promotions()->detach($cur_ids);
            $promotions = $request->get('promotion');
            $examen->promotions()->attach($promotions);

            return redirect()->route('examens.index');        
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
        $examen = Examen::find($id);
        if ($examen) {
            $examen->delete();
            return back();
        }
    }
}
