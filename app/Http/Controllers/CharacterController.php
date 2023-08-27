<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::paginate(20);
        return response()->json($characters);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:1|max:100',
            'status' => 'required|string|min:1|max:100',
            'species' => 'required|string|min:1|max:100',
            'type' => 'required|string',
            'gender' => 'required|string|min:1|max:100',
            'origin' => 'required|string',
            'location' => 'required|string',
            'image' => 'required|string',
            'episode' => 'required|string',
            'url' => 'required|string'
        ];

        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $character = new Character($request->input());
        $character->save();

        return response()->json([
            'status' => true,
            'message' => 'Character created succesfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        return response()->json(['status' => true, 'data' => $character]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {

        $rules = [
            'name' => 'required|string|min:1|max:100',
            'status' => 'required|string|min:1|max:100',
            'species' => 'required|string|min:1|max:100',
            'type' => 'required|string',
            'gender' => 'required|string|min:1|max:100',
            'origin' => 'required|string',
            'location' => 'required|string',
            'image' => 'required|string',
            'episode' => 'required|string',
            'url' => 'required|string'
        ];

        $validator = Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $character->update($request->input());

        return response()->json([
            'status' => true,
            'message' => 'Character updated succesfully'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        $character->delete();

        return response()->json([
            'status' => true,
            'message' => 'Character deleted succesfully'
        ], 200);
    }
}
