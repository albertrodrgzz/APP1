// SIRH - Sistema Integrado de Gestión Administrativa
// JavaScript personalizado

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Inicializar popovers
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Auto-hide alerts después de 5 segundos
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
        alerts.forEach(function(alert) {
            var bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    // Confirmación para acciones destructivas
    var deleteButtons = document.querySelectorAll('[data-confirm]');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            var message = this.getAttribute('data-confirm') || '¿Estás seguro?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });

    // Búsqueda en tiempo real para tablas
    var searchInputs = document.querySelectorAll('[data-search-target]');
    searchInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            var target = this.getAttribute('data-search-target');
            var table = document.querySelector(target);
            if (table) {
                filterTable(table, this.value);
            }
        });
    });

    // Filtros de tabla
    var filterSelects = document.querySelectorAll('[data-filter-target]');
    filterSelects.forEach(function(select) {
        select.addEventListener('change', function() {
            var target = this.getAttribute('data-filter-target');
            var column = this.getAttribute('data-filter-column');
            var table = document.querySelector(target);
            if (table) {
                filterTableByColumn(table, column, this.value);
            }
        });
    });

    // Formateo de números de teléfono
    var phoneInputs = document.querySelectorAll('input[type="tel"], input[name*="phone"]');
    phoneInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            this.value = formatPhoneNumber(this.value);
        });
    });

    // Formateo de salarios
    var salaryInputs = document.querySelectorAll('input[name="salary"]');
    salaryInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            this.value = formatSalary(this.value);
        });
    });

    // Validación de formularios
    var forms = document.querySelectorAll('.needs-validation');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // Carga de archivos con preview
    var fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(function(input) {
        input.addEventListener('change', function() {
            showFilePreview(this);
        });
    });

    // Animaciones de entrada
    var animatedElements = document.querySelectorAll('.fade-in');
    animatedElements.forEach(function(element) {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(function() {
            element.style.transition = 'all 0.6s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, 100);
    });
});

