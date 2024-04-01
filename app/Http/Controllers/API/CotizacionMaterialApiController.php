<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CotizacionMaterial;


class CotizacionMaterialApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cotizacionmaterials = CotizacionMaterial::all();
        return response()->json($cotizacionmaterials);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cotizacionmaterial = new Cotizacionmaterial();
        $cotizacionmaterial->cotizacions_id = $request->cotizacions_id;
        $cotizacionmaterial->materials_id = $request->materials_id;
        $cotizacionmaterial->save();
        $data = [
            'mensaje' => 'cotizacion matrial creada correctamente',
            'cotizacionmaterial' => $cotizacionmaterial
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
        return response()->json(Cotizacionmaterial::find($id));

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
        $cotizacionmaterial = Cotizacionmaterial::find($id);
        $cotizacionmaterial->cotizacions_id = $request->cotizacions_id;
        $cotizacionmaterial->materials_id = $request->materials_id;
        $cotizacionmaterial->save();
        $data = [
            'mensaje' => 'cotizacion material actualizada correctamente',
            'cotizacionmaterial' => $cotizacionmaterial
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
        $cotizacionmaterial = Cotizacionmaterial::find($id);
        $cotizacionmaterial->delete();
        $data = [
            'mensaje' => 'cotizacionmaterial eliminado correctamente',
            'cotizacionmaterial' => $cotizacionmaterial
        ];
        return response()->json($data);
        
    }
}
