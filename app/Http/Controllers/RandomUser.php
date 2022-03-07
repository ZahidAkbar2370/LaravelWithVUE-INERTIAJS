<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Http;

class RandomUser extends Controller
{
    public function index()
    {
        $data = Http::get("https://randomuser.me/api/")->json();
// echo "<pre>";
// print_r($data);
// exit;
        return Inertia::render("randomuser",["data" => $data["results"][0]]);
    }
}
