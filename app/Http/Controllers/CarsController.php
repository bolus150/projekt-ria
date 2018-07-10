<?php

namespace App\Http\Controllers;

use App\Cars;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(array( 'data' => Cars::all()), 201 );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cars::create(array(
            "marka" => $request['marka'],
            "model" => $request['model'],
            "rocznik" => $request['rocznik'],
            "pojemnosc" => $request['pojemnosc'],
        ));

        return response()->json(array('msg' => "Dodane poprawnie"), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(array('msg' => "Edytowane poprawnie", 'data' => Cars::findOrFail($id)), 201);
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
        $cars = Cars::findOrFail($id);
        $cars->update(array(
            "marka" => $request['marka'],
            "model" => $request['model'],
            "rocznik" => $request['rocznik'],
            "pojemnosc" => $request['pojemnosc'],
        ));

        return response()->json(array('msg' => "Edytowane poprawnie"), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cars::find($id)->delete();

        return response()->json(array('msg' => "Usunięte poprawnie"), 204);
    }
}
