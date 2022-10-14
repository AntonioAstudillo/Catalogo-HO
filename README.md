# Catalogo-HO
Versión beta del catalogo de Autopartes HO

## Acerca del proyecto

Este proyecto en arquitectura es muy parecido al de dentiware.com 

Esta desarrollado con php, javascript, bootstrap, jquery(datatables) html y css. 

Este catalogo en linea cuenta con un modulo con el cual se podrá administrar los productos que ofrece la empresa. 


El proyecto esta diseñado bajo la arquitectura de Modelo Vista Controlador. 

Trabaje bajo URL amigables por medio de HTACCESS. 

El flujo del proyecto es el siguiente:

En la raíz del proyecto existen dos carpetas y un archivo .htaccess. Las carpetas son app y public. 

En app vamos almacenar toda el core del proyecto y en public almacenamos todo lo que se ejecutara en el cliente. 

Por medio del htaccess en la raiz, mandamos el flujo a la carpeta  public y dentro de esta carpeta hay otro htaccess con el cual le indicamos que todo lo que 
manden desde la url, lo envien como una variable GET llamada url a index.php.

En el archivo index.php, hago una instancia de la clase Control, la cual esta encargada de gestionar la url.

Las caracteristicas que tiene que tener la URL son las siguientes
dominio/controlador/metodo/parametros

El primer elemento despues del dominio es el controlador, el segundo elemento es el metodo asociado al controlador, y lo que nos envien despues del metodo
seran parametros. 


Archivos generales. 

Dentro de App/libs hay un archivo llamado Config.php en él, almaceno la configuración relacionada a la conexion de la base de datos.
Dentro de App/libs hay un archivo llamado Helpers.php, en ese archivo almacene todos los metodos genericos que pude llegar a necesitar dentro del sistema
como por ejemplo, metodos relacionados a la validación o saneamiento de datos.
En App/libs/Mysql.php   se encuentra la conexion PDO a la base de datos. En ese archivo hago uso de las constantes globales que defino en el archivo config.php.

App/libs/Controlador, es una clase generica padre, la cual tiene definida dos metodos, los cuales se utilizan dentro de todos mis clases controladores hijas.
Dichos metodos son el de vista el cual tiene como funcion, hacer un requier de algunas de nuetras views, y el metodo modelo, crea una instancia de un determinado
modelo. 

