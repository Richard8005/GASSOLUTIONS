<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function getAll(){

        $tecnicos = DB::table('clientes AS c')
            ->join('users AS u', 'c.user_id', '=', 'u.id')
            ->select('c.*', 'u.*', 'u.name AS nombre')
            ->get();
        return response()->json($tecnicos);
    }

    public function index()
    {
        $clientes = Cliente::All();
        return response()->json($clientes);
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
        $cliente = new Cliente();
        $user->name = $request->nombre;
        $user->password = bcrypt($request->contrasena);
        $user->email= $request->correo; 
        $user->save();
        $cliente->direccion= $request->direccion; 
        $cliente->telefono= $request->telefono; 
        $cliente->user_id = $user->id;
        $cliente->save();
        $data = [
            'mensaje' => 'cliente creado correctamente',
            'cliente' => $cliente
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
        $cliente = Cliente::find($id);

        return response()->json([
            "name" => $cliente->user->name,
            "telefono" => strval($cliente->telefono)
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
    {
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
                "password" => bcrypt($request->contrasena)
            ]);

        }
        
        $cliente = Cliente::where('user_id', $id);
        
        
        $cliente->update([
            "direccion"=>$request->direccion,
            "telefono"=> $request->telefono, 
        ]);
        $data = [
            'mensaje' => 'cliente actualizado correctamente',
            'cliente' => $cliente
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
        $user = User::find($id);
        $cliente = Cliente::where('user_id', $user->id);
        $cliente->delete();
        $user->delete();
        $data = [
            'mensaje' => 'cliente eliminado correctamente',
            'cliente' => $cliente
        ];
        return response()->json($data);

    }
}
