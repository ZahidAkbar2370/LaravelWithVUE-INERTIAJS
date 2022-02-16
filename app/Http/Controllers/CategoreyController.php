<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorey;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class CategoreyController extends Controller
{
    public function index()
    {
        $data = Categorey::all();

        return Inertia::render("Categorey",["data" => $data]);
    }

    public function store(Request $request)
    {
        $insertCategorey = Categorey::create([
            "categorey_name" => $request->categorey_name,
        ]);

        return redirect()->back()
                    ->with('message', 'Categorey Created Successfully.');
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'categorey_name' => ['required'],
            'publication_status' => ['required'],
        ])->validate();
  
        if ($request->has('id')) {
            Categorey::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Categorey Updated Successfully.');
        }
    }

    public function active(Request $request)
    {
        $activeCategorey = Categorey::find($request->input('id'));
        $activeCategorey->publication_status = "1";
        $activeCategorey->update();

        return redirect()->back()
                    ->with('message', 'Categorey Updated Successfully.');

    }

    public function inactive(Request $request)
    {
        $activeCategorey = Categorey::find($request->input('id'));
        $activeCategorey->publication_status = "0";
        $activeCategorey->update();

        return redirect()->back()
                    ->with('message', 'Categorey Updated Successfully.');

    }

    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Categorey::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
