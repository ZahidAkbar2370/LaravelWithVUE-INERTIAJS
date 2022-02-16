<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function select()
    {
        $data = User::all();

        return Inertia::render("User",["data" => $data]);
    }

    public function index()
    {
        $data = User::all();

        return Inertia::render("CreateUser",["data" => $data]);
    }

    public function store(Request $request)
    {
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "current_team_id" => "3",
        ]);

        return redirect()->back()
                    ->with('message', 'User Created Successfully.');
    }

    public function update(Request $request)
    {
        User::find($request->input('id'))->update([
            "name" => $request->name,
            "email" => $request->email,
            "current_team_id" => "3",
        ]);

        return redirect()->back()
                    ->with('message', 'User Updated Successfully.');
    }

    public function destroy(Request $request)
    {
        User::find($request->input('id'))->delete();

        return redirect()->back()
                    ->with('message', 'User Deleted Successfully.');
    }

    public function create()
    {
        return Inertia::render("CreateUser");
    }
}
