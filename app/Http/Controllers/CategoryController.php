<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{



    public function index()
    {
        $categories = Category::select('id', app()->getLocale() . '_name as name' )->get();

        return response()->json($categories);
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }




    public function show($id)
    {
        //
    }




    public function edit($id)
    {
        //
    }




    public function update(Request $request, $id)
    {
        //
    }





    public function destroy($id)
    {
        //
    }
}
