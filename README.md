<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Pasos a seguir

1. Despues de clonar el repositorio 
instalemos las dependencias 
```bash
composer install
```

2. No olvides renombrar el archivo de varibles de entorno 
`.env.example` a `.env` y configurar tu base de datatos

3. Genere la clave de tu aplicación
```bash
php artisan key:generate
```

4. Crea una base de datos para las migraciones
```sql
CREATE DATABASE dev_providers CHARACTER SET utf8 COLLATE utf8_general_ci;
```

5. Ejecutar las migraciones
```bash
 php artisan migrate
```
5. Ejacutar los seed 
```bash
 php artisan db:seed
```

7. Ejecutar el proyecto 
```bash
php artisan serve
```