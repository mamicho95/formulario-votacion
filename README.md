# formulario-votacion

la version de php usada es la 8.0.28

la version de la base de datos usada es 10.4.28-MariaDB

# Iniciar proyecto con XAMPP

Este proyecto utiliza XAMPP, que es un paquete de software que incluye Apache, MySQL, PHP y Perl. A continuación se detallan los pasos para iniciar el proyecto en tu entorno local utilizando XAMPP.

## Requisitos previos

Antes de comenzar, asegúrate de tener instalado XAMPP v3.3.0 en tu sistema. 

## Pasos para iniciar el proyecto

1. Clona o descarga el proyecto desde el repositorio.

2. Abre XAMPP y asegúrate de que los servicios de Apache y MySQL estén activos. Puedes iniciarlos desde el panel de control de XAMPP.

3. Coloca los archivos del proyecto en la carpeta `htdocs` de tu instalación de XAMPP. Por lo general, esta carpeta se encuentra en la siguiente ubicación:
   - En Windows: `C:\xampp\htdocs`
   - En macOS: `/Applications/XAMPP/xamppfiles/htdocs`
   - En Linux: `/opt/lampp/htdocs`

4. Configure el usuario y la contrasena de la base de datos:
   - Abre la carpeta del proyecto.
   - Edite el archivo 'conexionDB.php'.
   - cambie el usuario y contrasena de su usuario para la base de datos.

5. Importa la base de datos (si es necesario):
   - Abre phpMyAdmin desde el panel de control de XAMPP o accediendo a `http://localhost/phpmyadmin` en tu navegador.
   - Crea una nueva base de datos con el nombre "votacion".
   - Selecciona la base de datos recién creada y ve a la pestaña "Importar".
   - Haz clic en el botón "Examinar" para seleccionar el archivo SQL del proyecto que contiene la estructura y los datos de la base de datos.
   - Haz clic en "Continuar" para importar la base de datos.

6. Accede al proyecto desde tu navegador web:
   - Abre tu navegador web y visita `http://localhost/formulario-votacion`.


