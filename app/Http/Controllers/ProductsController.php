<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('products.index')->with('products', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required'
        ]);

        $input = $request->all();
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $name = rand(100, 1000).$file->getClientOriginalName();
            $file->move('uploads/products-imgs', $name);
            $input['image'] = $name;
        }
        Product::create($input);
        session()->flash('success', 'Product created successfully');

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
    public function edit(Product $product)
    {
        return view('products.create', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
            'description' => 'required'
        ]);
        $input = $request->all();

        if ($request->hasFile('image'))
        {
            unlink(public_path(('uploads/products-imgs/').$product->image));
            $file = $request->file('image');
            $name = rand(100, 1000).$file->getClientOriginalName();
            $file->move('uploads/products-imgs', $name);
            $input['image'] = $name;
        }
        $product->update($input);
        session()->flash('success', 'Product updated successfully');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('success', 'Product deleted successfully');
        return redirect()->route('products.index');
    }
}
