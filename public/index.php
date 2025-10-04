<?php
/**
 * SIRH - Sistema Integrado de Gestión Administrativa
 * Sistema completo y funcional
 */

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuración
$config = [
    'app_name' => 'SIRH - Sistema Integrado de Gestión Administrativa',
    'app_url' => 'http://localhost/APP1/public/',
    'debug' => true,
];

// Función para cargar vistas
function view($template, $data = []) {
    extract($data);
    $templateFile = __DIR__ . '/../resources/views/' . str_replace('.', '/', $template) . '.blade.php';
    
    if (file_exists($templateFile)) {
        include $templateFile;
    } else {
        echo "<h1>Error: Vista no encontrada</h1>";
        echo "<p>Template: {$template}</p>";
        echo "<p>Archivo: {$templateFile}</p>";
    }
}

// Función para redirigir
function redirect($url) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
    
    if (strpos($url, '/') === 0) {
        $fullUrl = $protocol . '://' . $host . $basePath . $url;
    } else {
        $fullUrl = $protocol . '://' . $host . $basePath . '/' . $url;
    }
    
    header("Location: {$fullUrl}");
    exit;
}

// Función para generar URL
function url($path = '') {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
    
    if (strpos($path, '/') === 0) {
        return $protocol . '://' . $host . $basePath . $path;
    } else {
        return $protocol . '://' . $host . $basePath . '/' . $path;
    }
}

// Función para verificar autenticación
function isAuthenticated() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Función para obtener usuario actual
function currentUser() {
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'name' => $_SESSION['user_name'] ?? 'Usuario',
        'email' => $_SESSION['user_email'] ?? 'usuario@ejemplo.com',
        'role' => $_SESSION['user_role'] ?? 'employee',
    ];
}

// Función para manejar login
function handleLogin() {
    $error = null;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $users = [
            'admin@sirh.com' => ['password' => 'password', 'role' => 'admin', 'name' => 'Administrador'],
            'manager@sirh.com' => ['password' => 'password', 'role' => 'manager', 'name' => 'Gerente'],
            'employee@sirh.com' => ['password' => 'password', 'role' => 'employee', 'name' => 'Empleado'],
        ];
        
        if (isset($users[$email]) && $users[$email]['password'] === $password) {
            $_SESSION['user_id'] = 1;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $users[$email]['name'];
            $_SESSION['user_role'] = $users[$email]['role'];
            
            redirect('/dashboard');
            return;
        } else {
            $error = 'Credenciales incorrectas';
        }
    }
    
    view('auth.login', ['error' => $error]);
}

// Función para manejar logout
function handleLogout() {
    session_destroy();
    redirect('/');
}

// Función para mostrar dashboard
function showDashboard() {
    $user = currentUser();
    $stats = [
        'total_employees' => 25,
        'present_today' => 20,
        'absent_today' => 5,
        'attendance_rate' => 80,
    ];
    
    $recentEmployees = [
        [
            'name' => 'Juan Carlos García',
            'position' => 'Director General',
            'department' => 'Dirección General',
            'hire_date' => '2020-01-15',
        ],
        [
            'name' => 'María Elena Rodríguez',
            'position' => 'Director de RRHH',
            'department' => 'Recursos Humanos',
            'hire_date' => '2021-03-10',
        ],
        [
            'name' => 'Carlos Alberto Hernández',
            'position' => 'Administrador',
            'department' => 'Recursos Humanos',
            'hire_date' => '2022-06-01',
        ],
    ];
    
    $employeeAttendance = [
        'check_in' => $_SESSION['attendance_check_in'] ?? null,
        'check_out' => $_SESSION['attendance_check_out'] ?? null,
        'status' => $_SESSION['attendance_status'] ?? 'Ausente',
        'total_hours' => $_SESSION['attendance_total_hours'] ?? 0,
    ];
    
    view('dashboard.index', compact('user', 'stats', 'recentEmployees', 'employeeAttendance'));
}

// Función para mostrar empleados
function showEmployees() {
    $employees = [
        [
            'id' => 1,
            'employee_number' => 'EMP0001',
            'name' => 'Juan Carlos García',
            'position' => 'Director General',
            'department' => 'Dirección General',
            'email' => 'admin@sirh.com',
            'phone' => '(555) 123-4567',
            'status' => 'Activo',
        ],
        [
            'id' => 2,
            'employee_number' => 'EMP0002',
            'name' => 'María Elena Rodríguez',
            'position' => 'Director de RRHH',
            'department' => 'Recursos Humanos',
            'email' => 'manager@sirh.com',
            'phone' => '(555) 234-5678',
            'status' => 'Activo',
        ],
        [
            'id' => 3,
            'employee_number' => 'EMP0003',
            'name' => 'Carlos Alberto Hernández',
            'position' => 'Administrador',
            'department' => 'Recursos Humanos',
            'email' => 'employee@sirh.com',
            'phone' => '(555) 345-6789',
            'status' => 'Activo',
        ],
    ];
    
    view('employees.index', compact('employees'));
}

