# Guía de Instalación Docker en Producción

## Requisitos del Servidor

- **Sistema Operativo:** Linux (Ubuntu 20.04+ / Debian 11+ / CentOS 8+)
- **RAM:** Mínimo 2GB (recomendado 4GB+)
- **Disco:** Mínimo 20GB de espacio libre
- **Acceso:** SSH con permisos de root o sudo

---

## Paso 1: Instalar Docker Engine

### Para Ubuntu/Debian:

```bash
# Actualizar el sistema
sudo apt update
sudo apt upgrade -y

# Instalar dependencias
sudo apt install -y ca-certificates curl gnupg lsb-release

# Agregar la clave GPG oficial de Docker
sudo mkdir -p /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg

# Configurar el repositorio
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu \
  $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Instalar Docker Engine
sudo apt update
sudo apt install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Verificar instalación
sudo docker --version
```

### Para CentOS/RHEL:

```bash
# Instalar dependencias
sudo yum install -y yum-utils

# Agregar repositorio de Docker
sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo

# Instalar Docker
sudo yum install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

# Iniciar Docker
sudo systemctl start docker
sudo systemctl enable docker

# Verificar instalación
sudo docker --version
```

---

## Paso 2: Instalar Docker Compose (si no se instaló automáticamente)

Docker Compose v2 viene incluido con Docker Engine moderno. Si necesitas instalarlo por separado:

```bash
# Para Ubuntu/Debian
sudo apt install -y docker-compose-plugin

# Verificar versión
docker compose version
```

---

## Paso 3: Configurar Usuario sin Sudo (Opcional pero Recomendado)

Para ejecutar Docker sin `sudo`:

```bash
# Crear grupo docker (si no existe)
sudo groupadd docker

# Agregar tu usuario al grupo docker
sudo usermod -aG docker $USER

# Aplicar cambios (cerrar sesión y volver a entrar, o ejecutar)
newgrp docker

# Verificar que funciona sin sudo
docker ps
```

---

## Paso 4: Instalar Git (si no está instalado)

```bash
# Ubuntu/Debian
sudo apt install -y git

# CentOS/RHEL
sudo yum install -y git

# Verificar
git --version
```

---

## Paso 5: Clonar el Repositorio

```bash
# Navegar al directorio donde quieres el proyecto
cd /var/www  # o donde prefieras

# Clonar el repositorio (rama producción)
git clone -b produccion <URL_DEL_REPOSITORIO> stockinteligentehelp
cd stockinteligentehelp
```

---

## Paso 6: Configurar Variables de Entorno

```bash
# Copiar archivo de ejemplo
cp .env.example .env

# Editar el archivo .env con las credenciales de producción
nano .env
```

**Configuración importante en `.env` de producción:**

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ayuda.stockinteligente.com

# Base de datos (si está en servidor remoto, no en Docker)
DB_CONNECTION=mysql
DB_HOST=ayuda.stockinteligente.com
DB_PORT=3306
DB_DATABASE=ayudastockinteli_ayuda
DB_USERNAME=ayudastockinteli_ayudastockintel
DB_PASSWORD=stock_2025_ayuda

# Si usas Docker para la base de datos también, usa:
# DB_HOST=mysql
# DB_PORT=3306
```

---

## Paso 7: Configurar Docker Compose para Producción

Si quieres usar Docker solo para la aplicación Laravel (y la BD está en servidor remoto), puedes modificar `compose.yaml` o crear `docker-compose.prod.yml`:

```yaml
services:
    laravel.test:
        build:
            context: './vendor/laravel/sail/runtimes/8.2'
            dockerfile: Dockerfile
            args:
                WWWGROUP: '${WWWGROUP:-1000}'
        image: 'sail-8.2/app'
        extra_hosts:
            - 'host.docker.internal:host-gateway'
        ports:
            - '${APP_PORT:-80}:80'
        environment:
            WWWUSER: '${WWWUSER:-1000}'
            LARAVEL_SAIL: 1
        volumes:
            - '.:/var/www/html'
        networks:
            - sail
        # Remover depends_on mysql si la BD está en servidor remoto
networks:
    sail:
        driver: bridge
```

---

## Paso 8: Construir y Ejecutar los Contenedores

```bash
# Construir las imágenes
./vendor/bin/sail build --no-cache

# O si prefieres usar docker compose directamente:
docker compose up -d --build

# Verificar que los contenedores están corriendo
docker ps

# Ver logs
docker compose logs -f
```

---

## Paso 9: Instalar Dependencias y Configurar Laravel

```bash
# Entrar al contenedor
./vendor/bin/sail shell

# O directamente:
docker compose exec laravel.test bash

# Dentro del contenedor:
composer install --optimize-autoloader --no-dev
php artisan key:generate
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm install
npm run build
php artisan storage:link

# Salir del contenedor
exit
```

---

## Paso 10: Configurar Permisos

```bash
# Desde el servidor (fuera del contenedor)
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

---

## Paso 11: Configurar Nginx o Apache como Proxy Reverso (Recomendado)

### Opción A: Nginx como Proxy Reverso

```nginx
server {
    listen 80;
    server_name ayuda.stockinteligente.com;
    
    location / {
        proxy_pass http://127.0.0.1:80;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

### Opción B: Usar el puerto directamente

Si expones directamente el puerto 80 del contenedor, asegúrate de que:
- El puerto 80 esté disponible
- El firewall permita conexiones en el puerto 80

---

## Paso 12: Configurar SSL/HTTPS (Recomendado)

```bash
# Instalar Certbot
sudo apt install -y certbot python3-certbot-nginx

# Obtener certificado SSL
sudo certbot --nginx -d ayuda.stockinteligente.com
```

---

## Comandos Útiles en Producción

```bash
# Ver logs de la aplicación
docker compose logs -f laravel.test

# Reiniciar contenedores
docker compose restart

# Detener contenedores
docker compose down

# Iniciar contenedores
docker compose up -d

# Ejecutar comandos Artisan
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan cache:clear

# Actualizar código
git pull origin produccion
docker compose restart

# Ver uso de recursos
docker stats
```

---

## Verificación Final

1. ✅ Docker instalado: `docker --version`
2. ✅ Docker Compose instalado: `docker compose version`
3. ✅ Contenedores corriendo: `docker ps`
4. ✅ Aplicación accesible: `curl http://localhost`
5. ✅ Base de datos conectada: Verificar logs de Laravel

---

## Troubleshooting

### Error: "Cannot connect to Docker daemon"
```bash
sudo systemctl start docker
sudo systemctl enable docker
```

### Error: "Permission denied"
```bash
sudo usermod -aG docker $USER
newgrp docker
```

### Error: "Port already in use"
```bash
# Ver qué proceso usa el puerto
sudo lsof -i :80
# O cambiar el puerto en compose.yaml
```

### Error: "Out of memory"
```bash
# Aumentar memoria disponible o optimizar imágenes
docker system prune -a
```

---

## Notas Importantes

1. **Seguridad:** Nunca expongas el puerto de MySQL directamente a internet
2. **Backups:** Configura backups regulares de la base de datos
3. **Monitoreo:** Considera usar herramientas como Portainer para gestionar Docker
4. **Actualizaciones:** Mantén Docker y las imágenes actualizadas regularmente
5. **Logs:** Configura rotación de logs para evitar llenar el disco
