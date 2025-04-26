<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Repo Trackr Laravel

Repo Trackr es una API desarrollada en Laravel que permite consultar y obtener información sobre repositorios de GitHub para cualquier usuario.

## Documentación de la API

### Endpoints disponibles

#### Prueba de conexión

```
GET /api/test
```

Retorna un mensaje simple para verificar que la API está funcionando correctamente.

**Respuesta:**

```json
{
    "message": "Hello World"
}
```

#### Obtener repositorios de usuario

```
GET /api/user/{username}
```

Retorna información sobre los repositorios públicos de un usuario específico de GitHub.

**Parámetros de URL:**

-   `username` (obligatorio): Nombre de usuario de GitHub

**Parámetros de consulta (opcionales):**

-   `sort`: Criterio de ordenación de los repositorios (valores posibles: `updated`, `created`, `pushed`, `full_name`). Por defecto: `updated`
-   `direction`: Dirección del ordenamiento (valores posibles: `asc`, `desc`). Por defecto: `desc`
-   `per_page`: Número de repositorios por página. Por defecto: `30`
-   `page`: Número de página a mostrar. Por defecto: `1`

**Ejemplo de solicitud:**

```
GET /api/user/MrNizzy?sort=created&direction=asc&per_page=10&page=1
```

**Respuesta exitosa:**

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

**Respuesta de error:**

```json
{
    "error": "No se encontró el usuario o hubo un problema con la API de GitHub",
    "status": 404
}
```

## Instalación y configuración

1. Clona este repositorio

```bash
git clone https://github.com/tu-usuario/repo-trackr-laravel.git
cd repo-trackr-laravel
```

2. Instala las dependencias

```bash
composer install
```

3. Copia el archivo .env.example a .env

```bash
cp .env.example .env
```

4. Genera la clave de la aplicación

```bash
php artisan key:generate
```

5. Inicia el servidor de desarrollo

```bash
php artisan serve
```

## Tecnologías utilizadas

-   Laravel 10.x
-   PHP 8.2+
-   GitHub API

## Contribuir

Las contribuciones son bienvenidas. Para cambios importantes, abra primero un issue para discutir lo que le gustaría cambiar.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development/)**
-   **[Active Logic](https://activelogic.com)**

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
