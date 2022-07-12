<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\GeneralInfo;

class GeneralInfoController extends Controller
{
    
    public function index(){
        $general = GeneralInfo::first();

        return Inertia::render('General',[
            'general' => $general,
        ]);

    }

    public function contact(){
        $general = GeneralInfo::first();

        return Inertia::render('Contact',[
            'general' => $general,
        ]);

    }

    public function store(Request $request){
        $general_create = GeneralInfo::create($request->all());

        return redirect()->route('general')->with('successMessage', 'Info updated successfully!');
    }
    

    public function update(Request $request, GeneralInfo $general){
        $general->update($request->all());

        return redirect()->route('general')->with('successMessage', 'Info updated successfully!');

    }
}
