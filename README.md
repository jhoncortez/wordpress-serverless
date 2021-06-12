# DEMO - PRUEBA HOME JONATHAN CORTES
Link demo: https://portfolio.ideastudioweb.com/

esta primera versión del sitio es solo para fines de demostración

# wordpress-serverless LOOPER ART
* INSTALACIÓN MANUAL
1. bajar el zip del proyecto o clonar con git
2. descromprimir y extraer la carpeta wpbackend y el zip bd.zip
3. subir los archivos de la carpeta wp-backend al servidor
4. configurar e importar la bd con phpmyadmin en cpanel

*configuracion de la bd
descomprima el sql que se encuentra en el archivo bd.zip
reemplaze las variables indicads en el archivo instrucciones que está dentro del zip
las variables a reemplazar son //REEMPLAZAME.COM y /RUTA/CARPETA/PUBLIC 

*importar bd
Cree una base de datos nueva en cpanel sin tablas
use la funcion de importar para subir el sql que acaba de modificar.

*reemplazar accesos a bd en wp-config
se deben reemplazar los accesos de conexion a la nueva bd en el archivo config.

por ultimo ingrese con los accesos del admin para personalizar el home.

# opciones personalizables.
entre las opciones personalizables del home se encuentran
1. hero section ( imagen, titulo, descripcion, link, text link, )
2. featured section ( imagen, descripción, link, text link, id )
3. Projects section ( switch activacion de seccion on/off, cantidad de proyectos a mostrar, titulo sección, descripcion, modo carrusel on/off, id )
4. Testimonials section ( switch activacion de seccion on/off, cantidad de testimonios a mostrar, titulo sección, descripcion, id )

# menus
la página cuenta con configuracion para dos menús, sin embargo esta version solo se logro optimizar la principal

# CPT
se hizo uso del plugin custom post types y acf para la creaciond el CPT project y los campos personalizados para project, testimonials y home
*PROJECT CPT
los proyectos cuentan con campos para imagen, descripccion, cliente, url proyecto y showcase de galerias. (solo backend. no hay configurada una vista para este cpt, solo algunas opciones en el home)

*TESTIMONIAL
se crea a lo ultimo cpt testimonial por medio de los archivos de funciones de la plantilla. 
los testimonials cuentan con campos para imagen, descripcion, y nombre. (solo backend. no hay configurada una vista para este cpt, solo se visualizan en el home)

# LIBRERIAS DESARROLLO
se utilizaron las librerias TAILWIND compiladas con SASS y POSTCSS para la optimizacion del archivo final de estilos.
se utilizo vanilla javascript para algunas funciones
la plantilla a usar es _s underscore con el cual viene con archivos php, sass listos para llenarlos con contenido personalizado y crear a la medida. esta plantilla solo funciona con sass asi que se realizo una integracion con TAILWIND para complementar los estilos personalizados a la medida sin necesidad de usar bootstrap y jquery.

# COMPONENTES
se desarrollaron diversos componentes para la funcionalidad y visualizacion del home. (carrusel, menu, hero, quotes, testimonios, bloques de contenido, titulos, botones)

# EFECTOS
cuenta con algunos efectos construidos con las utilidades que proporciona TAILWIND ( transiciones, transforms, sombras, scales, rotates)

Este proyecto incialmente se desarrollaria usando WORDPRESSS como servicio backend y FRONTITY (basado en react) como servicio frontend el cual se comunicarian por medio de la apirest de wordpress para mostrar la informacion en el front end mejorando las cargas y experiencias de navegación, asi que se continuara en futuras versiones de esta página.

# DEMO
puede ver la página funcionando en linea en el subdominio de ideastudioweb.com 

Demo: https://portfolio.ideastudioweb.com/ 
