<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agendamiento;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Servicio;



class AgendamientoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendamientos = Agendamiento::all();
        return response()->json($agendamientos);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agendamiento = new Agendamiento();
        $agendamiento->hora = $request->hora;
        $agendamiento->estado = $request->estado;
        $agendamiento->fecha = $request->fecha;
        $agendamiento->servicios_id = $request->servicios_id;
        $tecnico_id = User::find($request->tecnicos_id)->tecnico->id;
        $agendamiento->tecnicos_id = $tecnico_id;
        $agendamiento->save();
        $data = [
            'mensaje' => 'agendamiento creado correctamente',
            'agendamiento' => $agendamiento
        ];
        return response()->json($agendamiento);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Agendamiento::find($id));
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
        $agendamiento = Agendamiento::find($id);
        $agendamiento->hora = $request->hora;
        $agendamiento->estado = $request->estado;
        $agendamiento->fecha = $request->fecha;
        $agendamiento->save();
        $data = [
            'mensaje' => 'agendamiento actualizado correctamente',
            'agendamiento' => $agendamiento
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
        $agendamiento = Agendamiento::find($id);
        $agendamiento->delete();
        $data = [
            'mensaje' => 'agendamiento eliminado correctamente',
            'agendamiento' => $agendamiento
        ];
        return response()->json($data);

    }


    public function getByServicioId($id)
    {

        $servicio = Servicio::find($id);
        $agendamientos = $servicio->agendamiento;

        $data = array();
        return response()->json($agendamientos);
        /*foreach ($agendamientos as $ag) {
            $query = DB::table("agendamientos")
            ->where('servicios_id', '=', $servicio->id)
            ->where('estado', '!=', 'Ejecutado')->get();
            //->exists();

            array_push($data, $query);
            
            //$ag->calificar = !$query == 1 ? true : false;
            //array_push($data, $ag);
        }
        


        return response()->json($data);
        */
    }
}
