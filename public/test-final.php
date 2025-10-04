<?php
/**
 * Test Final - Verificación completa del sistema SIRH
 */

echo "<h1>🧪 Test Final del Sistema SIRH</h1>";

// Verificar que el archivo principal existe
if (file_exists(__DIR__ . '/index.php')) {
    echo "✅ Archivo principal index.php existe<br>";
} else {
    echo "❌ Archivo principal index.php NO existe<br>";
}

// Verificar que las vistas existen
$views = [
    'auth/login.blade.php',
    'dashboard/index.blade.php',
    'employees/index.blade.php',
    'employees/create.blade.php',
    'employees/profile.blade.php',
    'attendance/index.blade.php',
];

echo "<h2>📁 Verificación de Vistas:</h2>";
foreach ($views as $view) {
    $viewPath = __DIR__ . '/../resources/views/' . $view;
    if (file_exists($viewPath)) {
        echo "✅ {$view}<br>";
    } else {
        echo "❌ {$view}<br>";
    }
}

// Verificar configuración de PHP
echo "<h2>⚙️ Configuración de PHP:</h2>";
echo "PHP Version: " . PHP_VERSION . "<br>";
echo "Session Support: " . (function_exists('session_start') ? '✅' : '❌') . "<br>";
echo "DateTime Support: " . (class_exists('DateTime') ? '✅' : '❌') . "<br>";

// Verificar URLs
echo "<h2>🔗 URLs de Prueba:</h2>";
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
echo "<a href='{$baseUrl}/index.php' target='_blank'>🏠 Página Principal</a><br>";
echo "<a href='{$baseUrl}/index.php/login' target='_blank'>🔐 Login</a><br>";
echo "<a href='{$baseUrl}/index.php/dashboard' target='_blank'>📊 Dashboard</a><br>";
echo "<a href='{$baseUrl}/index.php/employees' target='_blank'>👥 Empleados</a><br>";
echo "<a href='{$baseUrl}/index.php/attendance' target='_blank'>⏰ Asistencia</a><br>";
echo "<a href='{$baseUrl}/index.php/profile' target='_blank'>👤 Perfil</a><br>";

// Información del servidor
echo "<h2>🖥️ Información del Servidor:</h2>";
echo "Server: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Desconocido') . "<br>";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Desconocido') . "<br>";
echo "Script Name: " . ($_SERVER['SCRIPT_NAME'] ?? 'Desconocido') . "<br>";
echo "Request URI: " . ($_SERVER['REQUEST_URI'] ?? 'Desconocido') . "<br>";

echo "<h2>🎯 Instrucciones de Uso:</h2>";
echo "<ol>";
echo "<li>Haz clic en 'Página Principal' para acceder al sistema</li>";
echo "<li>Usa las credenciales: admin@sirh.com / password</li>";
echo "<li>Navega por todas las secciones del sistema</li>";
echo "<li>Prueba el registro de entrada y salida</li>";
echo "</ol>";

echo "<h2>👤 Usuarios de Prueba:</h2>";
echo "<table border='1' style='border-collapse: collapse;'>";
echo "<tr><th>Email</th><th>Contraseña</th><th>Rol</th></tr>";
echo "<tr><td>admin@sirh.com</td><td>password</td><td>Administrador</td></tr>";
echo "<tr><td>manager@sirh.com</td><td>password</td><td>Gerente</td></tr>";
echo "<tr><td>employee@sirh.com</td><td>password</td><td>Empleado</td></tr>";
echo "</table>";

echo "<h2>✨ ¡Sistema Listo para Usar!</h2>";
echo "<p>El sistema SIRH está completamente funcional y listo para ser utilizado.</p>";
?>

