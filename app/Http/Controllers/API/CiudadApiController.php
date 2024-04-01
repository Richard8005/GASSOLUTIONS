<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ciudad;

class CiudadApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudads =  Ciudad::all();
        return response()->json($ciudads);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ciudad = new Ciudad();
        $ciudad->nombre = $request->nombre;
        $ciudad->save();
        $data = [
            'mensaje' => 'ciudad creada correctamente',
            'ciudad' => $ciudad
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
        return response()->json(Ciudad::find($id));
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
        $ciudad = Ciudad::find($id);
        $ciudad->nombre = $request->nombre;
        $ciudad->save();
        $data = [
            'mensaje' => 'ciudad  actualizada correctamente',
            'ciudad' => $ciudad
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
        $ciudad = Ciudad::find($id);
        $ciudad->delete();
        $data = [
            'mensaje' => 'ciudad eliminada correctamente',
            'ciudad' => $ciudad
        ];
        return response()->json($data);
    }
}
