<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use stdClass;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->page ?? 1;
        $perPage = 20;
        $locations = Location::limit($perPage)->offset((($page - 1) * $perPage))->get();

        $count = Location::count();
        $info = new stdClass();
        $info->count = $count;
        $info->pages = ceil($count / $perPage);

        $jsonRs = new stdClass;
        $jsonRs->info = $info;
        $jsonRs->results = $locations;
        return response()->json($jsonRs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $location = new Location();
            $location->name = $request->name ?? '';
            $location->type = $request->type ?? '';
            $location->dimension = $request->dimension ?? '';
            $location->residents = $request->residents ?? '';
            $location->url = $request->url ?? '';
            $location->save();

            return response()->json([
                'error' => false,
                'msg' => 'Location created succesfully'
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
    public function show(Location $location)
    {
        return response()->json($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $id = $request->query('id');

            $location = Location::find($id);
            $location->name = $request->name ?? '';
            $location->type = $request->type ?? '';
            $location->dimension = $request->dimension ?? '';
            $location->residents = $request->residents ?? '';
            $location->url = $request->url ?? '';
            $location->save();

            return response()->json([
                'error' => false,
                'msg' => 'Location updated succesfully'
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

            $location = Location::find($id);

            $location->delete();

            return response()->json([
                'error' => false,
                'msg' => 'Location deleted succesfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => true,
                'msg' => strval($th)
            ], 200);
        }
    }
}
