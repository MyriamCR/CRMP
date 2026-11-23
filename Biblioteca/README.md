# Mi Biblioteca Digital

## 1. Descripción del proyecto

Mi Biblioteca Digital es una aplicación web desarrollada en PHP y MySQL que permite administrar una colección de libros. Los usuarios pueden registrar sus propios libros, consultar su colección, editar información y buscar libros por título.

El sistema cuenta con dos tipos de usuarios:

- **Administrador:** puede consultar, registrar, editar y eliminar libros de todos los usuarios.
- **Usuario:** puede registrar, consultar, editar y administrar únicamente sus propios libros.

También cuenta con un panel principal que muestra indicadores sobre la cantidad de libros registrados, pendientes, en lectura y terminados.

## 2. Tecnologías utilizadas

- HTML
- CSS
- Bootstrap
- PHP
- MySQL
- WAMP Server como servidor local.
- Visual Studio Code como editor de código.

## 3. Requisitos para la instalación

Antes de ejecutar el proyecto, es necesario contar con:
- WAMP Server instalado.
- Visual Studio Code o algún editor de código.
- MySQL y Apache funcionando desde WAMP.

### Paso 1. Copiar la carpeta del proyecto

Coloca la carpeta `biblioteca` dentro del directorio `www` de WAMP.

La ruta debe quedar de la siguiente manera:

`C:\wamp64\www\biblioteca`

### Paso 2. Iniciar WAMP Server

Abre WAMP Server y verifica que los servicios de Apache y MySQL estén funcionando correctamente.

### Paso 3. Crear la base de datos

1. Abre phpMyAdmin desde tu navegador.
2. Ingresa a la sección de bases de datos.
3. Importa el archivo `sql/biblioteca.sql`.
4. Este archivo contiene las instrucciones para crear la base de datos, sus tablas y la cuenta administrativa de prueba.

La base de datos utilizada por el proyecto se llama: `biblioteca_digital`

### Paso 4. Configurar la conexión

Abre el archivo:

`config/conexion.php`

Verifica que los datos de conexión correspondan a la configuración de tu servidor MySQL.

Configuración utilizada en el proyecto:

- Servidor: localhost
- Puerto: 3308
- Base de datos: biblioteca_digital
- Usuario: root
- Contraseña: (vacía)

Si utilizas otros datos de conexión, modifica los valores correspondientes en este archivo.

### Paso 5. Abrir el proyecto

Una vez realizados los pasos anteriores, abre tu navegador e ingresa a:

`http://localhost/biblioteca/`

Desde esta dirección podrás acceder a la aplicación e iniciar sesión.

## 4. Credenciales de demostración

Para probar el sistema se proporciona una cuenta administrativa:

**Administrador**

- Correo electrónico: admin@biblioteca.com
- Contraseña: Admin123
- Rol: admin

La cuenta debe estar incluida en el archivo SQL de instalación. La contraseña se almacena mediante un hash para mayor seguridad.
También es posible crear cuentas nuevas desde la opción **Registrarse**. Las cuentas creadas mediante el formulario público reciben automáticamente el rol de usuario.

## 5. Funcionalidades principales

### Inicio de sesión y registro
- Registro de nuevos usuarios.
- Validación de correo electrónico.
- Verificación de contraseña.
- Almacenamiento seguro de contraseñas mediante hash.
- Cierre de sesión.

### Administración de libros
- Registrar nuevos libros.
- Consultar libros registrados.
- Editar información de los libros.
- Eliminar libros.
- Buscar libros por título.
- Asignar un estado a cada libro:
  - Pendiente.
  - Leyendo.
  - Terminado.

### Dashboard
- Total de libros registrados.
- Cantidad de libros pendientes.
- Cantidad de libros en lectura.
- Cantidad de libros terminados.

### Control de acceso
- Diferenciación entre administrador y usuario.
- Restricción de acceso según el rol.
- Los usuarios solamente pueden modificar sus propios libros.
- El administrador puede administrar los libros de todos los usuarios.


## 6. Consideraciones

- Es necesario mantener Apache y MySQL activos para utilizar el sistema.
- La base de datos debe importarse antes de iniciar sesión.
- Las contraseñas de los usuarios se almacenan mediante `password_hash()`.
- Las consultas a la base de datos utilizan PDO y consultas preparadas.
- El acceso a las páginas internas requiere iniciar sesión.