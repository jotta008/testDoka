Para levantar el proyecto

- Importar base de datos
  mysql -u usuario -p testdoka < testDoka.sql
- instalar paquetes composer
  composer install
- iniciar servidor symfony
  symfony server:start
- Para usar la api, comentar las ultimas 4 lineas del archivo config/packages/fos_rest.yaml
