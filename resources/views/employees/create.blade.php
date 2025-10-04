<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Empleado - SIRH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%); }
        .card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .form-control, .form-select { border-radius: 10px; border: 2px solid #e9ecef; }
        .form-control:focus, .form-select:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25); }
        .btn-action { border-radius: 10px; padding: 0.75rem 1.5rem; font-weight: 600; }
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
                    <h1 class="h3 mb-0"><i class="bi bi-person-plus"></i> Nuevo Empleado</h1>
                    <a href="<?php echo url('/employees'); ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="<?php echo url('/employees'); ?>">
                            <!-- Información Personal -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h5 class="text-primary mb-3"><i class="bi bi-person"></i> Información Personal</h5>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="first_name" class="form-label">Nombre *</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="last_name" class="form-label">Apellido Paterno *</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="middle_name" class="form-label">Apellido Materno</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Correo Electrónico *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Teléfono</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            
                            <!-- Información Laboral -->
                            <div class="row mb-4 mt-4">
                                <div class="col-12">
                                    <h5 class="text-primary mb-3"><i class="bi bi-briefcase"></i> Información Laboral</h5>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="hire_date" class="form-label">Fecha de Contratación *</label>
                                    <input type="date" class="form-control" id="hire_date" name="hire_date" required>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="position_id" class="form-label">Puesto *</label>
                                    <select class="form-select" id="position_id" name="position_id" required>
                                        <option value="">Seleccionar puesto...</option>
                                        <?php foreach ($positions as $position): ?>
                                            <option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-4 mb-3">
                                    <label for="department_id" class="form-label">Departamento *</label>
                                    <select class="form-select" id="department_id" name="department_id" required>
                                        <option value="">Seleccionar departamento...</option>
                                        <?php foreach ($departments as $department): ?>
                                            <option value="<?php echo $department['id']; ?>"><?php echo $department['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="salary" class="form-label">Salario *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" step="0.01" min="0" class="form-control" id="salary" name="salary" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="employment_status" class="form-label">Estado de Empleo</label>
                                    <select class="form-select" id="employment_status" name="employment_status">
                                        <option value="Activo">Activo</option>
                                        <option value="Inactivo">Inactivo</option>
                                        <option value="Suspendido">Suspendido</option>
                                        <option value="Jubilado">Jubilado</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Botones -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="<?php echo url('/employees'); ?>" class="btn btn-secondary btn-action">
                                            <i class="bi bi-x"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-primary btn-action">
                                            <i class="bi bi-check"></i> Crear Empleado
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>