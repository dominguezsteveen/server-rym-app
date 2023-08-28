<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use stdClass;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $perPage = 20;
        $episodes = Episode::limit($perPage)->offset((($page - 1) * $perPage))->get();

        $count = Episode::count();
        $info = new stdClass();
        $info->count = $count;
        $info->pages = ceil($count / $perPage);

        $jsonRs = new stdClass;
        $jsonRs->info = $info;
        $jsonRs->results = $episodes;
        return response()->json($jsonRs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $episode = new Episode();
            $episode->name = $request->name ?? '';
            $episode->air_date = $request->air_date ?? '';
            $episode->episode = $request->episode ?? '';
            $episode->characters = $request->characters ?? '';
            $episode->url = $request->url ?? '';
            $episode->save();

            return response()->json([
                'error' => false,
                'msg' => 'Episode created succesfully'
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
    public function show(Episode $episode)
    {
        return response()->json($episode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $id = $request->query('id');

            $episode = Episode::find($id);
            $episode->name = $request->name ?? '';
            $episode->air_date = $request->air_date ?? '';
            $episode->episode = $request->episode ?? '';
            $episode->characters = $request->characters ?? '';
            $episode->url = $request->url ?? '';
            $episode->save();

            return response()->json([
                'error' => false,
                'msg' => 'Episode updated succesfully'
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

            $episode = Episode::find($id);

            $episode->delete();

            return response()->json([
                'error' => false,
                'msg' => 'Episode deleted succesfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'msg' => strval($th)
            ], 200);
        }
    }
}
