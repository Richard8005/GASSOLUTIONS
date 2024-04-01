<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::all();
        return response()->json($materials);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material = new Material();
        $material->codigos = $request->codigos;
        $material->descripcion = $request->descripcion;
        $material->save();
        $data = [
          'mensaje' =>'material creado correctamente',
          'material' => $material
        ];
        return response()->json($data);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Material::find($id));
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
        $material = Material::find($id);
        $material->codigos = $request->codigos;
        $material->descripcion = $request->descripcion;
        $material->save();
        $data = [
         'mensaje' =>'material actualizado correctamente',
         'material' => $material
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $material = Material::find($id);
        $material->delete();
        $data = [
        'mensaje' =>'material eliminado correctamente',
        'material' => $material
        ];
        return response()->json($data);
    }

    
}
