<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use stdClass;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $perPage = 20;
        $characters = Character::limit($perPage)->offset((($page - 1) * $perPage))->get();

        $count = Character::count();
        $info = new stdClass();
        $info->count = $count;
        $info->pages = ceil($count / $perPage);

        $jsonRs = new stdClass;
        $jsonRs->info = $info;
        $jsonRs->results = $characters;
        return response()->json($jsonRs);
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
        return response()->json($character);
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
