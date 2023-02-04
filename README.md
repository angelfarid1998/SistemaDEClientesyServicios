<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Reto Desarrollador Junior: Sistema de asignación de materias

## Requisitos y pasos previos para ejecutar el proyecto

**Requisitos**

- Tener instalado [Composer](https://getcomposer.org/download/).
- Tener instalado [Node](https://nodejs.org/es/download/).
- Tener instalado [Laravel 9](https://laravel.com/docs/9.x).

**Pasos**

Para ejecutar el proyecto de manera local debe seguir los siguientes pasos.

- Configuracion del archivo ` .env `.
    <br> 1. Copiar archivo `.env.example`.
    <br> 2. Pegar ahi mismos al realizar esto sera creado un archivo `.env copy.example`.
    <br> 3. Luego cambiamos el nombre del archivo `.env copy.example` a ` .env `.
    
- Ejecutamos el siguiente comando:
```
composer install
```
Este comando va a crear la carpeta `vendor` y descargar todas las dependencias de composer que el proyecto necesita para ser ejecutado.

- Ejecutamos el siguiente comando:
```
npm install
```
Este comando va a crear la carpeta `node_modules` y descargar todas las dependencias de composer que el proyecto necesita para ser ejecutado.

- Ejecutamos el siguiente comando:
```
npm run dev
```
Para activar las caracteristicas de [Laravel + Vite](https://laravel.com/docs/9.x/vite) con las que cuenta el proyecto.

- Ejecutamos el siguiente comando para ejecutar el proyecto:
```
php artisan serve
```
Una vez ejecutado el comando le generara una direccion web local ejemplo: `http://127.0.0.1:8000` donde podra visualizar el proyecto.

## Migraciones de base de datos

Para la ejecucion de las migraciones del proyecto debe seguir los siguientes.

- previamente debe crear la base de datos con el mismo nombre que aparece en el archivo `.env` del proyecto en su gestor de base de datos. 
    <br> - Solo la base de datos sin tablas.
    <br> - El nombre de la base de datos esta ubicado en el archivo `.env` luego busca la propiedad `DB_DATABASE`.

- Ejecutar el comando:
```
php artisan migrate
```
Este comando creara todas las tablas que se encuentren dentro de la carpeta `database/migrations`.

## Aclaraciones

- El comando `npm run dev` y `php artisan serve` debe ser ejecutados en simultaneo.
