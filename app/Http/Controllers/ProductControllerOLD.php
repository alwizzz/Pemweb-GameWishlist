<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        return view('product.index', [
            'title' => 'Home',
            'products' => Product::all() 
        ]);
    }

    public function create(){
        return view('product.create', [
            'title' => 'Create'
        ]); 
    }

    public function store(Request $request){
        
        $rules = [
            'title' => 'required|max:100|unique:products,title',
            'genre' => 'required|max:100',
            'developer' => 'required|max:20',
            'price' => 'required|integer|gt:0'
        ];

        $requestValidated = $request->validate($rules);

        $storingSucceed = Product::customCreate(
            $requestValidated['title'],
            $requestValidated['genre'],
            $requestValidated['developer'],
            $requestValidated['price']
        );

        if($storingSucceed){
            return redirect('/')->with('success', 'Product has been added successfully!');
        } else {
            return redirect('/')->with('fail', 'Product failed to be added!');
        }
    }

    public function detail(Product $product){
        return view('product.detail', [
            'title' => 'Detail',
            'product' => $product
        ]);
    }

    public function edit(Product $product){
        return view('product.edit', [
            'title' => 'Edit',
            'product' => $product
        ]);
    }

    public function update(Request $request){
        $rules = [
            'genre' => 'required|max:100',
            'developer' => 'required|max:20',
            'price' => 'required|integer|gt:0'
        ];

        if($request->original_title != $request->title){ //edited title is new
            $rules['title'] = 'required|max:100|unique:products,title';
        }

        $requestValidated = $request->validate($rules);

        $updateSucceed = 
            Product::where('id', $request->id)
            ->update($requestValidated);

        if($updateSucceed){
            return redirect('/')->with('success', 'Product has been edited successfully!');
        } else {
            return redirect('/')->with('fail', 'Product failed to be edited!');
        }
    }


    public function delete(Request $request){
        $destroySucceed = Product::destroy($request['id']);

        if($destroySucceed){
            return redirect('/')->with('success', 'Product has been removed successfully!');
        } else {
            return redirect('/')->with('fail', 'Product failed to be removed!');
        }
    }

    // /**
    //  * Handle the incoming request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function __invoke(Request $request)
    // {
    //     //
    // }
}
