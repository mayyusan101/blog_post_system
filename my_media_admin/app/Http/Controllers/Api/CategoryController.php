<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //get category
    public function getCategory(){
        $categories = Category::get();
        return response()->json([
            'status' => 'success',
            'category' => $categories
        ]);
    }
    //search category
    public function searchCategory(Request $request){

        $posts = Post::where('category_id',$request->key)->paginate(4);
        return response()->json([
            'status' => 'success',
            'posts' => $posts,
        ]);
    }
}
