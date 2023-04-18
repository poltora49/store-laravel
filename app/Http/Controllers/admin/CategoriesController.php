<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryForm;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()->get();

        return view('Admin.categories.index', [
            "categories" => $categories,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.categories.create',[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryForm $request)
    {
        try {
            Category::create($this->saveImage($request,'category'));
            return redirect()->route('category.index')->with('success', "Add successfully");
        }
        catch (\Exception $e) {
            return redirect()->route('category.index')->with('error', "Oops, something went wrong");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('Admin.categories.create',[
            "category" => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryForm $request, Category $category)
    {
        try {
            if(($request->has("thumbnail")) and ($category->thumbnail!=null)){
                $this->deleteImage($category);
            }
            $category->update($this->saveImage($request, 'category'));
            return redirect()->back()->with('success', "Changed Successfully");
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', "Oops, something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $this->deleteImage($category);
            $category->delete();
            return redirect()->route('category.index')->with('success', "Delete successfully");
        }
        catch (\Exception $e) {
            return redirect()->route('category.index')->with('error', "Oops, something went wrong");
        }

    }

    protected function deleteImage(Category $category){
        if(Storage::disk('public')->exists('category/'.$category->thumbnail)){
            Storage::disk('public')->delete('category/'.$category->thumbnail);
            /*
                Delete Multiple files this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }
    }

    protected function saveImage (CategoryForm $request,$model)
    {
        $data = $request->validated();
        if($request->has("thumbnail")){
            $thumbnail = str_replace("public/".$model,"",$request->file("thumbnail")->store("public/".$model));
            $data["thumbnail"] = $thumbnail;
        }
        return $data;
    }
}

