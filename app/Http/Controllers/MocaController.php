<?php

namespace App\Http\Controllers;

use App\Models\Moca;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MocaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function uploadConceptualAlternative(Request $request)
    {
        if(! $request){
            return "no hay imagen";
        }
        $validator = Validator::make($request->all(), [
            'image_conceptual_alternative' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
            //return redirect()->back()->withErrors($validator->errors());
        }

        $path = $request->file('image_conceptual_alternative')->store('public');

        $moca = new Moca();
        $moca->user_id = Auth::user()->id;

        $moca->image_conceptual_alternative = $path;
        $moca->save();

        return "se guardo la imagen";
    }

    public function uploadCube(Request $request){

        if(! $request){
            return "no hay imagen";
        }

        $validator = Validator::make($request->all(), [
            'image_cube' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
            //return redirect()->back()->withErrors($validator->errors());
        }

        $path = $request->file('image_cube')->store('public');

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->image_cube = $path;
        $moca->save();

        return 'se guardo con exito';

    }

    public function uploadClock(Request $request){
        
        if(! $request){
            return "no hay imagen";
        }

        $validator = Validator::make($request->all(), [
            'image_clock' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
            //return redirect()->back()->withErrors($validator->errors());
        }

        $path = $request->file('image_clock')->store('public');

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->image_clock = $path;
        $moca->save();

        return 'se guardo con exito';
    }

    public function editMoca(Request $request){
        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        

    }
        //create a new moca object and save it to the database just with this image

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Moca $moca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Moca $moca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Moca $moca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Moca $moca)
    {
        //
    }
}
