<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index(){ 
        return view('clubInput');
    }

    public function addClub(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|unique:clubs',
            'city' => 'required',
        ]);

        Club::create($validatedData);
        return redirect('/');
    }


}