// Funciones utilitarias
function filterTable(table, searchTerm) {
    var rows = table.querySelectorAll('tbody tr');
    var term = searchTerm.toLowerCase();
    
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        if (text.includes(term)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function filterTableByColumn(table, columnIndex, filterValue) {
    var rows = table.querySelectorAll('tbody tr');
    
    rows.forEach(function(row) {
        var cell = row.cells[columnIndex];
        if (cell) {
            var cellText = cell.textContent.toLowerCase();
            if (filterValue === '' || cellText.includes(filterValue.toLowerCase())) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}

function formatPhoneNumber(value) {
    // Remover todos los caracteres no numéricos
    var cleaned = value.replace(/\D/g, '');
    
    // Aplicar formato mexicano: (XXX) XXX-XXXX
    if (cleaned.length >= 10) {
        return '(' + cleaned.slice(0, 3) + ') ' + cleaned.slice(3, 6) + '-' + cleaned.slice(6, 10);
    } else if (cleaned.length >= 6) {
        return '(' + cleaned.slice(0, 3) + ') ' + cleaned.slice(3, 6) + '-' + cleaned.slice(6);
    } else if (cleaned.length >= 3) {
        return '(' + cleaned.slice(0, 3) + ') ' + cleaned.slice(3);
    } else if (cleaned.length > 0) {
        return '(' + cleaned;
    }
    
    return cleaned;
}

function formatSalary(value) {
    // Remover caracteres no numéricos excepto punto decimal
    var cleaned = value.replace(/[^\d.]/g, '');
    
    // Formatear con separadores de miles
    if (cleaned) {
        var parts = cleaned.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        return parts.join('.');
    }
    
    return cleaned;
}

function showFilePreview(input) {
    var file = input.files[0];
    if (file) {
        var preview = document.getElementById(input.id + '-preview');
        if (preview) {
            var reader = new FileReader();
            reader.onload = function(e) {
                if (file.type.startsWith('image/')) {
                    preview.innerHTML = '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px;">';
                } else {
                    preview.innerHTML = '<div class="alert alert-info"><i class="bi bi-file"></i> ' + file.name + ' (' + formatFileSize(file.size) + ')</div>';
                }
            };
            reader.readAsDataURL(file);
        }
    }
}

function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    
    var k = 1024;
    var sizes = ['Bytes', 'KB', 'MB', 'GB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

function clearFilters() {
    var searchInputs = document.querySelectorAll('[data-search-target]');
    searchInputs.forEach(function(input) {
        input.value = '';
        var target = input.getAttribute('data-search-target');
        var table = document.querySelector(target);
        if (table) {
            filterTable(table, '');
        }
    });
    
    var filterSelects = document.querySelectorAll('[data-filter-target]');
    filterSelects.forEach(function(select) {
        select.value = '';
        var target = select.getAttribute('data-filter-target');
        var column = select.getAttribute('data-filter-column');
        var table = document.querySelector(target);
        if (table) {
            filterTableByColumn(table, column, '');
        }
    });
}

// Funciones para el control de asistencia
function checkIn() {
    if (confirm('¿Registrar entrada ahora?')) {
        document.getElementById('check-in-form').submit();
    }
}

function checkOut() {
    if (confirm('¿Registrar salida ahora?')) {
        document.getElementById('check-out-form').submit();
    }
}

// Funciones para reportes
function generateReport(type) {
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '/reports/generate';
    
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'report_type';
    input.value = type;
    
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}

// Funciones para validación
function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function validatePhone(phone) {
    var re = /^\(\d{3}\) \d{3}-\d{4}$/;
    return re.test(phone);
}

function validateSalary(salary) {
    var re = /^\d{1,3}(,\d{3})*(\.\d{2})?$/;
    return re.test(salary);
}

// Funciones para notificaciones
function showNotification(message, type = 'info') {
    var alertClass = 'alert-' + type;
    var alertHtml = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                    message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
                    '</div>';
    
    var container = document.querySelector('.container-fluid, .container');
    if (container) {
        container.insertAdjacentHTML('afterbegin', alertHtml);
        
        // Auto-hide después de 5 segundos
        setTimeout(function() {
            var alert = container.querySelector('.alert:first-child');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    }
}

// Funciones para el dashboard
function updateDashboardStats() {
    // Aquí se implementaría la actualización de estadísticas en tiempo real
    // usando AJAX para obtener datos del servidor
}

// Funciones para exportación
function exportToExcel(tableId, filename) {
    var table = document.getElementById(tableId);
    if (table) {
        var wb = XLSX.utils.table_to_book(table);
        XLSX.writeFile(wb, filename + '.xlsx');
    }
}

function exportToPDF(elementId, filename) {
    // Esta función requeriría la librería jsPDF
    // Se implementaría según las necesidades específicas
}

// Funciones para el calendario
function initializeCalendar() {
    // Aquí se implementaría la inicialización del calendario
    // usando una librería como FullCalendar
}

// Funciones para gráficos
function initializeCharts() {
    // Aquí se implementaría la inicialización de gráficos
    // usando una librería como Chart.js
}

// Funciones para el organigrama
function initializeOrgChart() {
    // Aquí se implementaría la inicialización del organigrama
    // usando una librería específica para organigramas
}

// Funciones para la gestión de archivos
function uploadFile(input, callback) {
    var file = input.files[0];
    if (file) {
        var formData = new FormData();
        formData.append('file', file);
        
        fetch('/upload', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (callback) callback(data);
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error al subir el archivo', 'danger');
        });
    }
}

// Funciones para la búsqueda avanzada
function initializeAdvancedSearch() {
    var searchForm = document.getElementById('advanced-search');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            performAdvancedSearch();
        });
    }
}

function performAdvancedSearch() {
    var formData = new FormData(document.getElementById('advanced-search'));
    var params = new URLSearchParams();
    
    for (var pair of formData.entries()) {
        if (pair[1]) {
            params.append(pair[0], pair[1]);
        }
    }
    
    var url = window.location.pathname + '?' + params.toString();
    window.location.href = url;
}

// Funciones para la paginación
function initializePagination() {
    var paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            var url = this.getAttribute('href');
            if (url) {
                window.location.href = url;
            }
        });
    });
}

// Inicialización general
document.addEventListener('DOMContentLoaded', function() {
    initializePagination();
    initializeAdvancedSearch();
    
    // Actualizar estadísticas cada 30 segundos
    setInterval(updateDashboardStats, 30000);
});

