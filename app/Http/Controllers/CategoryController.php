<?php

namespace App\Http\Controllers;

use App\Http\Traits\GenaralApiTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


        use GenaralApiTrait;

    public function index()
    {
        $categories = Category::select('id', app()->getLocale() . '_name as name' )->get();

        return $this->returnData('categories', $categories, '');
    }


    public function getCategoryById(Request $request)
    {
        $category = Category::select('id', app()->getLocale() . '_name as name')->find($request->id);

        if(!$category)
        {
            return $this->returnError('001' ,'هذا المنتج غير موجود');
        }
            return $this->returnData('category',$category,'');
    }

}
