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
            $character->name = "$data->name";
            $character->status = "$data->status";
            $character->species = $data->species;
            $character->type = " $data->type";
            $character->gender = $data->gender;
            $character->origin = json_encode($data->origin);
            $character->location = json_encode($data->location);
            $character->image = $data->image;
            $character->episode = json_encode($data->episode);
            $character->url = $data->url;
            $character->save();
        }
    }
}
