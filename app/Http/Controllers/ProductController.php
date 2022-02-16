<?php

namespace App\Http\Controllers;

use App\Models\Categorey;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::with("categorey")->get();
        $categorey = Categorey::all();

        return Inertia::render("Product",["data" => $data, "categorey" => $categorey]);
    }

    public function store(Request $request)
    {
        $validatedProduct = Validator::make($request->all(), [
            'product_name' => ['required'],
            'price' => ['required',"integer"],
            'description' => ['nullable'],
        ])->validate();

        $insertProduct = Product::create($request->all());

        return redirect()->back()
                    ->with('message', 'Product Created Successfully.');
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'product_name' => ['required'],
            'price' => ['required',"integer"],
            'description' => ['nullable'],
        ])->validate();
  
        if ($request->has('id')) {
            Product::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Product Updated Successfully.');
        }
    }

    public function active(Request $request)
    {
        $activeProduct = Product::find($request->input('id'));
        $activeProduct->publication_status = "1";
        $activeProduct->update();

        return redirect()->back()
                    ->with('message', 'Product Updated Successfully.');

    }

    public function inactive(Request $request)
    {
        $activeProduct = Product::find($request->input('id'));
        $activeProduct->publication_status = "0";
        $activeProduct->update();

        return redirect()->back()
                    ->with('message', 'Product Updated Successfully.');

    }

    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            Product::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
