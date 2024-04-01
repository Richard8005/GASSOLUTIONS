<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tecnico;
use App\Models\Evaluacion;
use App\Models\User;
use App\Models\Agendamiento;
use App\Models\Servicio;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class TecnicoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(){

        $tecnicos = DB::table('tecnicos AS t')
            ->join('users AS u', 't.user_id', '=', 'u.id')
            ->select('t.*', 'u.*', 'u.name AS nombre')
            ->get();
        return response()->json($tecnicos);
    }

    
    public function index()
    {
        $query = DB::table('tecnicos AS t')
            ->join('agendamientos AS a', 't.id', '=', 'a.tecnicos_id')
            ->join('users AS u', 'u.id', '=', 't.user_id')
            ->select('t.direccion', 't.telefono', 't.id', 'u.name')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('agendamientos AS b')
                    ->whereRaw('b.tecnicos_id = t.id')
                    ->where('b.estado', '=', 'pendiente');
            })
            ->where('a.estado', '=', 'ejecutado')
            ->distinct()
            ->get();

        return response()->json($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $tecnico = new Tecnico();
        $user->name = $request->nombre;
        $user->password = bcrypt($request->contrasena);
        $user->email= $request->email; 
        $user->save();
        $tecnico->direccion= $request->direccion; 
        $tecnico->telefono= $request->telefono; 
        $tecnico->user_id = $user->id;
        $tecnico->save();
        $data = [
            'mensaje' => 'tecnico creado correctamente',
            'tecnico' => $tecnico
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
        $tecnico = Tecnico::find($id);
        return response()->json([
            "nombre" =>$tecnico->user->name,
            "telefono" =>strval($tecnico->telefono)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { $user = User::find($id);
        $user = User::find($id);
        if (empty($request->contrasena)) {
            $user->update([
                "email"=>$request->correo,
                "name" =>$request->nombre,
            ]);
        } else {
            $user->update([
                "email"=>$request->correo,
                "name" =>$request->nombre,
                "password" => $request->contrasena
            ]);

        }
        
        $tecnico = Tecnico::where('user_id', $id);
        
        
        $tecnico->update([
            "direccion"=>$request->direccion,
            "telefono"=> $request->telefono, 
        ]);
        $data = [
            'mensaje' => 'tecnico actualizado correctamente',
            'tecnico' => $tecnico
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
    {$user = User::find($id);
        $tecnico = Tecnico::where('user_id', $user->id);
        $tecnico->delete();
        $user->delete();
        $data = [
            'mensaje' => 'tecnico eliminado correctamente',
            'tecnico' => $tecnico
        ];
        return response()->json($data);
    }

    public function getAgendamientos() {
        $user=Auth::user();
        //return response()->json($user->tecnico->id);
        $agentamiento = [
            "id" => null,
            "hora" => null,
            "estado" => null,
            "fecha" => null,
            "direccion" => null,
            "tipoServicio" => null,
            "nombreCliente" => null,
            "telefono" => null
        ];
        $agendamientos = Agendamiento::where('tecnicos_id',$user->tecnico->id)->get();
        $data = array();
        foreach ($agendamientos as $ag) {
            $servicio = $ag->servicio;
            $direccion = $servicio->direccion;
            $tipoServicio = $servicio->tipo->descripcion;
            $agentamiento["id"] = $ag->id;
            $agentamiento["hora"] = $ag->hora;
            $agentamiento["estado"] = $ag->estado;
            $agentamiento["fecha"] = $ag->fecha;
            $agentamiento["direccion"] = $direccion;
            $agentamiento["tipoServicio"] = $tipoServicio;
            $nombreCliente = Cliente::find($ag->servicio->cliente_id)->user->name;
            $agentamiento["nombreCliente"] = $nombreCliente;
            $agentamiento["telefono"] = strval(Cliente::find($ag->servicio->cliente_id)->telefono);

            array_push($data, $agentamiento);
        }
        return response()->json($data);
    }

    public function terminarAgendamiento($id){
        $agentamiento = Agendamiento::find($id);
        $agentamiento->estado = "Ejecutado";
        $agentamiento->update();
        return response()->json("Agendamiento terminado");
    }

    public function terminarServicio($id){
        $servicio = Servcio::find($id);
        $agentamiento->estado = "Ejecutado";
        $agentamiento->update();
        return response()->json("Agendamiento terminado");
    }

    public function verCalificacion(){
        $user = Auth::user();
        $tecnico = $user->tecnico;
        $agendamientos = Agendamiento::where('tecnicos_id', $tecnico->id)
            ->where('estado', 'Ejecutado')->distinct()->get();
        
        $califcacionTotal = 0;
        if (count($agendamientos) < 1) {
            return response()->json([ "calificacion" => 0.0]);       
            
        }
        $contador = 0;
        foreach ($agendamientos as $ag) {
            $eval = Evaluacion::where('agendamientos_id', $ag->id)->first();
            if (!$eval) {
                continue;
            }
            $califcacionTotal += $eval->calificacion; 
            $contador++; 
        }

        $contador = $contador==0 ? 1 : $contador; 
        return response()->json([ "calificacion" => $califcacionTotal/$contador]);       
    }
}
