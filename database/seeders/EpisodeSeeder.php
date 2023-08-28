<?php

namespace Database\Seeders;

use App\Models\Episode;
use GuzzleHttp\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 51; $i++) {
            $client = new Client(['verify' => false]);
            $response = $client->get("https://rickandmortyapi.com/api/episode/" . $i);
            $data = json_decode($response->getBody());

            $episode = new Episode();
            $episode->id = $data->id;
            $episode->name = $data->name;
            $episode->air_date = $data->air_date;
            $episode->episode = $data->episode;
            $episode->characters = str_replace("\\", "", $data->characters);
            $episode->url = $data->url;
            $episode->save();
        }
    }
}
