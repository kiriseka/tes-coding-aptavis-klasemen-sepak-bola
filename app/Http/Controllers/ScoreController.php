<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ScoreController extends Controller
{

    // Add Single Score
    public function index()
    {

        $clubs = Club::get('name');
        return view('scoreInput', [
            'clubs' => $clubs,
        ]);
    }

    public function addScore(Request $request)
    {
        $tim1 = Club::where('name', $request['tim1'])->first();
        $tim2 = Club::where('name', $request['tim2'])->first();
        $id_tim1 = $tim1['id'];
        $id_tim2 = $tim2['id'];
        $request['id_tim1'] = $id_tim1;
        $request['id_tim2'] = $id_tim2;

        $validatedData = $request->validate([
            'id_tim1' => [
                'required',
                Rule::unique('scores')->where(function ($query) use ($request) {
                    return $query->where('id_tim2', $request->input('id_tim2'));
                })
            ],
            'id_tim2' => 'required',
            'skor_tim1' => 'required',
            'skor_tim2' => 'required',
        ]);

        if ($id_tim1 == $id_tim2) {
            return redirect()->back()->with('error', 'Cannot pick the same team!');
        }

        Score::create($validatedData);
        return redirect()->back()->with('success','Sucessfully added!');
    }



    // Add Multiple Score
    public function multipleSCore()
    {

        $clubs = Club::get('name');
        return view('multipleScoreInput', [
            'clubs' => $clubs,
        ]);
    }

    public function addMultipleScore(Request $request){

        $scores = $request->all('scores');
        $scores = $scores['scores'];

        foreach ($scores as $score) {
            $tim1 = Club::where('name', $score['tim1'])->first();
            $tim2 = Club::where('name', $score['tim2'])->first();
            $id_tim1 = $tim1['id'];
            $id_tim2 = $tim2['id'];
            $score['id_tim1'] = $id_tim1;
            $score['id_tim2'] = $id_tim2;

            if ($id_tim1 == $id_tim2) {
                return redirect()->back()->with('error', 'Cannot pick the same team!');
            }
            
            $rules = [
                'id_tim1' => [
                    'required',
                    Rule::unique('scores')->where(function ($query) use ($score) {
                        return $query->where('id_tim2', $score['id_tim2']);
                    })
                ],
                'id_tim2' => 'required',
                'skor_tim1' => 'required',
                'skor_tim2' => 'required',
            ];
            // dd($score);
            $validator = Validator::make($score, $rules);
            
           
            if ($validator->fails()) {
                return redirect()->back()
                ->withErrors($validator)
                    ->withInput();
            }

            if ($validator->passes()) {
                Score::create($score);
            } else {
                return redirect()->back()
                ->withErrors($validator)
                    ->withInput();
            }
        }
        return redirect()->back()->with('success', 'Score succesfully added!');
    }



    // Point Klasemen
    public function pointKlasemen(){
        $clubs = Club::all();
        $scores = Score::all();
        return view('klasemen', [
            'clubs' => $clubs,
            'scores' => $scores, 
        ]); 
    }

}
