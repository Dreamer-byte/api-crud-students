# API CRUD STUDENTS
Este es una api sensilla que se encarga de hacer las
operaciones basicas de una api rest(CREATE, READ, UPDATE, DELETE).
La estructura de la base de datos es la siguiente (hasta el momento):
Tabla students que contiene los siguientes campos:

- **id**:         Indentificador único del estudiante.
 - **name**:  el nombre del estudiante.
 - **email**:  correo electronico del estudiante (desde el backend se valida que sea único).
 - **phone** :Teléfono móvil del estudiante (desde el backend se valida que sea único).
 -  **language**: idioma del estudiante siendo **en** para ingles y **es** para español.

El endpoint definido es /api/students
Puedes ver las rutas definidas con el comando:

    php artisan route:list
 Rutas:
 

 1. Metodo: GET: api/students devuelve una lista de todoos los estudiantes
      metodo del controlador encargador : students.index › ApiStudenController@index
      
2. Metodo POST: api/students este metodo a este ruta se envia el estudiante que se
    quiere resgistrar en la base de datos,  devuelve el estudiante creado en caso de
    tener éxito, metodo en el controlador que se encarga de manejar la peticion:   
    students.store › ApiStudenController@store.
    
3. Metodo GET: api/students/{id}  extrae un estiante coinsidente con el id que se pasa en       la url, metodo encargado de manejar la petición: students.show › 
     ApiStudenController@show
4. Metodo PUT|PATCH:  api/students/id recive el id del estudiante a modificar y los        campos del estudiante que se quieren modificar (es obligatorio enviar todos los campos aunque no se modifiquen) devuelve el estudiante modificado. El metodo encargado 
 de manejar la petición es: students.update › ApiStudenController@update
 5. Método DELETE : api/students/id recive el id del estudiante a borrar y devuelve un **message** de "estudiante borrado" metodo en el controlador que se encarga de la 
  petición : students.destroy › ApiStudenController@destroy
---

##  Componentes con los que se desarrollo el proyecto:
1. Composer version 2.6.3
2. Laravel Framework 10.48.8
3. PHP 8.1.17 
4. MySQL 8.0.30

## Como instalarlo.
1. **Clonar el repositorio desde GitHub**:
       Abre una terminal o línea de comandos y navega al directorio donde deseas clonar el repositorio del proyecto. Luego, ejecuta el siguiente comando para clonar el repositorio desde GitHub:
         ``  git clone [enlace del repositorio]``
Reemplaza  ** [enlace del repositorio] **por el enlace de este repositorio.

2. **Instalar dependencias de Composer**: Una vez que el repositorio se haya clonado correctamente, navega al directorio del proyecto Laravel recién creado. Por ejemplo:
``    cd [nombre del repositorio]``
Una vez dentro del directorio del proyecto, ejecuta el siguiente comando para instalar las dependencias de Composer:
``    composer install``
Este comando descargará e instalará todas las dependencias de PHP necesarias para el proyecto Laravel.

3. **Copiar el archivo de configuración**: Laravel utiliza un archivo de configuración llamado `.env` para almacenar la configuración de la aplicación, como las credenciales de la base de datos. Copia el archivo `.env.example` y renómbralo a `.env`:

    ``cp .env.example .env``
Tenga en cuenta que el comando cp en windows no se encuentra disponible para cmd, pero puede utilizar lo desde powershell de windows o si tiene descargado gitbash tambien le funcionaria.

4. **Generar una clave de aplicación**: Ejecuta el siguiente comando para generar una nueva clave de aplicación para tu proyecto Laravel:
``    php artisan key:generate``
    Esto generará una clave única para tu aplicación y la almacenará en el archivo `.env`.
    
5. **Configurar la base de datos**: Abre el archivo `.env` en un editor de texto y configura las opciones de la base de datos según sea necesario. Asegúrate de configurar los siguientes valores:
``` DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_base_de_datos
    DB_USERNAME=nombre_usuario
    DB_PASSWORD=contraseña
```
Reemplaza `"nombre_base_de_datos"`, `"nombre_usuario"` y `"contraseña"` con los detalles de tu base de datos MySQL.

7.  **Ejecutar migraciones**: El proyecto Laravel utiliza migraciones de base de datos para crear la tabla sudents, ejecuta las migraciones para crear las tablas en  la base de datos utilizando el siguiente comando:
``php artisan migrate``

8. **Iniciar el servidor de desarrollo**:
`` php artisan serve ``
el comando anterior si te genera una url como la siguiente:
``http://127.0.0.1:8000`` aqui es en donde se ha montado tu servidor de desarrollo,
para acceder a las ruta que te muestra todos los estudiantes basta con hacer una
petecion como la siguiente: 
`` http://127.0.0.1:8000/api/students``

### Nota: 
	En mi caso para probar los endpoints utilice Insomnia pero tambien
	puedes usar postman o cualquier otro.