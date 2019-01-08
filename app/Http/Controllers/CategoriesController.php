<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::get();
        return response()->json($categories, 200);
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


        $form = [
          "name" => $request->input("name"),
          "parent" => $request->input("parent")
        ];
        $category = Categories::create($form);
        return response()->json($category,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categories::find($id);
        return response()->json($category,200);
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
    // public function update(Request $request, $id)
    // {
    //     $category = Categories::find($id);
    //     $category->name = $request->input("name");
    //     $category->name = $request->input("parent");
    //     $category->save();
    //     return response()->json($category,200);

    // }

    public function update(Request $request, $id)
    {
        $num = $id;
        $category = Categories::find($id);
        $category->name = $request->input("name");
        $category->parent = $request->input("parent");
        $category->save();
        return response()->json($category,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::find($id);
        $category->delete();
        return response()->json(["sucess"=>"Categoria Eliminada con éxito id ".$id],200);
    }
    public function saveAll(Request $request)
    {
        $json = file_get_contents($request->file);
        $data = json_decode($json);
        foreach ($data as $obj) {
            $section = new Categories;
            $section->name = $obj->name;
            $section->parent = $obj->parent;
            $section->save();
        }
        $categories =  Categories::get();
        return response()->json($categories, 200);
    }
}
