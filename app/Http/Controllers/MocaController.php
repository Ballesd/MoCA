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

    public function uploadIdentification(Request $request){

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->identification_answer = $request->identification_answer;

        $moca->save();

        return 'se guardo con exito';
    }

    public function uploadAttention(Request $request){

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->attention_answer = $request->attention_answer;

        $moca->save();

        return 'se guardo con exito';
    }

    public function uploadLanguage(Request $request){

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->language_answer = $request->language_answer;

        $moca->save();

        return 'se guardo con exito';
    }

    public function uploadVerbalFluency(Request $request){

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->verbal_fluency_answer = $request->verbal_fluency_answer;

        $moca->save();

        return 'se guardo con exito';
    }

    public function uploadAbstraction(Request $request){

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->abstraction_answer = $request->abstraction_answer;

        $moca->save();

        return 'se guardo con exito';
    }

    public function uploadDeferredRecall(Request $request){

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->deferred_recall_answer = $request->deferred_recall_answer;

        $moca->save();

        return 'se guardo con exito';
    }

    public function uploadOrientation(Request $request){

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->orientation_answer = $request->orientation_answer;

        $moca->save();

        return 'se guardo con exito';
    }

    public function saveMiss(Request $request){

        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->mis = $request->mis;
        $moca->save();

        return 'se guardo con exito';
        
    }

    public function editMoca(Request $request){
        $user_id = Auth::user()->id;

        $moca = Moca::where('user_id', $user_id)->first();

        $moca->identification = $request->Identification;
        $moca->memory = $request->Memory;
        $moca->attention = $request->Attention;
        $moca->language = $request->Lemgua;
        $moca->verbal_fluency = $request->VerbalFluency;
        $moca->abstraction = $request->Abstraction;
        $moca->deferred_recall = $request->DeferredRecall;
        $moca->orientation = $request->Orientation;
        $moca->total = $request->total;
        $moca->check = True;

        $moca->save();

        return 'se guardo con exito';
    }

}
