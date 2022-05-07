<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search_name = $request->name;
        $search_description = $request->description;

        $products = Product::select('products.created_at AS created', 'products.updated_at AS updated', 'products.id AS prodid', 'products.*', 'categories.*')
        ->where('name', 'LIKE', '%' .$search_name. '%')
        ->where('description', 'LIKE', '%' .$search_description. '%')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->orderBy('products.id', 'desc')
        ->paginate(10);


        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
        
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'category'=>'required'
        ]);

        // $product = new Product();
        // $product->name = $request->name;
        // $product->description = $request->description;
        // $product->price = $request->price;
        // $product->quantity = $request->quantity;
        // $product->category = $request->category;
        // $product->save();

        // return redirect('/products')->with('insert-msg', 'Product Added');

        $product = Product::updateOrCreate([
            'id' => $request->id
        ],[
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category' => $request->category,
        ]);


        return response()->json(['success' => true]);

        
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
    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $product = Product::where($where)->first();

        return response()->json($product);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::where('id', $request->id)->delete();

        return response()->json(['success' => true]);
        
    }
}
