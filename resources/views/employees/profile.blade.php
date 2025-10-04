<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - SIRH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .profile-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .profile-avatar { width: 120px; height: 120px; border-radius: 50%; background: rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight: bold; }
        .info-item { padding: 1rem; border-bottom: 1px solid #e9ecef; }
        .info-item:last-child { border-bottom: none; }
        .info-label { font-weight: 600; color: #495057; }
        .info-value { color: #6c757d; }
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
                    <li class="nav-item"><a class="nav-link" href="<?php echo url('/attendance'); ?>"><i class="bi bi-clock"></i> Asistencia</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo url('/profile'); ?>"><i class="bi bi-person"></i> Mi Perfil</a></li>
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
                <h1 class="h3 mb-4"><i class="bi bi-person"></i> Mi Perfil</h1>
            </div>
        </div>
        
        <div class="row">
            <!-- Información Personal -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-header profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="profile-avatar">
                                    <?php echo substr($employee['name'], 0, 2); ?>
                                </div>
                            </div>
                            <div class="col">
                                <h3 class="mb-1"><?php echo $employee['name']; ?></h3>
                                <p class="mb-0 opacity-75"><?php echo $employee['position']; ?></p>
                                <p class="mb-0 opacity-75"><?php echo $employee['department']; ?></p>
                            </div>
                            <div class="col-auto">
                                <a href="#" class="btn btn-light">
                                    <i class="bi bi-pencil"></i> Editar Perfil
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="info-label">Nombre Completo</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="info-value"><?php echo $employee['name']; ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="info-label">Correo Electrónico</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="info-value"><?php echo $employee['email']; ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="info-label">Teléfono</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="info-value"><?php echo $employee['phone']; ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="info-label">Puesto</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="info-value"><?php echo $employee['position']; ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="info-label">Departamento</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="info-value"><?php echo $employee['department']; ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="info-label">Fecha de Ingreso</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="info-value"><?php echo $employee['hire_date']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Accesos Rápidos -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-lightning"></i> Accesos Rápidos</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="<?php echo url('/attendance'); ?>" class="btn btn-outline-primary">
                                <i class="bi bi-clock"></i> Mi Asistencia
                            </a>
                            <a href="#" class="btn btn-outline-success">
                                <i class="bi bi-file-text"></i> Mis Documentos
                            </a>
                            <a href="#" class="btn btn-outline-info">
                                <i class="bi bi-calendar"></i> Mis Vacaciones
                            </a>
                            <a href="#" class="btn btn-outline-warning">
                                <i class="bi bi-credit-card"></i> Mis Nóminas
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-graph-up"></i> Estadísticas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <div class="border rounded p-3">
                                    <h4 class="text-primary">20</h4>
                                    <small class="text-muted">Días Presentes</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="border rounded p-3">
                                    <h4 class="text-success">160</h4>
                                    <small class="text-muted">Horas Trabajadas</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="border rounded p-3">
                                    <h4 class="text-info">8</h4>
                                    <small class="text-muted">Horas Extra</small>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="border rounded p-3">
                                    <h4 class="text-warning">2</h4>
                                    <small class="text-muted">Días Ausentes</small>
                                </div>
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