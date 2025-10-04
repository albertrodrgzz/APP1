<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIRH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.15); }
        .stats-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .stats-card .card-body { padding: 2rem; }
        .stats-number { font-size: 2.5rem; font-weight: bold; margin-bottom: 0.5rem; }
        .stats-label { font-size: 0.9rem; opacity: 0.9; }
        .btn-action { border-radius: 10px; padding: 0.75rem 1.5rem; font-weight: 600; transition: all 0.3s ease; }
        .btn-action:hover { transform: translateY(-2px); }
        .table { border-radius: 10px; overflow: hidden; }
        .table thead th { background: #f8f9fa; border: none; font-weight: 600; color: #495057; }
        .table tbody tr:hover { background-color: rgba(0,123,255,0.05); }
        .badge { border-radius: 20px; padding: 0.5rem 1rem; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo url('/dashboard'); ?>">
                <i class="bi bi-building"></i> SIRH
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?php echo url('/dashboard'); ?>">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo url('/employees'); ?>">
                            <i class="bi bi-people"></i> Empleados
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo url('/attendance'); ?>">
                            <i class="bi bi-clock"></i> Asistencia
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo url('/profile'); ?>">
                            <i class="bi bi-person"></i> Mi Perfil
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> <?php echo $user['name']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo url('/profile'); ?>">
                                <i class="bi bi-person"></i> Mi Perfil
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo url('/logout'); ?>">
                                <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h1 class="h3 mb-4">
                    <i class="bi bi-house"></i> Dashboard
                    <small class="text-muted">Bienvenido, <?php echo $user['name']; ?></small>
                </h1>
            </div>
        </div>
        
        <!-- Estadísticas Generales -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-number"><?php echo $stats['total_employees']; ?></div>
                        <div class="stats-label">Total Empleados</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-number"><?php echo $stats['present_today']; ?></div>
                        <div class="stats-label">Presentes Hoy</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-number"><?php echo $stats['absent_today']; ?></div>
                        <div class="stats-label">Ausentes Hoy</div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <div class="stats-number"><?php echo $stats['attendance_rate']; ?>%</div>
                        <div class="stats-label">Asistencia</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Mi Asistencia de Hoy -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-clock"></i> Mi Asistencia de Hoy</h5>
                    </div>
                    <div class="card-body text-center">
                        <?php if (isset($employeeAttendance) && $employeeAttendance['check_in']): ?>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="card border-success">
                                        <div class="card-body">
                                            <h5 class="card-title text-success">Entrada</h5>
                                            <h3 class="text-success"><?php echo $employeeAttendance['check_in']; ?></h3>
                                            <small class="text-muted"><?php echo date('d/m/Y'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-info">
                                        <div class="card-body">
                                            <h5 class="card-title text-info">Salida</h5>
                                            <h3 class="text-info"><?php echo $employeeAttendance['check_out'] ?: '--:--:--'; ?></h3>
                                            <small class="text-muted"><?php echo date('d/m/Y'); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-6">
                                    <strong>Estado:</strong><br>
                                    <span class="badge bg-success fs-6"><?php echo $employeeAttendance['status']; ?></span>
                                </div>
                                <div class="col-6">
                                    <strong>Horas Trabajadas:</strong><br>
                                    <span class="text-primary fs-5"><?php echo $employeeAttendance['total_hours']; ?> hrs</span>
                                </div>
                            </div>
                            
                            <?php if (!$employeeAttendance['check_out']): ?>
                                <a href="<?php echo url('/attendance'); ?>" class="btn btn-danger btn-lg">
                                    <i class="bi bi-box-arrow-right"></i> Registrar Salida
                                </a>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    <i class="bi bi-info-circle"></i> Ya has completado tu jornada laboral de hoy.
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="py-5">
                                <i class="bi bi-clock text-muted" style="font-size: 4rem;"></i>
                                <h4 class="text-muted mt-3">No has registrado entrada</h4>
                                <p class="text-muted">Haz clic en el botón para registrar tu entrada</p>
                                <a href="<?php echo url('/attendance'); ?>" class="btn btn-success btn-lg">
                                    <i class="bi bi-box-arrow-in-right"></i> Registrar Entrada
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Accesos Rápidos -->
            <div class="col-lg-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-lightning"></i> Accesos Rápidos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <a href="<?php echo url('/attendance'); ?>" class="btn btn-outline-primary btn-action w-100">
                                    <i class="bi bi-clock"></i><br>
                                    <small>Asistencia</small>
                                </a>
                            </div>
                            <div class="col-6 mb-3">
                                <a href="<?php echo url('/profile'); ?>" class="btn btn-outline-success btn-action w-100">
                                    <i class="bi bi-person"></i><br>
                                    <small>Mi Perfil</small>
                                </a>
                            </div>
                            <div class="col-6 mb-3">
                                <a href="<?php echo url('/employees'); ?>" class="btn btn-outline-info btn-action w-100">
                                    <i class="bi bi-people"></i><br>
                                    <small>Empleados</small>
                                </a>
                            </div>
                            <div class="col-6 mb-3">
                                <a href="<?php echo url('/attendance'); ?>" class="btn btn-outline-warning btn-action w-100">
                                    <i class="bi bi-calendar"></i><br>
                                    <small>Historial</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Empleados Recientes -->
        <?php if (isset($recentEmployees) && !empty($recentEmployees)): ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-person-plus"></i> Empleados Recientes</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Departamento</th>
                                        <th>Fecha de Ingreso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentEmployees as $employee): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-primary me-2">
                                                    <?php echo substr($employee['name'], 0, 2); ?>
                                                </div>
                                                <div>
                                                    <strong><?php echo $employee['name']; ?></strong>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?php echo $employee['position']; ?></td>
                                        <td><?php echo $employee['department']; ?></td>
                                        <td><?php echo $employee['hire_date']; ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>