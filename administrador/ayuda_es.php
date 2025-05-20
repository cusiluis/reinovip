<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("admin.traducciones.php");

$nombreusuario=$_SESSION['usuariolog'];
// valido el usuario en la tabla de logueos
	$tablaL=$Prefijo."logueo";
	$SQL="SELECT * FROM $tablaL WHERE Nombre='$nombreusuario' ";
	$ResultL=mysql_query($SQL);
	$cantreg=mysql_num_rows($ResultL);
	if ($cantreg < 1) $nombreusuario="";
//
if ($nombreusuario=="") {
	header("Location: admin.php?mensaje=".utf8($error_accesoindebido).".");
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>BackOffice :: <?php echo utf8($NombreSitio) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php include("metatags.txt"); ?>
<link href="admin.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php include("topadmin.inc.php"); ?>
<table border="0" cellpadding="5" cellspacing="0">
  <tr>
	<td>
			  <font face="Arial, Helvetica, sans-serif" size="2" color="#000000">
			  <font color="#000066" size="3"><b>EL MENU DE INICIO</b></font><br>
			  <br>
			  una vez logueado (iniciada una sesión) dentro del administrador de 
			  contenidos -habitualmente llamado backoffice o backend- usted tiene 
			  cuatro botones disponibles en todo momento:<br>
			  <br>
			  <font color="#CC3300"><b>HOME</b></font><br>
			  este botón le permite en todo momento volver al menú de inicio 
			  del backoffice<br>
			  <br>
			  <font color="#CC3300"><b>DATOS PERSONALES</b></font><br>
			  le permite cambiar los datos de ingreso o de inicio de sesión. 
			  el nombre y la clave de acceso.<br>
			  <br>
			  <font color="#CC3300"><b>CERRAR SESION</b></font><br>
			  cierra la sesión de trabajo, y vuelve a la página de log-in o de 
			  inicio de sesión.<br>
			  <br>
			  <font color="#CC3300"><b>AYUDA</b></font><br>
			  esta página<br>
			  <br>
			  <br>
			  cada backoffice tiene una serie de opciones de trabajo, que se 
			  traducen en una lista a dos columnas de opciones accesibles. a modo 
			  de ejemplo, se vén estas opciones:<br>
			  <br>
			  <div align="center">
			  <img src="img/ayuda_1.gif">
			  </div>
			  <br>
			  en cada backoffice, cada función aquí detallada será única en 
			  cuanto a su funcionalidad dentro de la parte pública (o front-end, 
			  como se conoce habitualmente). Así, cada tabla y función 
			  detallada en la lista de opciones accesibles, será propia de 
			  cada sitio, y en particular de las opciones requeridas al momento 
			  del armado dinámico del mismo.<br>
			  <br>
			  No obstante, las funciones de manejo de listas y registros son 
			  idénticas para todos los sitios y tablas, donde las 
			  funcionalidades generales se describen en esta ayuda.<br>
			  <br>
			  <br>
			  <font color="#000066" size="3"><b>LAS LISTAS DE REGISTROS</b></font><br>
			  <br>
			  cada tabla (o archivo) esta compuesto de múltiples registros (o 
			  filas), de un conjunto "fijo" de datos. Estos, a su vez, tienen 3 
			  campos (cada campo es una unidad de datos dentro de un registro), 
			  que son fijos en todas:<br>
			  <b>a)</b> un número identificador del registro y su creación (ID) 
			  único dentro de la tabla;<br>
			  <b>b)</b> un identificador Sí-No para saber si el registro será 
			  visto en la parte pública o no, esto implica que un registro 
			  marcado con Público en No hará que los datos del mismo nunca 
			  sean accedidos desde la parte pública (o sea, en la web);<br>
			  y <b>c)</b> un Nombre sobre el cual se podrán hacer búsquedas 
			  de registros dentro del backoffice o parte privada.<br>
			  <br>
			  <div align="center"><img src="img/ayuda_2.gif"></div>
			  <br>
			  como se ve en el dibujo, existe muchas opciones de configuración 
			  de esta página, para hacer mas comoda la navegación y la 
			  administración de los datos de la tabla.<br>
			  <br>
			  <b>descripción de las funciones</b><br>
			  <br>
			  hay dos funciones de "filtrado" de la lista, <b>a)</b> por un 
			  número de registro o ID, donde el resultado será un solo registro, 
			  que cumpla con esa condición, y <b>b)</b> por una parte del nombre 
			  que se lista (permite buscar indistintamente entre mayúsculas y 
			  minúsculas, por partes enteras o parciales).<br>
			  ambas opciones se acceden en las cajas de nº de Item y Nombre 
			  (para este caso, en cada tabla, el campo de consulta puede variar). 
			  luego debe hacer click sobre el boton de <font color="#663333"><b>&gt;&gt;</b></font>.<br>
			  <br>
			  existe también la opción de cambiar la cantidad de ítems mostrados en 
			  la página. por defecto, el número es 40 (cuarenta), pero puede 
			  modificar este número para mostrar mas o menos registros. en todos 
			  los casos, muestra los indicados aquí como tope máximo, y los últimos 
			  cargados.<br>
			  <br>
			  existe en esta instancia, el botón de <font color="#663333"><b>Agregar &gt;&gt;</b></font>, 
			  que me abre una página configurada especialmente para agregar un 
			  registro a esta tabla.<br>
			  <br>
			  <b>la lista</b><br>
			  <br>
			  la lista de registros siempre muestra 4 columnas. el nº de item, 
			  o número ID, identificador único del registro, para poder identificar 
			  unívocamente del dato que se trata. la segunda columna muestra con 
			  una <b>·P·</b> si el registro es público, y se ve en la web, o con 
			  nada, si es lo contrario. la tercer columna muestra el nombre o 
			  título identificador del registro, para que sea algo mas simple 
			  su ubicación dentro de la tabla. este nombre o título identificador 
			  puede estar repetido. y por último, una columna con las 
			  acciones disponibles para cada registro. los casos que están 
			  siempre presentes son dos: <b>a)</b> <u>modificar</u>, donde se 
			  abrirá una página para modificar el contenido del registro en 
			  cuestión, y <b>b)</b> <u>eliminar</u>, donde se eliminará 
			  temporalmente el registro de la lista y quedará inactivo para su 
			  uso dentro de la parte privada y pública. es importante destacar 
			  que el registro no es borrado totalmente, sino que quedará en 
			  una instancia recuperable, a modo de papelera de reciclaje.<br>
			  <br>
			  <b>opciones en el pie</b><br>
			  <br>
			  existe un botón de <font color="#663333"><b>Eliminar Definitivo x Criterio &gt;&gt;</b></font> 
			  que permitirá eliminar un conjunto de registros que cumplan con una 
			  determinada condición impuesta.<br>
			  existe un botón para acceder a la recuperación de registros eliminados 
			  <font color="#663333"><b>Recuperar Datos &gt;&gt;</b></font> donde allí se 
			  verán los registros borrados, a modo de papelera de reciclaje, con la 
			  opción accesoria de eliminar definitivamente todos los registros 
			  borrados, a modo de "vaciar la papelera de reciclaje".<br>
			  el botón de <font color="#663333"><b>&lt;&lt; Volver</b></font> nos remite a 
			  la pantalla principal, desde donde fue llamada esta misma.<br>
			  <br>
			  <br>
			  <font color="#000066" size="3"><b>DANDO DE ALTA UN REGISTRO</b></font><br>
			  <br>
			  el mecanismo de agregado de un registro a la tabla es muy 
			  sencillo. con solo entrar a traves del botón de 
			  <font color="#663333"><b>Agregar &gt;&gt;</b></font> se accederá a 
			  una página de alta de registro que es única para cada tabla, 
			  pero también tiene detalles comunes a todas.<br>
			  <br>
			  <div align="center"><img src="img/ayuda_3.gif"></div>
			  <br>
			  como se vé en este ejemplo, usted va definiendo el valor de 
			  cada "campo" o unidad de datos según sean las opciones 
			  disponibles. en todos los casos, al pie, y como último campo, 
			  aparece la opción Público Sí-No.<br>
			  <br>
			  el botón de <font color="#663333"><b>&lt;&lt; Volver</b></font> 
			  cancela la opción de agregado de un registro, mientras que 
			  el botón de <font color="#663333"><b>Agregar &gt;&gt;</b></font> 
			  lo adiciona a la tabla con los datos suministrados.<br>
			  <br>
			  <b>notas</b><br>
			  <br>
			  para el caso de datos que se relacionen con otras tablas, 
			  la página presentará un menú desplegable con las opciones 
			  disponibles. en caso que la opción requerida no esté 
			  agregada aún, debe agregarla en la tabla correspondiente.<br>
			  <br>
			  <div align="center"><img src="img/ayuda_4.gif"></div>
			  <br>
			  para el caso un campo tipo "memo", que admite muchos renglones 
			  de texto y demás, en todos los casos también admitirá comandos 
			  html para incorporar tipografias, imágenes, grillas, colores, 
			  tamaños, etc.<br>
			  los símbolos mas utilizados son:<br>
			  a) para poner un texto en negritas: <b>&lt;b&gt;</b> texto que va en negrita<b>&lt;/b&gt;</b><br>
			  b) para hacer un control de carro, (o enter): <b>&lt;br&gt;</b><br>
			  c) para poner una linea horizontal, divisoria, que ocupe todo el ancho: <b>&lt;hr&gt;</b><br>
			  d) para incorporar un link: <b>&lt;a href=&quot;otrapagina&quot;&gt;texto&lt;/a&gt;</b><br>
			  e) para incorporar una imagen: <b>&lt;img src=&quot;ruta de la imagen&quot;&gt;</b><br>
			  f) para alinear algo al centro: <b>&lt;div align=&quot;center&quot;&gt;lo que quiere 
			  alinear&lt;/div&gt;</b><br>
			  y así muchos mas....<br>
			  <br>
			  para el caso de archivos adjuntos, existe un botón de examinar, 
			  para buscar el archivo que desea dentro de su disco rígido o red 
			  local (LAN) y pasarlo como dato asociado al registro. este 
			  archivo en ningún caso se guarda dentro del registro de la base 
			  de datos, y no puede tener mas de 2 MB de tamaño.<br>
			  <br>
			  para el caso de imágenes JPG, es igual que archivos adjuntos, 
			  pero con una salvedad importante: la imagen se redimensionará según 
			  lo especifica la página, creando 2 imágenes a partir del original 
			  que se le pase. una, mas pequeña, que se utilizará com miniatura, 
			  y otra, de las dimensiones máximas que estan especificadas en cada 
			  caso. nunca utilice imagenes menores a esta resolución, pues al 
			  "agrandar" la imágen, para ajustarla al tamaño requerido es muy 
			  posible que pixele.<br>
			  <br>
			  <br>
			  <font color="#000066" size="3"><b>ELIMINANDO REGISTROS POR UN CRITERIO DADO</b></font><br>
			  <br>
			  accediendo en la opción <font color="#663333"><b>Eliminar Definitivo x Criterio &gt;&gt;</b></font> 
			  accederá a una página que actuará sobre todos los registros 
			  (públicos y no públicos) de la tabla.<br>
			  <br>
			  <div align="center"><img src="img/ayuda_5.gif"></div>
			  <br>
			  así, de una manera muy sencilla, podrá eliminar un conjunto 
			  de registros que cumplan una condición dada.<br>
			  <br>
			  <br>
			  <font color="#000066" size="3"><b>RECUPERACION DE DATOS ELIMINADOS</b></font><br>
			  <br>
			  si se arrepintió de alguna eliminación, o bien, cree que efectivamente 
			  quiere eliminar en forma definitiva los registros, deberá entrar en la 
			  opción <font color="#663333"><b>Recuperar Datos &gt;&gt;</b></font> 
			  y seguir las instrucciones que se le presentan en la página.<br>
			  <br>
			  <div align="center"><img src="img/ayuda_6.gif"></div>
			  <br>
			  como ve aquí, tiene la opción de eliminar todo, donde blanqueará 
			  el contenido de la papelera de reciclaje de esta tabla, o bien 
			  recuperar o eliminar definitivo para el cada registro en 
			  particular.<br>
			  <br>
			  <br>
			  <font color="#000066" size="3"><b>MODIFICANDO DATOS</b></font><br>
			  <br>
			  esta página es muy similar a la de agregar un registro, donde 
			  el único cambio es que ahora los datos aparecen "puestos", 
			  es decir, aparecen los datos ingresados con anterioridad.<br>
			  <br>
			  <div align="center"><img src="img/ayuda_7_a.gif"></div>
			  <br>
			  <div align="center"><img src="img/ayuda_7_b.gif"></div>
			  <br>
			  es importante tener en cuenta que si modifica datos, los datos 
			  nuevos reemplazarán a los anteriores y se perderán definitivamente. 
			  el sistema no tiene posibilidad de deshacer una modificación de 
			  registro.<br>
			  <br>
			  <br>
			  </font>		  
	</td>
  </tr>
</table>
</body>
</html>

