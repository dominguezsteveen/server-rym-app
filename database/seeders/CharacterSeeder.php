<?php

namespace Database\Seeders;

use App\Models\Character;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 68; $i++) {
            $client = new Client(['verify' => false]);
            $response = $client->get("https://rickandmortyapi.com/api/character/" . $i);
            $data = json_decode($response->getBody());

            $character = new Character();
            $character->id = $data->id;
            $character->name = $data->name;
            $character->status = $data->status;
            $character->species = $data->species;
            $character->type = $data->type;
            $character->gender = $data->gender;
            // $character->origin = str_replace('\\', "", json_encode($data->origin));
            $character->origin = $data->origin;
            // $character->location = str_replace("\\", "", json_encode($data->location));
            $character->location = $data->location;
            $character->image = $data->image;
            $character->episode = str_replace("\\", "", $data->episode);
            $character->url = $data->url;
            $character->save();
        }
    }
}
