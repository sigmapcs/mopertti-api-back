<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Products;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Products::get();

        if($request->has('category')){
            $products = $products -> where('category',$request->get('category'));
        }

        return response()->json($products,200);
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
        $data = $request->all();
        $data['imgurl'] = $request->imgurl->store('');

        $product = Products::create($data);

        return response()->json($product,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Products::find($id);
        return response()->json($product,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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


        $product= Products::find($id);



        if($request->hasFile('imgurl')){
            Storage::delete($product->imgurl);
            $product->name = $request->input("name");
            $product->description = $request->input("description");
            $product->section = $request->input("section");
            $product->category = $request->input("category");
            $product->imgurl = $request->imgurl->store('');
            $product->save();
        }else{
            $product->name = $request->input("name");
            $product->description = $request->input("description");
            $product->section = $request->input("section");
            $product->category = $request->input("category");
            $product->save();
        }

        return response()->json($product,200);
    }
    // public function update (Request $request, $id) {
    //     $product = Products::find($id);

    //     $product->name = $request->input("name");
    //     $product->description = $request->input("description");
    //     $product->section = $request->input("section");
    //     $product->category = $request->input("category");
    //     $product->notes = $request->input('notes');
    //     $product->save();

    // }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Products::find($id);
        Storage::delete($product->imgurl);
        $product->delete();
        return response()->json(["sucess"=>"Producto Eliminado con éxito id ".$id],200);
    }

    public function getGroup($id)
    {
        $products = Products::where('category', $id);
        return response()->json($products,200);
    }
}
