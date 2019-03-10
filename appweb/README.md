# Sistema de Administración Fundación Colono

## 1. Instalación.


### 1.1 Requisitos.

> Ya que el proyecto está desarrollado en PHP y con [Laravel](https://laravel.com/), deben instalarse las siguientes dependencias antes de instalar la aplicación:
>     
  * [Composer](https://getcomposer.org/)
  * PHP >=7.0-FPM
      * php-xml
      * php-zip
      * php-mbstring
      * php-mysql
      * php-mcrypt
  * Servidor Web (NGINX recomendado)
  * MySQL Server (latest non-beta)

### 1.2 ¿Cómo instalar?
> 
 1. Instalar [Laravel](https://laravel.com/docs/5.5#installation) (leer documentación detenidamente).
 2. Clonar o descargar el repositorio.
 3. Navegar a la carpeta raíz.
 4. Instalar aplicación de *Laravel*: `laravel new preinstall`.
 5. Navegar a *preinstall* y copiar todos los archivos (incluso los ocultos)
 6. Pegar los archivos copiados en la carpeta *[project root]/src*. **Mezclar** las carpetas pero <u>**NO**</u> reemplazar los archivos. Esto incluirá los archivos del necesarios del framework que no se encuentran en los archivos fuente del proyecto.
 7. Editar el archivo .env para satisfacer los valores de entorno de la aplicación.
      * **APP_NAME**: Nombre de la aplicación ("Fundación Colono", preferiblemente, incluidas comillas dobles).
      * **DB_HOST**: Dirección IP o nombre de dominio del servidor de base de datos MySQL.
      * **DB_PORT**: Puerto de conexión a base de datos.
      * **DB_DATABASE**: Nombre de la base de datos.
      * **DB_USERNAME**: Nombre de usuario de la base de datos.
      * **DB_PASSWORD**: Contraseña para el usuario de la base de datos.
 8. Crear base de datos. El nombre debe corresponder al especificado en la clave *DB_DATABASE* del archivo *.env*


## 2. Migrar Base de Datos.

> Una vez preparada la configuración básica de la aplicación, es suficiente con navegar a la carpeta raíz del proyecto y correr el siguiente comando de *artisan*:

    php artisan migrate:fresh --seed

> Este comando creará las tablas necesarias en la base de datos y las poblará con datos ficticios proporcionados por [Faker](https://github.com/fzaninotto/Faker).

> Si se desea migrar las tablas solamente, basta con correr el comando:

    php artisan migrate

> Para eliminar todos los registros de las tablas, usar el comando:

    php artisan db:seed --class=DatabaseUnseeder


## 3. Configurar servidores web.

### 3.1 NGINX

### 3.x Otras configuraciones.

> En caso de que la URL deseada para la aplicación sea un subdirectorio (ej: http://midominio.com/fundacion_colono/), debe configurarse el sufijo en la aplicación de frontend de AngularJS, en el archivo *[project root]/src/public/app/app.js*.

    app.config(function(AppResourceProvider){
      AppResourceProvider.extras = 'fundacion_colono'
    })

