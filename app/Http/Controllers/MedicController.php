<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Moca;

class MedicController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Medic/Index');

    }

    public function show(Request $request)
    {
        return Inertia::render('Medic/MocaResults');

    }

    public function getMoca(Request $request)
    {
        
        $user = User::where('identification', $request->identification)->first();
        if (!$user) {
            return 'No se encontro el usuario';
        }
        $moca = Moca::where('user_id', $user->id)->first();
        
        return compact('user', 'moca');
    }

    public function editMoca(Request $request)
    {
        $moca = Moca::where('user_id', $request->user_id)->first();
        $moca->ConceptualAlternative = $request->ConceptualAlternative;
        $moca->cube = $request->cube;
        $moca->clock = $request->clock;

        $moca->total = $moca->total + $request->ConceptualAlternative + $request->cube + $request->clock;
        
        $moca->save();
        return $moca;
    }
}
