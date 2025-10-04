# 🚀 SIRH - Instrucciones de Instalación para XAMPP

## Instalación Rápida (5 minutos)

### 1. Verificar XAMPP
- Asegúrate de que XAMPP esté instalado y funcionando
- Inicia Apache y MySQL desde el panel de control de XAMPP

### 2. Configurar Base de Datos
1. Abre phpMyAdmin: http://localhost/phpmyadmin
2. Crea una nueva base de datos llamada `sirh_app`
3. Importa el archivo `database-setup.sql` o ejecuta el script SQL

### 3. Instalar Composer
- Descarga Composer desde: https://getcomposer.org/download/
- Instala Composer siguiendo las instrucciones del instalador

### 4. Configurar la Aplicación
Abre la terminal en la carpeta del proyecto y ejecuta:

```bash
# Instalar dependencias
composer install

# Copiar archivo de configuración
copy env.example .env

# Generar clave de aplicación
php artisan key:generate

# Ejecutar migraciones
php artisan migrate

# Poblar base de datos con datos de prueba
php artisan db:seed
```

### 5. Acceder a la Aplicación
- Abre tu navegador y ve a: http://localhost/APP1/
- O directamente a: http://localhost/APP1/public/

## 🔑 Usuarios de Prueba

| Rol | Email | Contraseña |
|-----|-------|------------|
| **Administrador** | admin@sirh.com | password |
| **Gerente** | manager@sirh.com | password |
| **Empleado** | employee@sirh.com | password |

## 🛠️ Solución de Problemas

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Database connection failed"
- Verifica que MySQL esté ejecutándose en XAMPP
- Revisa la configuración en el archivo `.env`

### Error: "Permission denied"
```bash
# En Windows (ejecutar como administrador)
icacls storage /grant Everyone:F /T
icacls bootstrap\cache /grant Everyone:F /T
```

### Error: "Key not set"
```bash
php artisan key:generate
```

## 📁 Estructura del Proyecto

```
APP1/
├── public/                 # Directorio web público
│   ├── index.php          # Punto de entrada de Laravel
│   ├── css/               # Estilos CSS
│   └── js/                # JavaScript
├── app/                   # Código de la aplicación
├── database/              # Migraciones y seeders
├── resources/             # Vistas y assets
├── routes/                # Definición de rutas
├── index.php              # Redirección principal
├── xampp-setup.php        # Verificador de configuración
└── database-setup.sql     # Script de base de datos
```

## 🌐 URLs Importantes

- **Aplicación Principal**: http://localhost/APP1/
- **Configuración**: http://localhost/APP1/xampp-setup.php
- **phpMyAdmin**: http://localhost/phpmyadmin
- **Panel XAMPP**: http://localhost/dashboard/

## 📋 Verificación de Instalación

1. **Requisitos del Sistema**:
   - PHP 8.1+
   - MySQL 8.0+
   - Apache 2.4+
   - Composer 2.0+

2. **Extensiones PHP Requeridas**:
   - PDO
   - PDO MySQL
   - OpenSSL
   - Mbstring
   - Tokenizer
   - XML
   - Ctype
   - JSON
   - BCMath
   - Fileinfo
   - cURL

3. **Verificar Instalación**:
   - Visita: http://localhost/APP1/xampp-setup.php
   - Debe mostrar todos los requisitos como "✅ OK"

## 🔧 Configuración Avanzada

### Personalizar Puerto (si 80 está ocupado)
1. Edita `httpd.conf` en XAMPP
2. Cambia `Listen 80` a `Listen 8080`
3. Accede a: http://localhost:8080/APP1/

### Configurar Virtual Host
```apache
<VirtualHost *:80>
    ServerName sirh.local
    DocumentRoot C:/xampp/htdocs/APP1/public
    
    <Directory C:/xampp/htdocs/APP1/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## 📞 Soporte

Si encuentras problemas:

1. **Verifica los logs**:
   - XAMPP: `C:\xampp\apache\logs\error.log`
   - Laravel: `storage\logs\laravel.log`

2. **Revisa la configuración**:
   - Archivo `.env`
   - Configuración de base de datos
   - Permisos de archivos

3. **Reinicia servicios**:
   - Detener y reiniciar Apache y MySQL
   - Limpiar caché: `php artisan cache:clear`

---

**¡Listo!** Tu sistema SIRH debería estar funcionando correctamente. 🎉

