<?php

use App\Http\Controllers\GithubController;
use Illuminate\Support\Facades\Route;

// Ruta de prueba para verificar que la API está funcionando
Route::get("/test", function () {
    return response()->json([
        'message' => 'Hello World',
    ]);
});

// Ruta para obtener los repositorios de un usuario de GitHub
Route::get('/user/{username}', [GithubController::class, 'getUserRepositories']);