# Documentación de la API de Repo Trackr

Esta documentación proporciona detalles técnicos sobre los endpoints disponibles en la API de Repo Trackr, su uso y ejemplos de integración.

## Descripción general

Repo Trackr es una API que actúa como un intermediario (proxy) para consultar información de repositorios de GitHub. Proporciona endpoints para obtener datos sobre los repositorios públicos de cualquier usuario de GitHub en un formato simplificado y optimizado.

## Base URL

```
http://localhost:8000/api
```

En producción, reemplaza `localhost:8000` con tu dominio.

## Autenticación

Actualmente, la API no requiere autenticación para su uso. Sin embargo, ten en cuenta que la API de GitHub tiene límites de tasa para peticiones no autenticadas.

## Endpoints

### Prueba de conexión

```http
GET /test
```

Este endpoint permite verificar si la API está en funcionamiento.

#### Respuesta

```json
{
    "message": "Hello World"
}
```

Status: 200 OK

### Obtener repositorios de un usuario

```http
GET /user/{username}
```

Recupera la lista de repositorios públicos para el usuario de GitHub especificado.

#### Parámetros de ruta

| Parámetro | Tipo   | Descripción                 |
| --------- | ------ | --------------------------- |
| username  | string | Nombre de usuario de GitHub |

#### Parámetros de consulta

| Parámetro | Tipo   | Requerido | Descripción                       | Valores permitidos                  | Valor por defecto |
| --------- | ------ | --------- | --------------------------------- | ----------------------------------- | ----------------- |
| sort      | string | No        | Criterio de ordenación            | updated, created, pushed, full_name | updated           |
| direction | string | No        | Dirección de ordenamiento         | asc, desc                           | desc              |
| per_page  | int    | No        | Número de repositorios por página | 1-100                               | 30                |
| page      | int    | No        | Número de página                  | ≥ 1                                 | 1                 |

#### Ejemplo de solicitud

```http
GET /user/MrNizzy?sort=created&direction=asc&per_page=5
```

#### Respuesta exitosa

```json
{
    "username": "MrNizzy",
    "repositories": [
        {
            "name": "repo-trackr-laravel",
            "full_name": "MrNizzy/repo-trackr-laravel",
            "description": null,
            "url": "https://github.com/MrNizzy/repo-trackr-laravel",
            "stars": 0,
            "forks": 0,
            "language": "Blade",
            "created_at": "2025-04-26T06:18:23Z",
            "updated_at": "2025-04-26T19:14:37Z"
        }
        // ... más repositorios
    ]
}
```

Status: 200 OK

#### Respuesta de error - Usuario no encontrado

```json
{
    "error": "No se encontró el usuario o hubo un problema con la API de GitHub",
    "status": 404
}
```

Status: 404 Not Found

#### Respuesta de error - Error del servidor

```json
{
    "error": "Error al conectar con la API de GitHub",
    "message": "Detalles del error"
}
```

Status: 500 Internal Server Error

## Limitaciones

-   La API está sujeta a las mismas limitaciones de tasa (rate limits) que impone la API de GitHub.
-   Actualmente solo se proporcionan datos básicos de los repositorios. Información más detallada podría incluirse en versiones futuras.

## Ejemplos de uso

### cURL

```bash
curl -X GET "http://localhost:8000/api/user/MrNizzy?sort=updated&direction=desc&per_page=10"
```

### PHP

```php
<?php
$response = file_get_contents('http://localhost:8000/api/user/MrNizzy?per_page=5');
$data = json_decode($response, true);
echo "Número de repositorios: " . count($data['repositories']);
```

### JavaScript (Fetch API)

```javascript
fetch("http://localhost:8000/api/user/MrNizzy?per_page=5")
    .then((response) => response.json())
    .then((data) => {
        console.log(`Repositorios de ${data.username}:`, data.repositories);
    })
    .catch((error) => console.error("Error:", error));
```

## Errores comunes

| Código de estado | Descripción                                                                      |
| ---------------- | -------------------------------------------------------------------------------- |
| 404              | Usuario no encontrado en GitHub                                                  |
| 500              | Error en el servidor o al comunicarse con la API de GitHub                       |
| 429              | Demasiadas peticiones (si se ha alcanzado el límite de tasa de la API de GitHub) |

## Desarrollo futuro

Posibles mejoras para futuras versiones:

-   Autenticación con token de GitHub para aumentar los límites de tasa
-   Endpoint para buscar repositorios por nombre
-   Información detallada de un repositorio específico
-   Estadísticas de commits
-   Información sobre contribuidores
