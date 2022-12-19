Para levantar el proyecto

- Importar base de datos
  mysql -u usuario -p testdoka < testDoka.sql
- instalar paquetes composer
  composer install
- iniciar servidor symfony
  symfony server:start
- Para usar la api, comentar las ultimas 4 lineas del archivo config/packages/fos_rest.yaml, reiniciar servidor
- En el archivo TestDoka.postman_collection.json se encuentran las consultas a las api, solo hay que importar el archivo
