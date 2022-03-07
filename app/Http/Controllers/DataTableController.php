<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use App\Models\User;
use Inertia\Inertia;
use Inertia\ResponseFactory;

class DataTableController extends Controller
{
    public function returnData(Request $request)
    {   
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        
        $query = User::eloquentQuery($sortBy, $orderBy, $searchValue);

        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }

    public function index()
    {
        echo "here";
        return Inertia::render("DataTable");
    }
}
