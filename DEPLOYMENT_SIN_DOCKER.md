# Guía de Deployment SIN Docker en Producción

## ✅ ¿Se rompe algo si subo el repositorio sin Docker?

**NO, no se rompe nada.** El proyecto está diseñado para funcionar tanto con Docker (desarrollo) como sin Docker (producción tradicional).

### Archivos que NO afectan producción sin Docker:

- ✅ `compose.yaml` - Solo se usa si ejecutas Docker/Sail. Si no lo usas, simplemente se ignora.
- ✅ `DEPLOYMENT_DOCKER.md` - Solo documentación, no afecta el funcionamiento.
- ✅ `laravel/sail` en `composer.json` - Está en `require-dev`, no se instala en producción si usas `--no-dev`.

### Lo que SÍ funciona sin Docker:

- ✅ Toda la aplicación Laravel funciona normalmente
- ✅ Conexión a base de datos remota (configurada en `.env`)
- ✅ Rutas, controladores, modelos, vistas
- ✅ Livewire, Jetstream, AdminLTE
- ✅ Todo el código de la aplicación

---

## Requisitos del Servidor (Sin Docker)

### Software necesario:

1. **PHP 8.2+** con extensiones:
   - BCMath
   - Ctype
   - cURL
   - DOM
   - Fileinfo
   - JSON
   - Mbstring
   - OpenSSL
   - PCRE
   - PDO
   - PDO MySQL
   - Tokenizer
   - XML

2. **Composer** (gestor de dependencias PHP)

3. **Node.js y NPM** (para compilar assets de Vite)

4. **MySQL/MariaDB** (ya está en servidor remoto según tu configuración)

5. **Nginx o Apache** (servidor web)

6. **Git** (para clonar el repositorio)

---

## Paso 1: Instalar PHP y Extensiones

### Ubuntu/Debian:

```bash
sudo apt update
sudo apt install -y php8.2 php8.2-cli php8.2-fpm php8.2-mysql php8.2-xml \
    php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd php8.2-bcmath \
    php8.2-intl php8.2-readline

# Verificar versión
php -v
```

### CentOS/RHEL:

```bash
sudo yum install -y php82 php82-php-fpm php82-php-mysqlnd php82-php-xml \
    php82-php-mbstring php82-php-curl php82-php-zip php82-php-gd \
    php82-php-bcmath php82-php-intl
```

---

## Paso 2: Instalar Composer

```bash
# Descargar e instalar Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

# Verificar instalación
composer --version
```

---

## Paso 3: Instalar Node.js y NPM

### Opción A: Usando NodeSource (recomendado para Node.js 20+)

```bash
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs

# Verificar
node --version
npm --version
```

### Opción B: Usando el gestor de paquetes

```bash
# Ubuntu/Debian
sudo apt install -y nodejs npm

# CentOS/RHEL
sudo yum install -y nodejs npm
```

---

## Paso 4: Clonar el Repositorio

```bash
# Navegar al directorio web
cd /var/www  # o donde prefieras

# Clonar repositorio (rama producción)
git clone -b produccion <URL_DEL_REPOSITORIO> stockinteligentehelp
cd stockinteligentehelp
```

---

## Paso 5: Configurar Variables de Entorno

```bash
# Copiar archivo de ejemplo
cp .env.example .env

# Editar con las credenciales de producción
nano .env
```

**Configuración importante en `.env`:**

```env
APP_NAME="Ayuda Stock Inteligente"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:TU_APP_KEY_AQUI
APP_TIMEZONE=America/Argentina/Buenos_Aires
APP_URL=https://ayuda.stockinteligente.com

DB_CONNECTION=mysql
DB_HOST=ayuda.stockinteligente.com
DB_PORT=3306
DB_DATABASE=ayudastockinteli_ayuda
DB_USERNAME=ayudastockinteli_ayudastockintel
DB_PASSWORD=stock_2025_ayuda

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

**Generar APP_KEY si no existe:**
```bash
php artisan key:generate
```

---

## Paso 6: Instalar Dependencias

```bash
# Instalar dependencias PHP (SIN dependencias de desarrollo)
composer install --optimize-autoloader --no-dev

# Instalar dependencias Node.js
npm install

# Compilar assets para producción
npm run build
```

---

## Paso 7: Configurar Permisos

```bash
# Establecer propietario (ajusta según tu configuración)
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# Si tu usuario es diferente a www-data:
sudo chown -R tu_usuario:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

---

## Paso 8: Ejecutar Migraciones y Configurar Laravel

