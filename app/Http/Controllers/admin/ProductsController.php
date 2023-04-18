<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\Admin\ProductForm;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::query()->get();

        return view('Admin.products.index', [
            "products" => $products,
        ]);
    }


    public function create()
    {
        $categories = Category::query()->get();
        return view('Admin.products.create',[
            "categories" => $categories,
        ]);
    }


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

    public function edit(Product $product)
    {
        $categories = Category::query()->get();

        return view('Admin.products.create',[
            "product" => $product,
            "categories" => $categories,
        ]);
    }


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
            if($product->hidden)
                return redirect()->back()->with('success', "Successfully hide");
            return redirect()->back()->with('success', "Successfully unhide");
            }
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
