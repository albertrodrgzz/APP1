<?php
/**
 * SIRH - Sistema Integrado de Gestión Administrativa
 * Punto de entrada principal para XAMPP
 * 
 * Este archivo redirige automáticamente al directorio público de Laravel
 * para que la aplicación funcione correctamente en XAMPP.
 */

// Verificar si el directorio public existe
if (!is_dir(__DIR__ . '/public')) {
    die('
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIRH - Error de Configuración</title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                margin: 0; 
                padding: 0; 
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .error-container {
                background: white;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                text-align: center;
                max-width: 500px;
            }
            .error-icon {
                font-size: 4rem;
                color: #dc3545;
                margin-bottom: 1rem;
            }
            h1 { color: #333; margin-bottom: 1rem; }
            p { color: #666; line-height: 1.6; }
            .code { 
                background: #f8f9fa; 
                padding: 1rem; 
                border-radius: 5px; 
                font-family: monospace; 
                margin: 1rem 0;
                border-left: 4px solid #dc3545;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <div class="error-icon">⚠️</div>
            <h1>Error de Configuración</h1>
            <p>No se encontró el directorio <strong>public</strong> de Laravel.</p>
            <p>Por favor, asegúrate de que la estructura del proyecto esté completa:</p>
            <div class="code">
                APP1/<br>
                ├── public/<br>
                ├── app/<br>
                ├── database/<br>
                └── ...
            </div>
            <p>Si acabas de clonar el proyecto, ejecuta:</p>
            <div class="code">composer install</div>
        </div>
    </body>
    </html>
    ');
}

// Verificar si el archivo index.php de Laravel existe
if (!file_exists(__DIR__ . '/public/index.php')) {
    die('
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIRH - Error de Configuración</title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                margin: 0; 
                padding: 0; 
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .error-container {
                background: white;
                padding: 2rem;
                border-radius: 10px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                text-align: center;
                max-width: 500px;
            }
            .error-icon {
                font-size: 4rem;
                color: #dc3545;
                margin-bottom: 1rem;
            }
            h1 { color: #333; margin-bottom: 1rem; }
            p { color: #666; line-height: 1.6; }
            .code { 
                background: #f8f9fa; 
                padding: 1rem; 
                border-radius: 5px; 
                font-family: monospace; 
                margin: 1rem 0;
                border-left: 4px solid #dc3545;
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <div class="error-icon">⚠️</div>
            <h1>Error de Configuración</h1>
            <p>No se encontró el archivo <strong>public/index.php</strong> de Laravel.</p>
            <p>Por favor, asegúrate de que la instalación de Laravel esté completa.</p>
            <p>Ejecuta los siguientes comandos:</p>
            <div class="code">
                composer install<br>
                php artisan key:generate<br>
                php artisan migrate<br>
                php artisan db:seed
            </div>
        </div>
    </body>
    </html>
    ');
}

// Verificar si el archivo .env existe
if (!file_exists(__DIR__ . '/.env')) {
    if (file_exists(__DIR__ . '/env.example')) {
        copy(__DIR__ . '/env.example', __DIR__ . '/.env');
    }
}

// Redirigir al directorio público de Laravel
$publicPath = rtrim($_SERVER['REQUEST_URI'], '/');
if (strpos($publicPath, '/public') === false) {
    $redirectUrl = '/public' . $publicPath;
    if ($publicPath === '') {
        $redirectUrl = '/public/';
    }
    
    // Usar JavaScript para redirección suave
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIRH - Cargando...</title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                margin: 0; 
                padding: 0; 
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .loading-container {
                background: white;
                padding: 3rem;
                border-radius: 15px;
                box-shadow: 0 15px 35px rgba(0,0,0,0.3);
                text-align: center;
                max-width: 400px;
            }
            .loading-icon {
                font-size: 4rem;
                color: #0d6efd;
                margin-bottom: 1rem;
                animation: spin 2s linear infinite;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            h1 { 
                color: #333; 
                margin-bottom: 1rem; 
                font-size: 2rem;
            }
            p { 
                color: #666; 
                line-height: 1.6; 
                margin-bottom: 2rem;
            }
            .progress-bar {
                width: 100%;
                height: 4px;
                background: #e9ecef;
                border-radius: 2px;
                overflow: hidden;
            }
            .progress-fill {
                height: 100%;
                background: linear-gradient(90deg, #0d6efd, #6610f2);
                border-radius: 2px;
                animation: progress 2s ease-in-out infinite;
            }
            @keyframes progress {
                0% { width: 0%; }
                50% { width: 70%; }
                100% { width: 100%; }
            }
        </style>
    </head>
    <body>
        <div class="loading-container">
            <div class="loading-icon">⚙️</div>
            <h1>SIRH</h1>
            <p>Sistema Integrado de Gestión Administrativa</p>
            <p>Cargando aplicación...</p>
            <div class="progress-bar">
                <div class="progress-fill"></div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "' . $redirectUrl . '";
            }, 2000);
        </script>
    </body>
    </html>
    ';
    exit;
}

// Si ya estamos en el directorio public, incluir el index.php de Laravel
if (strpos($_SERVER['REQUEST_URI'], '/public') !== false) {
    // Remover /public del REQUEST_URI para que Laravel funcione correctamente
    $_SERVER['REQUEST_URI'] = str_replace('/public', '', $_SERVER['REQUEST_URI']);
    if ($_SERVER['REQUEST_URI'] === '') {
        $_SERVER['REQUEST_URI'] = '/';
    }
    
    // Incluir el index.php de Laravel
    require_once __DIR__ . '/public/index.php';
}
?>

