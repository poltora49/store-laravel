<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\admin\CategoryForm;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()->get();

        return view('admin.categories.index', [
            "categories" => $categories,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create',[]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryForm $request)
    {
        Category::create($this->saveImage($request,'category'));
        return redirect(route('category.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show',[
            "category" => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.create',[
            "category" => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryForm $request, Category $category)
    {
        if(($request->has("thumbnail")) and ($category->thumbnail!=null)){
            $this->deleteImage($category);
        }
        $category->update($this->saveImage($request, 'category'));
        return redirect(route('category.edit', $category->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->deleteImage($category);
        $category->delete();
        return redirect(route('category.index'));

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

