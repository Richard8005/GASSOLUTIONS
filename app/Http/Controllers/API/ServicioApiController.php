<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Agendamiento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ServicioApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::with('ciudad','tipo')->get();
        return response()->json($servicios);
    }

    public function serviciosByUserId()
    {
        $user_id = Auth::user()->id;
        $cliente_id = Cliente::where('user_id', $user_id)->first()->id;
        $servicio = Servicio::where('cliente_id', $cliente_id)->get();

        $data = array();

        foreach ($servicio as $s) {
            $query = DB::table("agendamientos")
                ->where('servicios_id', '=', $s->id)
                ->where('estado', '!=', 'Ejecutado')
                ->exists();

            $s->calificar = !$query == 1 ? true : false;
            array_push($data, $s);
        }

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $cliente_id = Cliente::where('user_id', $user->id)->first()->id;
        $servicio = new Servicio();
        $servicio->direccion = $request->direccion;
        $servicio->hora = $request->hora;
        $servicio->fecha = $request->fecha;
        $servicio->tipos_id = $request->tipos_id;
        $servicio->ciudades_id = $request->ciudades_id;
        $servicio->cliente_id=  $cliente_id;
        $tecnico_id = User::find($request->tecnicos_id)->tecnico->id;
        $servicio->tecnicos_id = $tecnico_id;
        $servicio->save();
        $data = [
            'mensaje' => 'servicio creado correctamente',
            'servicio' => $servicio
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
        return response()->json(Servicio::find($id));
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
        $servicio = Servicio::find();
        $servicio->direccion = $request->direccion;
        $servicio->hora = $request->hora;
        $servicio->fecha = $request->fecha;
        $servicio->tipos_id = $request->tipos_id;
        $servicio->ciudades_id = $request->ciudades_id;
        $servicio->save();
        $data = [
            'mensaje' => 'servicio actualizado correctamente',
            'servicio' => $servicio
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
        $servicio = Servicio::find($id);
        $servicio->delete();
        $data = [
            'mensaje' => 'servicio eliminado correctamente',
            'servicio' => $servicio
        ];
        return response()->json($data);

    }

    public function getTecnicosAgendamiento($id)
    {
        $query = DB::table('agendamientos AS a')
                    ->join('tecnicos AS t', 't.id', '=', 'a.tecnicos_id')
                    ->join('users AS u', 'u.id', '=', 't.user_id')
                    ->select('a.hora', 'a.fecha', 'a.id', 'u.name')
                    ->where('a.estado', '=', 'ejecutado')
                    ->where('a.servicios_id', '=', $id)
                    ->get();


        return $query;  
    }

    public function getServiciosByTecnico()
    {
        $user = Auth::user();
        $servicios = Servicio::where("tecnicos_id", $user->tecnico->id)->get();
        return response()->json($servicios);
    }

   
}
