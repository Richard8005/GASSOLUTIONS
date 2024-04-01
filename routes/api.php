<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClienteApiController;
use App\Http\Controllers\API\TipoApiController;
use App\Http\Controllers\API\CiudadApiController;
use App\Http\Controllers\API\TecnicoApiController;
use App\Http\Controllers\API\CotizacionApiController;
use App\Http\Controllers\API\MaterialApiController;
use App\Http\Controllers\API\AgendamientoApiController;
use App\Http\Controllers\API\ServicioApiController;
use App\Http\Controllers\API\EvaluacionApiController;
use App\Http\Controllers\API\CotizacionMaterialApiController;
use App\Http\Controllers\API\EvidenciaApiController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signUp']);
    Route::post('/verificar-email', [AuthController::class, 'verificarEmail']);


    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
        Route::apiResource('cliente', ClienteApiController::class);
        Route::apiResource('tipo', TipoApiController::class);
        Route::apiResource('ciudad', CiudadApiController::class);
        Route::apiResource('tecnico', TecnicoApiController::class);
        Route::get('agenda/tecnico', [TecnicoApiController::class,'getAgendamientos']);
        Route::apiResource('cotizacion', CotizacionApiController::class);
        Route::apiResource('material', MaterialApiController::class);
        Route::apiResource('agendamiento', AgendamientoApiController::class);
        Route::apiResource('servicio', ServicioApiController::class);
        Route::apiResource('evaluacion', EvaluacionApiController::class);
        Route::apiResource('cotizacionmaterial', CotizacionMaterialApiController::class);
        Route::apiResource('evidencia', EvidenciaApiController::class);

        Route::get('agenda/ejecutar/{id}', [TecnicoApiController::class, 'terminarAgendamiento']);


        Route::get('/agendamiento-ver/{id}', [AgendamientoApiController::class, 'getByServicioId']);
    

        Route::get('/ver-calificacion', [TecnicoApiController::class, 'verCalificacion']);


        Route::get('/tecnicos-agenda/{id}', [ServicioApiController::class, 'getTecnicosAgendamiento']);

        Route::get('/get/tecnicos', [TecnicoApiController::class, 'getAll']);
        Route::get('/get/clientes', [ClienteApiController::class, 'getAll']);


        Route::get('/get/servicios', [ServicioApiController::class, 'serviciosByUserId']);


        Route::get('/servicios/tecnico', [ServicioApiController::class, 'getServiciosByTecnico']);
    });
});