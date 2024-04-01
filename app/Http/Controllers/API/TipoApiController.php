<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tipo;

class TipoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos =  Tipo::all();
        return response()->json($tipos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = new Tipo();
        $tipo->descripcion = $request->descripcion;
        $tipo->save();
        $data = [
            'mensaje' => 'tipo de servicio creado correctamente',
            'tipo' => $tipo
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
        return response()->json(Tipo::find($id));
        
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
        $tipo = Tipo::find($id);
        $tipo->descripcion = $request->descripcion;
        $tipo->save();
        $data = [
            'mensaje' => 'tipo de servicio actualizado correctamente',
            'tipo' => $tipo
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
        $tipo = Tipo::find($id);
        $tipo->delete();
        $data = [
            'mensaje' => 'tipo de servicio eliminado correctamente',
            'tipo' => $tipo
        ];
        return response()->json($data);

    }
}
