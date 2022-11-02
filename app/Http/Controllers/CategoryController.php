<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {

        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->with('category')->orderBy('id', 'desc')->paginate(2);
        return view('category.show', compact('category', 'posts'));
    }
}
