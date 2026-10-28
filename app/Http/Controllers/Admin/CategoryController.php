<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = new Category;

        $category->name = $request->name;
        if(isset($category->alias))
            $category->alias = Str::slug($request->alias,'-');

        $category->alias = Str::slug($request->name,'-');

        $category->published = 0;

        if(isset($category->published))
            $category->published = $request->published;

        $category->description = $request->description;

        $category->save();

        return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $categories = Category::orderBy('id','desc')->get();
        return response()->json(['data' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.editCategory')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->name = $request->name;
        $category->alias = Str::slug($request->alias,"-");
        $category->description = $request->description;
        $category->published = 0;

        if(isset($request->published))
            $category->published = $request->published;
        
        $category->update();

        return redirect('/admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function updateField(Request $request, Category $category, $field)
    {
        if($category->$field == 0){
            $category->$field = 1;
        }

        else{
            $category->$field = 0;
        }

        $category->update();

        return back();
    }
}
