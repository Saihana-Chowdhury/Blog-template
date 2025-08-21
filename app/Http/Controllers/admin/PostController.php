<?php
namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Post;


class FrontendController extends Controller
{
// Home page — recent posts & categories
public function index()
{
$categories = Category::with([ 'posts' => function($q){ $q->latest()->limit(5); }])->orderBy('name')->get();
$latestPosts = Post::with('category')->latest()->paginate(9);
return view('frontend.index', compact('categories','latestPosts'));
}


// Category detail page — posts by category
public function category(string $slug)
{
$category = Category::where('slug',$slug)->firstOrFail();
$posts = $category->posts()->with('category')->latest()->paginate(9);
return view('frontend.category', compact('category','posts'));
}


// Single post page
public function post(string $slug)
{
$post = Post::with('category','user')->where('slug',$slug)->firstOrFail();
return view('frontend.post', compact('post'));
}
}