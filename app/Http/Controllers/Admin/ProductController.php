<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use App\Http\Controllers\Controller;
use app\Http\Requests\ProductFormRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }
    public function edit(int $product_id){
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id);
        return view('admin.products.edit', compact('categories', 'brands', 'product'));
    }

    public function update(ProductFormRequest $request, int $product_id){
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData[category_id])
                    ->products()->where('id', $product_id)->first();

        if($product){
            $product->update([
                'category_id'=> $validatedData['category_id'],
                'name'=> $validatedData['name'],
                'slug'=> Str::slug($validatedData['slug']),
                'brand'=> $validatedData['brand'],
                'small_description'=> $validatedData['small_description'],
                'description'=> $validatedData['description'],
                'original_price'=> $validatedData['original_price'],
                'selling_price'=> $validatedData['selling_price'],
                'quantity'=> $validatedData['quantity'],
                'trending'=> $request->trending == true ? '1':'0',
                'status'=> $request->status == true ? '1':'0',
                'meta_title'=> $validatedData['meta_title'],
                'meta_keyword'=> $validatedData['meta_keyword'],
                'meta_description'=> $validatedData['meta_description'],
            ]);
            if($request->hasFile('image')){
                $uploadPath = 'uploads/products/';
                $i=1;
                foreach($request->file('image') as $imageFile){
                    $extension = $imageFile->getClientOriginalExtension();
                    $fileName = time().$i++.'.'.$extension;
                    $imageFile->move($uploadPath, $fileName);
                    $finalImagePathName = $uploadPath.$fileName;

                    $product->productImages()->create([
                        'product_id'=>$product->id,
                        'image'=>$finalImagePathName,
                    ]);
                }
            }

            return redirect('/admin/products')->with('message', 'product updated succesfully');
        }else{
            return redirect('admin/products')->with('message', "no product found for id");
        }
    }

    public function store(ProductFormRequest $request){
        $validatedData = $request->validated();

        $category = Category::findOrFail($validatedData['category_id']);
        $product = $category->products()-create([
            'category_id'=> $validatedData['category_id'],
            'name'=> $validatedData['name'],
            'slug'=> Str::slug($validatedData['slug']),
            'brand'=> $validatedData['brand'],
            'small_description'=> $validatedData['small_description'],
            'description'=> $validatedData['description'],
            'original_price'=> $validatedData['original_price'],
            'selling_price'=> $validatedData['selling_price'],
            'quantity'=> $validatedData['quantity'],
            'trending'=> $request->trending == true ? '1':'0',
            'status'=> $request->status == true ? '1':'0',
            'meta_title'=> $validatedData['meta_title'],
            'meta_keyword'=> $validatedData['meta_keyword'],
            'meta_description'=> $validatedData['meta_description'],
        ]);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/';
            $i=1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $fileName = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath, $fileName);
                $finalImagePathName = $uploadPath.$fileName;

                $product->productImages()->create([
                    'product_id'=>$product->id,
                    'image'=>$finalImagePathName,
                ]);
            }
        }

        return redirect('/admin/products')->with('message', 'product added succesfully');
    }

    public function destroyImage(int $product_image_id){
        $product_image = ProductImage::findOrFail($product_image_id);
        if(File::exists($product_image->image)){
            File::delete($product_image->image);
        }

        $product_image->delete();
        return redirect()->back()->with('message', 'image deleted succesfully');
    }
}
