<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Asistencia - SIRH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .attendance-card { transition: all 0.3s ease; }
        .attendance-card:hover { transform: translateY(-5px); }
        .btn-action { border-radius: 10px; padding: 0.75rem 1.5rem; font-weight: 600; }
        .stats-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .stats-card .card-body { padding: 2rem; }
        .stats-number { font-size: 2.5rem; font-weight: bold; }
        .stats-label { font-size: 0.9rem; opacity: 0.9; }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo url('/dashboard'); ?>"><i class="bi bi-building"></i> SIRH</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo url('/dashboard'); ?>"><i class="bi bi-house"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo url('/employees'); ?>"><i class="bi bi-people"></i> Empleados</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo url('/attendance'); ?>"><i class="bi bi-clock"></i> Asistencia</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo url('/profile'); ?>"><i class="bi bi-person"></i> Mi Perfil</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> Usuario
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo url('/profile'); ?>"><i class="bi bi-person"></i> Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo url('/logout'); ?>"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a></li>
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
                <h1 class="h3 mb-4"><i class="bi bi-clock"></i> Control de Asistencia</h1>
            </div>
        </div>
        
        <div class="row">
            <!-- Registro de Asistencia -->
            <div class="col-lg-6 mb-4">
                <div class="card attendance-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-calendar-check"></i> Registro de Hoy</h5>
                    </div>
                    <div class="card-body text-center">
                        <?php if ($attendance['check_in']): ?>
                            <div class="row mb-4">
                                <div class="col-6">
                                    <div class="card border-success">
                                        <div class="card-body">
                                            <h5 class="card-title text-success">Entrada</h5>
                                            <h3 class="text-success"><?php echo $attendance['check_in']; ?></h3>
                                            <small class="text-muted"><?php echo date('d/m/Y'); ?></small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border-info">
                                        <div class="card-body">
                                            <h5 class="card-title text-info">Salida</h5>
                                            <h3 class="text-info"><?php echo $attendance['check_out'] ?: '--:--:--'; ?></h3>
                                            <small class="text-muted"><?php echo date('d/m/Y'); ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-6">
                                    <strong>Estado:</strong><br>
                                    <span class="badge bg-success fs-6"><?php echo $attendance['status']; ?></span>
                                </div>
                                <div class="col-6">
                                    <strong>Horas Trabajadas:</strong><br>
                                    <span class="text-primary fs-5"><?php echo $attendance['total_hours']; ?> hrs</span>
                                </div>
                            </div>
                            
                            <?php if (!$attendance['check_out']): ?>
                                <form method="POST" action="<?php echo url('/attendance/check-out'); ?>" class="d-inline">
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        <i class="bi bi-box-arrow-right"></i> Registrar Salida
                                    </button>
                                </form>
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
                                <form method="POST" action="<?php echo url('/attendance/check-in'); ?>" class="d-inline">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="bi bi-box-arrow-in-right"></i> Registrar Entrada
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Estadísticas del Mes -->
            <div class="col-lg-6 mb-4">
                <div class="card attendance-card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-graph-up"></i> Estadísticas del Mes</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <h5 class="text-primary"><?php echo $monthlyStats['present_days']; ?></h5>
                                        <small class="text-muted">Días Presentes</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="card border-warning">
                                    <div class="card-body">
                                        <h5 class="text-warning"><?php echo $monthlyStats['absent_days']; ?></h5>
                                        <small class="text-muted">Días Ausentes</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="card border-info">
                                    <div class="card-body">
                                        <h5 class="text-info"><?php echo $monthlyStats['total_hours']; ?></h5>
                                        <small class="text-muted">Horas Totales</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="card border-success">
                                    <div class="card-body">
                                        <h5 class="text-success"><?php echo $monthlyStats['overtime_hours']; ?></h5>
                                        <small class="text-muted">Horas Extra</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <div class="d-flex justify-content-between">
                                <span>Progreso del Mes:</span>
                                <span><?php echo $monthlyStats['present_days'] + $monthlyStats['absent_days']; ?> días</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Accesos Rápidos -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-lightning"></i> Accesos Rápidos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo url('/attendance'); ?>" class="btn btn-outline-primary btn-action w-100">
                                    <i class="bi bi-calendar"></i><br>
                                    <small>Historial</small>
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo url('/attendance'); ?>" class="btn btn-outline-info btn-action w-100">
                                    <i class="bi bi-graph-up"></i><br>
                                    <small>Reportes</small>
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo url('/profile'); ?>" class="btn btn-outline-success btn-action w-100">
                                    <i class="bi bi-person"></i><br>
                                    <small>Mi Perfil</small>
                                </a>
                            </div>
                            <div class="col-md-3 mb-3">
                                <a href="<?php echo url('/dashboard'); ?>" class="btn btn-outline-secondary btn-action w-100">
                                    <i class="bi bi-house"></i><br>
                                    <small>Dashboard</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>