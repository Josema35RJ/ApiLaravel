<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Emotion;
use App\Models\Emotions;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class EmotionController extends Controller
{
    public function list()
    {
        $emotions = Emotion::where('deleted', 0)->get();
        return view('listEmotions', ['emotions' => $emotions]);
    }
    public function index()
    {
        try {
            $emotions = Emotion::all();
            return response()->json([
                'success' => true,
                'message' => 'Emotions retrieved successfully.',
                'data' => $emotions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There was an error retrieving the emotions.'
            ], 500);
        }
    }
    

    public function show($emotion)
{
    try {
        $emotion = Emotion::find($emotion);
        if ($emotion) {
            return response()->json([
                'success' => true,
                'message' => 'Emotion retrieved successfully.',
                'data' => $emotion
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Emotion not found.'
            ], 404);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'There was an error retrieving the emotion.'
        ], 500);
    }
}


public function store(Request $request)
{
    try {
        $emotion = new Emotion;
        $emotion->type = "emotion";
        $emotion->name = $request->name;
        $emotion->user_id = $request->user()->id; // Use the authenticated user's id
        $emotion->description = $request->description ?? ""; // Use the description from the request or default to an empty string
        $emotion->deleted = 0;
        $emotion->image = "https://mindcare.allsites.es/public/images/" . strtolower($request->name) . ".png";
        $emotion->save();

        return response()->json([
            'success' => true,
            'message' => 'Emotion created successfully.',
            'data' => $emotion
        ], 201);
    } catch (\Illuminate\Database\QueryException $e) {
        return response()->json([
            'success' => false,
            'message' => 'There was a database error creating the emotion.'
        ], 500);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'There was an error creating the emotion.'
        ], 500);
    }
}


public function update(Request $request, $emotion)
{
    try {
        $emotion = Emotion::find($emotion);
        if ($emotion) {
            $emotion->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Emotion updated successfully.',
                'data' => $emotion
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Emotion not found.'
            ], 404);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'There was an error updating the emotion.'
        ], 500);
    }
}


    public function destroy($emotion)
    {
        try {
            $emotion = Emotion::find($emotion);
            if ($emotion) {
                $emotion->deleted=1;
                $emotion->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Emotion deleted successfully.'
                ], 200);  // Cambiado a 200
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Emotion not found.'
                ], 404);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete this emotion because it is being referenced in another table.'
            ], 405);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'There was an error deleting the emotion.'
            ], 500);
        }
    }
     
}
