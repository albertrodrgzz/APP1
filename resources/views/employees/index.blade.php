<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados - SIRH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .table { border-radius: 10px; overflow: hidden; }
        .table thead th { background: #f8f9fa; border: none; font-weight: 600; color: #495057; }
        .table tbody tr:hover { background-color: rgba(0,123,255,0.05); }
        .badge { border-radius: 20px; padding: 0.5rem 1rem; }
        .btn-action { border-radius: 10px; padding: 0.5rem 1rem; margin: 0.25rem; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: white; }
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
                    <li class="nav-item"><a class="nav-link active" href="<?php echo url('/employees'); ?>"><i class="bi bi-people"></i> Empleados</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo url('/attendance'); ?>"><i class="bi bi-clock"></i> Asistencia</a></li>
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0"><i class="bi bi-people"></i> Gestión de Empleados</h1>
                    <a href="<?php echo url('/employees/create'); ?>" class="btn btn-primary">
                        <i class="bi bi-plus"></i> Nuevo Empleado
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Filtros -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Buscar empleados...">
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="">Todos los departamentos</option>
                                    <option value="1">Dirección General</option>
                                    <option value="2">Recursos Humanos</option>
                                    <option value="3">Telemática</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="">Todos los estados</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-x"></i> Limpiar
                                </button>
                            </div>
                        </div>
                        
                        <!-- Tabla de empleados -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Departamento</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employees as $employee): ?>
                                    <tr>
                                        <td><?php echo $employee['employee_number']; ?></td>
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
                                        <td><?php echo $employee['email']; ?></td>
                                        <td><?php echo $employee['phone']; ?></td>
                                        <td>
                                            <span class="badge bg-success"><?php echo $employee['status']; ?></span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="#" class="btn btn-sm btn-outline-primary" title="Ver">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-warning" title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-danger" title="Desactivar">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>