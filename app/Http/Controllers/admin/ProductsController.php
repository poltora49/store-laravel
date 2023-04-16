<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\admin\ProductForm;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->get();

        return view('admin.products.index', [
            "products" => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->get();
        return view('admin.products.create',[
            "categories" => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductForm $request)
    {
        try {
            Product::create($this->saveImage($request,'product'));
            return redirect()->route('product.index')->with('success', "Add Successfully");
        }
        catch (\Exception $e) {
            return redirect()->route('product.index')->with('error', "Oops, something went wrong");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $categories = Category::query()->get();

        return view('admin.products.show',[
            "product" => $product,
            "categories" => $categories,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()->get();

        return view('admin.products.create',[
            "product" => $product,
            "categories" => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductForm $request, Product $product)
    {
        try {
            if(($request->has("thumbnail")) and ($product->thumbnail!=null)){
                $this->deleteImage($product);
            }
            $product->update($this->saveImage($request, 'product'));
            return redirect()->back()->with('success', "Changed Successfully");
        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', "Oops, something went wrong");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $this->deleteImage($product);
            $product->delete();
            return redirect()->route('product.index')->with('success', "Successfully delete");
        }
        catch (\Exception $e) {
            return redirect()->route('product.index')->with('error', "Oops, something went wrong");
        }

    }

    public function hide( $product_id)
    {
        try{
            $product=Product::find($product_id);
            $product->hidden=!$product->hidden;
            $product->save();
        return redirect()->back()->with('success', "Successfully ");        }
        catch (\Exception $e) {
            return redirect()->back()->with('error', "Oops, something went wrong");
        }

    }

    protected function deleteImage($product){
        if(Storage::disk('public')->exists('product/'.$product->thumbnail)){
            Storage::disk('public')->delete('product/'.$product->thumbnail);
            /*
                Delete Multiple files this way
                Storage::delete(['upload/test.png', 'upload/test2.png']);
            */
        }
    }

    protected function saveImage (ProductForm $request,$model)
    {
        $data = $request->validated();
        if($request->has("thumbnail")){
            $thumbnail = str_replace("public/".$model,"",$request->file("thumbnail")->store("public/".$model));
            $data["thumbnail"] = $thumbnail;
        }
        return $data;
    }
}