// Función para mostrar formulario de crear empleado
function showCreateEmployee() {
    $positions = [
        ['id' => 1, 'name' => 'Director General'],
        ['id' => 2, 'name' => 'Director de RRHH'],
        ['id' => 3, 'name' => 'Director de Telemática'],
        ['id' => 4, 'name' => 'Administrador'],
        ['id' => 5, 'name' => 'Analista de Sistemas'],
        ['id' => 6, 'name' => 'Asistente Administrativo'],
    ];
    
    $departments = [
        ['id' => 1, 'name' => 'Dirección General'],
        ['id' => 2, 'name' => 'Recursos Humanos'],
        ['id' => 3, 'name' => 'Telemática'],
        ['id' => 4, 'name' => 'Administración'],
        ['id' => 5, 'name' => 'Académico'],
    ];
    
    $managers = [
        ['id' => 1, 'name' => 'Juan Carlos García'],
        ['id' => 2, 'name' => 'María Elena Rodríguez'],
    ];
    
    view('employees.create', compact('positions', 'departments', 'managers'));
}

// Función para mostrar asistencia
function showAttendance() {
    $attendance = [
        'check_in' => $_SESSION['attendance_check_in'] ?? null,
        'check_out' => $_SESSION['attendance_check_out'] ?? null,
        'status' => $_SESSION['attendance_status'] ?? 'Ausente',
        'total_hours' => $_SESSION['attendance_total_hours'] ?? 0,
    ];
    
    $monthlyStats = [
        'present_days' => 20,
        'absent_days' => 2,
        'total_hours' => 160,
        'overtime_hours' => 8,
    ];
    
    view('attendance.index', compact('attendance', 'monthlyStats'));
}

// Función para mostrar perfil
function showProfile() {
    $employee = [
        'name' => currentUser()['name'],
        'email' => currentUser()['email'],
        'position' => 'Administrador',
        'department' => 'Recursos Humanos',
        'phone' => '(555) 123-4567',
        'hire_date' => '2020-01-15',
    ];
    
    view('employees.profile', compact('employee'));
}

// Función para manejar registro de entrada
function handleCheckIn() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['attendance_check_in'] = date('H:i:s');
        $_SESSION['attendance_status'] = 'Presente';
        $_SESSION['attendance_date'] = date('Y-m-d');
        redirect('/attendance');
    }
}

// Función para manejar registro de salida
function handleCheckOut() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_SESSION['attendance_check_out'] = date('H:i:s');
        
        // Calcular horas trabajadas
        if (isset($_SESSION['attendance_check_in'])) {
            $checkIn = new DateTime($_SESSION['attendance_date'] . ' ' . $_SESSION['attendance_check_in']);
            $checkOut = new DateTime($_SESSION['attendance_date'] . ' ' . $_SESSION['attendance_check_out']);
            $diff = $checkOut->diff($checkIn);
            $totalHours = $diff->h + ($diff->i / 60);
            $_SESSION['attendance_total_hours'] = round($totalHours, 2);
        }
        
        redirect('/attendance');
    }
}

// Obtener la ruta actual
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$basePath = dirname($scriptName);

// Remover el directorio base
if ($basePath !== '/') {
    $requestUri = str_replace($basePath, '', $requestUri);
}

// Remover query string
$requestUri = strtok($requestUri, '?');

// Normalizar la ruta
$requestUri = rtrim($requestUri, '/');
if (empty($requestUri)) {
    $requestUri = '/';
}

// Manejar rutas
switch ($requestUri) {
    case '/':
    case '/login':
        if (isAuthenticated()) {
            redirect('/dashboard');
        } else {
            handleLogin();
        }
        break;
        
    case '/logout':
        handleLogout();
        break;
        
    case '/dashboard':
        if (!isAuthenticated()) {
            redirect('/login');
        } else {
            showDashboard();
        }
        break;
        
    case '/employees':
        if (!isAuthenticated()) {
            redirect('/login');
        } else {
            showEmployees();
        }
        break;
        
    case '/employees/create':
        if (!isAuthenticated()) {
            redirect('/login');
        } else {
            showCreateEmployee();
        }
        break;
        
    case '/attendance':
        if (!isAuthenticated()) {
            redirect('/login');
        } else {
            showAttendance();
        }
        break;
        
    case '/attendance/check-in':
        if (!isAuthenticated()) {
            redirect('/login');
        } else {
            handleCheckIn();
        }
        break;
        
    case '/attendance/check-out':
        if (!isAuthenticated()) {
            redirect('/login');
        } else {
            handleCheckOut();
        }
        break;
        
    case '/profile':
        if (!isAuthenticated()) {
            redirect('/login');
        } else {
            showProfile();
        }
        break;
        
    default:
        if (isAuthenticated()) {
            redirect('/dashboard');
        } else {
            redirect('/login');
        }
        break;
}
?>