<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $response = Http::get("https://reqres.in/api/users/2");
//        dd($response->json());

//        $response = Http::post("https://reqres.in/api/create", [
//            "name"   => "Dragan",
//            "job" => "Programmer",
//        ]);
//        dd($response->json());

//        https://api.weatherapi.com/v1/current.json?key=8696aa3b9eaa4b7ea75160832242105&q=London&aqi=no
        $response = Http::get("api.weatherapi.com/v1/current.json?key=8696aa3b9eaa4b7ea75160832242105&q=London&aqi=no");
        dd($response->status());

    }
}
