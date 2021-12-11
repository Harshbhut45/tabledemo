<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all(); 		
        return view('admin.products.index',compact('products')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $statuses = ['Active', 'Inactive', 'Complete', 'Cancel'];
        return view('admin.products.create', compact('products', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();

            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->upc = $request->input('upc');
            $product->status = $request->input('status');
         
            $imageName = time().'.'.$request->image->extension();     
            $request->image->move(public_path('website/adminproduct/products'), $imageName);
            $product->image = $imageName;

            $product->save();
        
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
        $product = Product::find($id);
        if($product) {
            $statuses = ['Active', 'Inactive', 'Complete', 'Cancel'];
            return view('admin.products.create',compact('product','statuses'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        $products->name = $request->input('name');
        $products->price = $request->input('price');
        $products->upc = $request->input('upc');
        $products->status = $request->input('status');
      
        if($request->has('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('website/adminproduct/products'), $imageName);
            $products->image = $imageName;
        }
       
        $products->update();
        return redirect()->route('products.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();  
        return redirect()->route('products.index'); 
    }



    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Product::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }
}
