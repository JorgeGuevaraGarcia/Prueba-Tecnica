# Prueba-Tecnica

Descargar el proyecto
-
```
git init
git remote add origin https://github.com/JorgeGuevaraGarcia/Prueba-Tecnica.git
git pull origin main
```

Crear base de datos y usuario 
- 
Entrar a mysql desde terminal
```
mysql -u root
```
Para crear la base de datos se encesitan el siguiente comando:
```
CREATE DATABASE prueba_tecnica;
```
Se necesita crear el usuario para la conección con la base de datos:
```
CREATE USER 'nombre_usuario'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON prueba_tecnica.* TO 'nombre_usuario'@'localhost';
```
Cambiar usuario y contraseña en archivo .env del proyecto 
-
Ya una vez creado el usuario es necesario cambiar DB_USERNAME y DB_PASSWORD, estas corresponden al usuario creado anteriormente

```
DB_USERNAME=nombre_usuario
DB_PASSWORD=password
```

Ejecutar el servidor
-
Ya creada la base de datos entras a la carpeta Prueba-Tecnica y utilizando composer en la terminal
```
php artisan migrate
php artisan serve
```
