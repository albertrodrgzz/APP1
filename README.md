# SIRH - Sistema Integrado de Gestión Administrativa

Sistema web desarrollado para la Dirección de Telemática del Instituto, diseñado para automatizar y optimizar los procesos de gestión de recursos humanos.

## Características Principales

### Módulos Implementados (Fase 1 - MVP)
- **Administración de Personal**: Gestión completa de empleados, departamentos y posiciones
- **Control Horario**: Registro de entrada/salida y gestión de ausencias
- **Portal de Autogestión**: Interfaz para empleados para gestionar su información personal

### Tecnologías Utilizadas
- **Backend**: PHP 8.1+ con Laravel 10
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Base de Datos**: MySQL 8.0+
- **Servidor Web**: Apache/Nginx
- **Autenticación**: Laravel Sanctum
- **Roles y Permisos**: Spatie Laravel Permission

## Requisitos del Sistema

### Servidor
- PHP 8.1 o superior
- MySQL 8.0 o superior
- Apache 2.4+ o Nginx 1.18+
- Composer 2.0+
- Node.js 16+ (para compilación de assets)

### Extensiones PHP Requeridas
- BCMath
- Ctype
- cURL
- DOM
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML

## Instalación

### 1. Clonar el Repositorio
```bash
git clone [url-del-repositorio] sirh-app
cd sirh-app
```

### 2. Instalar Dependencias
```bash
composer install
```

### 3. Configurar Variables de Entorno
```bash
cp env.example .env
```

Editar el archivo `.env` con la configuración de tu base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sirh_app
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 4. Generar Clave de Aplicación
```bash
php artisan key:generate
```

### 5. Ejecutar Migraciones
```bash
php artisan migrate
```

### 6. Poblar Base de Datos
```bash
php artisan db:seed
```

### 7. Configurar Permisos de Archivos
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 8. Configurar Servidor Web

#### Apache
Crear un Virtual Host apuntando al directorio `public/`:
```apache
<VirtualHost *:80>
    ServerName sirh.local
    DocumentRoot /ruta/al/proyecto/public
    
    <Directory /ruta/al/proyecto/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Nginx
```nginx
server {
    listen 80;
    server_name sirh.local;
    root /ruta/al/proyecto/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## Usuarios por Defecto

Después de ejecutar el seeder, tendrás los siguientes usuarios:

### Administrador
- **Email**: admin@sirh.com
- **Contraseña**: password
- **Rol**: Administrador completo

### Gerente
- **Email**: manager@sirh.com
- **Contraseña**: password
- **Rol**: Gerente de departamento

### Empleado
- **Email**: employee@sirh.com
- **Contraseña**: password
- **Rol**: Empleado básico

## Estructura del Proyecto

```
sirh-app/
├── app/
│   ├── Http/Controllers/     # Controladores
│   ├── Models/              # Modelos Eloquent
│   └── Http/Middleware/     # Middleware personalizado
├── database/
│   ├── migrations/          # Migraciones de BD
│   └── seeders/            # Seeders de datos
├── public/
│   ├── css/                # Estilos CSS
│   ├── js/                 # JavaScript
│   └── index.php           # Punto de entrada
├── resources/
│   └── views/              # Vistas Blade
├── routes/
│   └── web.php             # Rutas web
└── storage/                # Archivos de almacenamiento
```

## Funcionalidades por Módulo

### Módulo 1: Administración de Personal
- ✅ Creación y edición de empleados
- ✅ Gestión de departamentos y posiciones
- ✅ Organigrama jerárquico
- ✅ Roles y permisos granulares
- ✅ Gestión de documentos

### Módulo 3: Control Horario
- ✅ Registro de entrada/salida
- ✅ Cálculo automático de horas
- ✅ Gestión de ausencias
- ✅ Reportes de asistencia
- ✅ Historial de registros

### Módulo 6: Portal de Autogestión
- ✅ Perfil personal del empleado
- ✅ Actualización de datos personales
- ✅ Consulta de documentos
- ✅ Historial de asistencia personal

## Próximas Fases

### Fase 2: Gestión Financiera (2-3 meses)
- Módulo 2: Nóminas y Compensación
- Cálculo automático de nóminas
- Generación de recibos de pago
- Gestión de beneficios

### Fase 3: Crecimiento y Talento (3-4 meses)
- Módulo 4: Adquisición de Talento
- Módulo 5: Desarrollo y Formación
- Portal de empleo
- Gestión de candidatos

### Fase 4: Inteligencia de Negocio (2 meses)
- Módulo 7: Indicadores y Planificación
- Dashboard ejecutivo
- Reportes avanzados
- Análisis de datos

## Seguridad

- Autenticación segura con Laravel Sanctum
- Roles y permisos granulares
- Validación de datos en frontend y backend
- Protección CSRF
- Sanitización de entradas
- Encriptación de contraseñas

## Soporte

Para soporte técnico o consultas sobre el sistema, contactar a:
- **Dirección de Telemática del Instituto**
- **Email**: soporte@sirh.com
- **Teléfono**: (555) 123-4567

## Licencia

Este proyecto está desarrollado específicamente para el Instituto y su uso está restringido a la organización.

---

**Desarrollado por**: Dirección de Telemática del Instituto  
**Versión**: 1.0.0  
**Fecha**: 2024

