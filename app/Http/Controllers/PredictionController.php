<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prediction;

class PredictionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch predictions from the database
        $predictions = Prediction::all();

        // Return the predictions as a JSON response
        return response()->json($predictions);
    }

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function showPrediction(string $id){
        // This method can be used to show a specific prediction
        // For example, you can fetch a prediction by ID and return it
        $prediction = Prediction::find($id);

        if (!$prediction) {
            return response()->json(['message' => 'Prediction not found'], 404);
        }

        return response()->json($prediction);
    }
}
