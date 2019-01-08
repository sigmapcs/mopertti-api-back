<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sections;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections =  Sections::get();
        return response()->json($sections, 200);
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
        $rules = [
            'name'=> 'required',
        ];

        $this->validate($request,$rules);

        $form = [
            "name" => $request->input("name")
        ];
        $section = Sections::create($form);
        return response()->json($section,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Sections::find($id);
        return response()->json($section,200);
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
        $section = Sections::find($id);
        $section->name = $request->input("name");
        $section->save();
        return response()->json($section,200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Sections::find($id);
        $section->delete();
        return response()->json(["sucess"=>"Seccion Eliminada con éxito id ".$id],200);
    }

    public function saveAll(Request $request)
    {
        $json = file_get_contents($request->file);
        $data = json_decode($json);
        foreach ($data as $obj) {
            $section = new Sections;
            $section->name = $obj->name;
            $section->save();
        }
        $sections =  Sections::get();
        return response()->json($sections, 200);
    }
}
