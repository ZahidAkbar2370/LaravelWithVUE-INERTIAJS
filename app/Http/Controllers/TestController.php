<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function index()
    {
        $data = Post::all();
        return Inertia::render('Test', ['data' => $data]);
    }
}
