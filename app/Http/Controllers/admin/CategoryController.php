<?php
namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;


class CategoryController extends Controller
{
public function index()
{
$categories = Category::latest()->paginate(10);
return view('admin.categories.index', compact('categories'));
}


public function create()
{
return view('admin.categories.create');
}


public function store(StoreCategoryRequest $request)
{
Category::create($request->validated());
return redirect()->route('admin.categories.index')->with('success','Category created');
}
}