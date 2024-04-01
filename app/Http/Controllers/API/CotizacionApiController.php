<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cotizacion;

class CotizacionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$user=Auth::user();
        $cotizacions = Cotizacion::where('user_id',$user->id);*/
        $cotizacions = Cotizacion::all();
        return response()->json($cotizacions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cotizacion = new Cotizacion();
        $cotizacion->costo = $request->costo;
        $cotizacion->agendamientos_id = $request->agendamientos_id;
        $cotizacion->save();
        $data = [
           'mensaje' => 'cotizacion creada correctamente',
            'cotizacion' => $cotizacion
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
        return response()->json(Cotizacion::find($id));
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
        $cotizacion = Cotizacion::find($id);
        $cotizacion->costo = $request->costo;
        $cotizacion->save();
        $data = [
          'mensaje' => 'cotizacion actualizada correctamente',
            'cotizacion' => $cotizacion
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
        $cotizacion = Cotizacion::find($id);
        $cotizacion->delete();
        $data = [
          'mensaje' => 'cotizacion eliminada correctamente',
            'cotizacion' => $cotizacion
        ];
        return response()->json($data);
    }
}
