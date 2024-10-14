<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//     public function getActors($pkey)
// {
//     $client = new Client();
//     $server = '127.0.0.1:8000'; // Ganti dengan URL server Anda
//     $url = "http://$server/ws/p/$pkey/actor";

//     $response = $client->get($url);

//     if ($response->getStatusCode() === 200) {
//         $data = json_decode($response->getBody(), true);
//         return $data;
//     } else {
//         return response()->json(['error' => 'Unable to fetch actors'], $response->getStatusCode());
//     }
// }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Actor $actor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor $actor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        //
    }
}
