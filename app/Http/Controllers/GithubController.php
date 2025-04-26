<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GithubController extends Controller
{
    /**
     * Obtiene los repositorios de un usuario de GitHub.
     *
     * @param  string  $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserRepositories($username)
    {
        try {
            // Petición a la API de GitHub para obtener los repositorios del usuario
            $response = Http::get("https://api.github.com/users/{$username}/repos");

            // Verificar si la petición fue exitosa
            if ($response->successful()) {
                // Extraer solo la información necesaria de cada repositorio
                $repositories = collect($response->json())->map(function ($repo) {
                    return [
                        'name' => $repo['name'],
                        'full_name' => $repo['full_name'],
                        'description' => $repo['description'],
                        'url' => $repo['html_url'],
                        'stars' => $repo['stargazers_count'],
                        'forks' => $repo['forks_count'],
                        'language' => $repo['language'],
                        'created_at' => $repo['created_at'],
                        'updated_at' => $repo['updated_at']
                    ];
                });

                return response()->json([
                    'username' => $username,
                    'repositories' => $repositories
                ]);
            }

            // Si el usuario no existe o hay otro error
            return response()->json([
                'error' => 'No se encontró el usuario o hubo un problema con la API de GitHub',
                'status' => $response->status()
            ], $response->status());

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al conectar con la API de GitHub',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