```bash
# Ejecutar migraciones
php artisan migrate --force

# Crear enlace simbólico para storage
php artisan storage:link

# Optimizar para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

---

## Paso 9: Configurar Nginx

### Configuración de Nginx (`/etc/nginx/sites-available/stockinteligentehelp`):

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name ayuda.stockinteligente.com;
    root /var/www/stockinteligentehelp/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

**Habilitar el sitio:**
```bash
sudo ln -s /etc/nginx/sites-available/stockinteligentehelp /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

## Paso 10: Configurar Apache (Alternativa)

Si prefieres Apache, configuración en `/etc/apache2/sites-available/stockinteligentehelp.conf`:

```apache
<VirtualHost *:80>
    ServerName ayuda.stockinteligente.com
    DocumentRoot /var/www/stockinteligentehelp/public

    <Directory /var/www/stockinteligentehelp/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

**Habilitar módulos y sitio:**
```bash
sudo a2enmod rewrite
sudo a2ensite stockinteligentehelp
sudo systemctl restart apache2
```

---

## Paso 11: Configurar SSL/HTTPS (Recomendado)

```bash
# Instalar Certbot
sudo apt install -y certbot python3-certbot-nginx
# O para Apache:
sudo apt install -y certbot python3-certbot-apache

# Obtener certificado SSL
sudo certbot --nginx -d ayuda.stockinteligente.com
# O para Apache:
sudo certbot --apache -d ayuda.stockinteligente.com

# Renovación automática (ya viene configurada)
sudo certbot renew --dry-run
```

---

## Comandos Útiles en Producción

```bash
# Limpiar cachés
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Reconstruir cachés
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Actualizar código
git pull origin produccion
composer install --optimize-autoloader --no-dev
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ver logs
tail -f storage/logs/laravel.log
```

---

## Verificación Final

1. ✅ PHP instalado: `php -v`
2. ✅ Composer instalado: `composer --version`
3. ✅ Node.js instalado: `node --version`
4. ✅ Base de datos conectada: `php artisan migrate:status`
5. ✅ Aplicación accesible: `curl http://localhost`
6. ✅ Permisos correctos: `ls -la storage bootstrap/cache`

---

## Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload --optimize
```

### Error: "Permission denied" en storage
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Error: "Vite manifest not found"
```bash
npm run build
```

### Error: "SQLSTATE[HY000] [2002] Connection refused"
- Verificar credenciales en `.env`
- Verificar que el servidor MySQL permite conexiones remotas
- Verificar firewall

### Error 500 después del deployment
```bash
# Limpiar todos los cachés
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Verificar logs
tail -f storage/logs/laravel.log
```

---

## Diferencias Clave: Con Docker vs Sin Docker

| Aspecto | Con Docker (Desarrollo) | Sin Docker (Producción) |
|---------|------------------------|-------------------------|
| PHP | Dentro del contenedor | Instalado en el servidor |
| Comandos | `./vendor/bin/sail artisan` | `php artisan` |
| Base de datos | Contenedor MySQL | Servidor MySQL remoto |
| Assets | `sail npm run build` | `npm run build` |
| Configuración | `compose.yaml` | `.env` + servidor web |

---

## Notas Importantes

1. **No necesitas Docker** - El archivo `compose.yaml` simplemente se ignora
2. **Laravel Sail es solo desarrollo** - Está en `require-dev`, no se instala en producción
3. **El código funciona igual** - No hay dependencias de Docker en el código de la aplicación
4. **Base de datos remota** - Ya está configurada en `.env.example` con las credenciales correctas
5. **Assets compilados** - Asegúrate de ejecutar `npm run build` antes de poner en producción

---

## Checklist de Deployment

- [ ] PHP 8.2+ instalado con todas las extensiones
- [ ] Composer instalado
- [ ] Node.js y NPM instalados
- [ ] Repositorio clonado (rama producción)
- [ ] Archivo `.env` configurado con credenciales de producción
- [ ] `APP_KEY` generado
- [ ] Dependencias instaladas (`composer install --no-dev`)
- [ ] Assets compilados (`npm run build`)
- [ ] Permisos configurados en `storage/` y `bootstrap/cache/`
- [ ] Migraciones ejecutadas
- [ ] Cachés optimizados
- [ ] Servidor web (Nginx/Apache) configurado
- [ ] SSL/HTTPS configurado
- [ ] Aplicación accesible y funcionando

---

**Conclusión:** Puedes subir el repositorio a producción sin problemas. Los archivos de Docker simplemente se ignoran y la aplicación funciona normalmente con PHP tradicional.
