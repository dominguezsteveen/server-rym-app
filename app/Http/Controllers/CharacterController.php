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
        try {
            $character = new Character();
            $character->name = $request->name ?? '';
            $character->status = $request->status ?? '';
            $character->species = $request->species ?? '';
            $character->type = $request->type ?? '';
            $character->gender = $request->gender ?? '';
            $character->origin = $request->origin ?? '';
            $character->location = $request->location ?? '';
            $character->image = $request->image ?? '';
            $character->episode = $request->episode ?? '';
            $character->url = $request->url ?? '';
            $character->save();

            return response()->json([
                'error' => false,
                'msg' => 'Character created succesfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'msg' => strval($th)
            ], 200);
        }
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
    public function update(Request $request)
    {
        try {
            $id = $request->query('id');

            $character = Character::find($id);
            $character->name = $request->name ?? '';
            $character->status = $request->status ?? '';
            $character->species = $request->species ?? '';
            $character->type = $request->type ?? '';
            $character->gender = $request->gender ?? '';
            $character->origin = $request->origin ?? '';
            $character->location = $request->location ?? '';
            $character->image = $request->image ?? '';
            $character->episode = $request->episode ?? '';
            $character->url = $request->url ?? '';
            $character->save();

            return response()->json([
                'error' => false,
                'msg' => 'Character updated succesfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'msg' => strval($th)
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->query('id');

            $character = Character::find($id);

            $character->delete();

            return response()->json([
                'error' => false,
                'msg' => 'Character deleted succesfully'
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'msg' => strval($th)
            ], 200);
        }
    }
}
