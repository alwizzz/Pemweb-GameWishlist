<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }

    public function index()
    {
        return view('product.index', [
            'title' => 'Home',
            'products' => Product::all() 
        ]);
    }

    public function create()
    {
        return view('product.create', [
            'title' => 'Create'
        ]); 
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:100|unique:products,title',
            'genre' => 'required|max:100',
            'developer' => 'required|max:20',
            'price' => 'required|integer|gt:0',
            'image' => 'image'
        ];

        $requestValidated = $request->validate($rules);

        if( $request->file('image') ){
            $requestValidated['image'] = $requestValidated['image']->storeAs('images', Product::generateSlug($request->input('title')) . '.jpg');
            // dd($img->getMimeType());
        } else {
            $requestValidated['image'] = null;
        }

        $storingSucceed = Product::customCreate(
            $requestValidated['title'],
            $requestValidated['genre'],
            $requestValidated['developer'],
            $requestValidated['price'],
            $requestValidated['image']

        );

        if($storingSucceed){
            return redirect(route('product.index'))->with('success', 'Product has been added successfully!');
        } else {
            return redirect(route('product.index'))->with('fail', 'Product failed to be added!');
        }
    }

    public function show(Product $product)
    {
        return view('product.detail', [
            'title' => 'Detail',
            'product' => $product
        ]);
    }

    public function edit(Product $product)
    {
        return view('product.edit', [
            'title' => 'Edit',
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'genre' => 'required|max:100',
            'developer' => 'required|max:20',
            'price' => 'required|integer|gt:0',
            'title' => 'required',
            'image' => 'image'
        ];

        $titleChanged = false;
        if($product->title != $request->title){ //edited title is new
            $titleChanged = true;
            $rules['title'] = $rules['title'] . '|max:100|unique:products,title';
        }

        $requestValidated = $request->validate($rules);


        if($product->image){ //previously has image
             if( $request->image) { // edited image submitted
                Storage::delete($product->image);
                $requestValidated['image'] = $requestValidated['image']->storeAs('images', Product::generateSlug($requestValidated['title']) . '.jpg');
             } else { //no editted image submitted
                if($titleChanged){ //title changed so image url name is also changed
                    // Storage::delete($product->image);
                    // $requestValidated['image'] = asset('storage/' . $product->image)->storeAs('images', Product::generateSlug($requestValidated['title']) . '.jpg');
                    $newUrl = 'images/'. Product::generateSlug($requestValidated['title']) . '.jpg';
                    Storage::move($product->image, $newUrl );
                    $requestValidated['image'] = $newUrl;
                } else {
                    $requestValidated['image'] = $product->image;
                }
             }
        } else { //previously no image
            if( $request->image) {
                $requestValidated['image'] = $requestValidated['image']->storeAs('images', Product::generateSlug($requestValidated['title']) . '.jpg');
            } else {
                $requestValidated['image'] = null;
            }
        }






        $updateSucceed = 
            Product::customUpdate($product->id, $requestValidated);

        if($updateSucceed){
            return redirect(route('product.index'))->with('success', 'Product has been edited successfully!');
        } else {
            return redirect(route('product.index'))->with('fail', 'Product failed to be edited!');
        }
    }

    public function destroy(Product $product)
    {
        if( $product->image ){
            Storage::delete($product->image);
        }

        $destroySucceed = $product->delete();

        if($destroySucceed){
            return redirect(route('product.index'))->with('success', 'Product has been removed successfully!');
        } else {
            return redirect(route('product.index'))->with('fail', 'Product failed to be removed!');
        }
    }
}
