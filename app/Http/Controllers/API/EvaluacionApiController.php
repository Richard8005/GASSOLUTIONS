<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluacion;


class EvaluacionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluacions = Evaluacion::all();
        return response()->json($evaluacions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "calificacion" => "required",
            "agendamientos_id" => "required"
        ]);
        
        if (Evaluacion::where('agendamientos_id', $request->servicios_id)->exists()) {
            $evaluacion = Evaluacion::where('agendamientos_id', $request->servicios_id)->first();
            $calificacion = ($evaluacion->calificacion + $request->calificacion) / 2; 
            $evaluacion->calificacion = $calificacion;
            $evaluacion->update();
        } else {
            $evaluacion = new Evaluacion();
            $evaluacion->calificacion = $request->calificacion;
            $evaluacion->agendamientos_id = $request->agendamientos_id;
            $evaluacion->save();
        }
        
        $data = [
            'mensaje' => 'evaluacion creada correctamente',
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
        return response()->json(Evaluacion::find($id));
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
        $evaluacion = Evaluacion::find($id);
        $evaluacion->calificacion = $request->calificacion;
        $evaluacion->servicio_id = $request->servicio_id;
        $evaluacion->save();
        $data = [
            'mensaje' => 'evaluacion actualizada correctamente',
            'evaluacion' => $evaluacion
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
        $evaluacion = Evaluacion::find($id);
        $evaluacion->delete();
        $data = [
        'mensaje' =>'evaluacion eliminada correctamente',
        'evaluacion' => $evaluacion
        ];
        return response()->json($data);
    }
}
