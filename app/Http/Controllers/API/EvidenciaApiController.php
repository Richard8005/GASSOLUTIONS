<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evidencia;

class EvidenciaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evidencias = Evidencia::all();
        return response()->json($evidencias);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $evidencia = new Evidencia();
        $evidencia->url_foto = $request->url_foto;
        $evidencia->agendamiento_id = $request->agendamiento_id;
        $evidencia->save();
        $data = [
            'mensaje' => 'evidencia creada correctamente',
            'evidencia' => $evidencia
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
        return response()->json(Evidencia::find($id));

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
        $evidencia = Evidencia::find($id);
        $evidencia->url_foto = $request->url_foto;
        $evidencia->agendamiento_id = $request->agendamiento_id;
        $evidencia->save();
        $data = [
            'mensaje' => 'evidencia actualizada correctamente',
            'evidencia' => $evidencia
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
        $evidencia = Evidencia::find($id);
        $evidencia->delete();
        $data = [
        'mensaje' =>'evidencia eliminado correctamente',
        'evidencia' => $evidencia
        ];
        return response()->json($data);

    }
}
