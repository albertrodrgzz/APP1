<?php
/**
 * SIRH - Configuración Automática para XAMPP
 * 
 * Este archivo ayuda a configurar automáticamente el sistema SIRH en XAMPP
 * Verifica requisitos y proporciona instrucciones de instalación.
 */

// Configuración de errores para desarrollo
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Función para verificar requisitos
function checkRequirements() {
    $requirements = [
        'PHP Version >= 8.1' => version_compare(PHP_VERSION, '8.1.0', '>='),
        'PDO Extension' => extension_loaded('pdo'),
        'PDO MySQL' => extension_loaded('pdo_mysql'),
        'OpenSSL' => extension_loaded('openssl'),
        'Mbstring' => extension_loaded('mbstring'),
        'Tokenizer' => extension_loaded('tokenizer'),
        'XML' => extension_loaded('xml'),
        'Ctype' => extension_loaded('ctype'),
        'JSON' => extension_loaded('json'),
        'BCMath' => extension_loaded('bcmath'),
        'Fileinfo' => extension_loaded('fileinfo'),
        'cURL' => extension_loaded('curl'),
    ];
    
    return $requirements;
}

// Función para verificar estructura de archivos
function checkFileStructure() {
    $requiredFiles = [
        'public/index.php' => 'Archivo principal de Laravel',
        'composer.json' => 'Configuración de Composer',
        'env.example' => 'Archivo de configuración de ejemplo',
        'database/migrations' => 'Directorio de migraciones',
        'app/Models' => 'Directorio de modelos',
        'resources/views' => 'Directorio de vistas',
    ];
    
    $structure = [];
    foreach ($requiredFiles as $file => $description) {
        $structure[$file] = [
            'exists' => file_exists($file),
            'description' => $description
        ];
    }
    
    return $structure;
}

// Función para generar instrucciones de instalación
function generateInstallationInstructions() {
    $instructions = [
        '1. Instalar Composer' => 'Descargar e instalar Composer desde https://getcomposer.org/',
        '2. Instalar dependencias' => 'Ejecutar: composer install',
        '3. Configurar base de datos' => 'Crear base de datos "sirh_app" en phpMyAdmin',
        '4. Configurar variables' => 'Copiar env.example a .env y configurar la base de datos',
        '5. Generar clave' => 'Ejecutar: php artisan key:generate',
        '6. Ejecutar migraciones' => 'Ejecutar: php artisan migrate',
        '7. Poblar datos' => 'Ejecutar: php artisan db:seed',
        '8. Configurar permisos' => 'Dar permisos de escritura a storage/ y bootstrap/cache/',
    ];
    
    return $instructions;
}

$requirements = checkRequirements();
$fileStructure = checkFileStructure();
$instructions = generateInstallationInstructions();
$allRequirementsMet = !in_array(false, $requirements);
$allFilesExist = !in_array(false, array_column($fileStructure, 'exists'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRH - Configuración XAMPP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .content {
            padding: 2rem;
        }
        
        .section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid #0d6efd;
            background: #f8f9fa;
        }
        
        .section h2 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .requirement-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .requirement-item:last-child {
            border-bottom: none;
        }
        
        .status {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        
        .status.success {
            background: #d4edda;
            color: #155724;
        }
        
        .status.error {
            background: #f8d7da;
            color: #721c24;
        }
        
        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .file-item:last-child {
            border-bottom: none;
        }
        
        .instructions {
            background: #e7f3ff;
            border-left-color: #0dcaf0;
        }
        
        .instructions ol {
            padding-left: 1.5rem;
        }
        
        .instructions li {
            margin-bottom: 0.5rem;
            line-height: 1.6;
        }
        
        .command {
            background: #2d3748;
            color: #e2e8f0;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            margin: 0.5rem 0;
            display: inline-block;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .alert-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }
        
        .alert-warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
        }
        
        .alert-danger {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
        
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0.5rem 0.5rem 0.5rem 0;
        }
        
        .btn:hover {
            background: #0b5ed7;
            transform: translateY(-2px);
        }
        
        .btn-success {
            background: #198754;
        }
        
        .btn-success:hover {
            background: #157347;
        }
        
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 10px;
            }
            
            .header {
                padding: 1.5rem;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏢 SIRH</h1>
            <p>Sistema Integrado de Gestión Administrativa - Configuración XAMPP</p>
        </div>
        
        <div class="content">
            <?php if ($allRequirementsMet && $allFilesExist): ?>
                <div class="alert alert-success">
                    <strong>✅ ¡Configuración Completa!</strong><br>
                    Todos los requisitos están cumplidos y la estructura de archivos es correcta.
                    Puedes proceder a acceder a la aplicación.
                </div>
                <div style="text-align: center;">
                    <a href="public/" class="btn btn-success">🚀 Acceder a SIRH</a>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    <strong>⚠️ Configuración Pendiente</strong><br>
                    Algunos requisitos no están cumplidos o faltan archivos. Sigue las instrucciones a continuación.
                </div>
            <?php endif; ?>
            
            <div class="grid">
                <div class="section">
                    <h2>🔧 Requisitos del Sistema</h2>
                    <?php foreach ($requirements as $requirement => $status): ?>
                        <div class="requirement-item">
                            <span><?php echo $requirement; ?></span>
                            <span class="status <?php echo $status ? 'success' : 'error'; ?>">
                                <?php echo $status ? '✅ OK' : '❌ FALTA'; ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="section">
                    <h2>📁 Estructura de Archivos</h2>
                    <?php foreach ($fileStructure as $file => $info): ?>
                        <div class="file-item">
                            <span><?php echo $file; ?></span>
                            <span class="status <?php echo $info['exists'] ? 'success' : 'error'; ?>">
                                <?php echo $info['exists'] ? '✅' : '❌'; ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="section instructions">
                <h2>📋 Instrucciones de Instalación</h2>
                <ol>
                    <?php foreach ($instructions as $step => $instruction): ?>
                        <li>
                            <strong><?php echo $step; ?></strong><br>
                            <?php echo $instruction; ?>
                        </li>
                    <?php endforeach; ?>
                </ol>
                
                <div style="margin-top: 1rem;">
                    <h3>Comandos para ejecutar en la terminal:</h3>
                    <div class="command">composer install</div>
                    <div class="command">php artisan key:generate</div>
                    <div class="command">php artisan migrate</div>
                    <div class="command">php artisan db:seed</div>
                </div>
            </div>
            
            <div class="section">
                <h2>🌐 Acceso a la Aplicación</h2>
                <p>Una vez completada la instalación, puedes acceder a la aplicación en:</p>
                <div class="command">http://localhost/APP1/public/</div>
                
                <h3>Usuarios de Prueba:</h3>
                <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                    <li><strong>Administrador:</strong> admin@sirh.com / password</li>
                    <li><strong>Gerente:</strong> manager@sirh.com / password</li>
                    <li><strong>Empleado:</strong> employee@sirh.com / password</li>
                </ul>
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="public/" class="btn">🔗 Ir a la Aplicación</a>
                <a href="index.php" class="btn">🔄 Verificar Nuevamente</a>
            </div>
        </div>
    </div>
</body>
</html>

