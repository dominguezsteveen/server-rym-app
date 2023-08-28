<?php

namespace Database\Seeders;

use App\Models\Location;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 126; $i++) {
            $client = new Client(['verify' => false]);
            $response = $client->get("https://rickandmortyapi.com/api/location/" . $i);
            $data = json_decode($response->getBody());

            $location = new Location();
            $location->id = $data->id;
            $location->name = $data->name;
            $location->type = $data->type;
            $location->dimension = $data->dimension;
            $location->residents = str_replace("\\", "", $data->residents);
            $location->url = $data->url;
            $location->save();
        }
    }
}
