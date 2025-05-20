<?php
//debbug :: echo "adminstyle: ".$adminstyle."<br>";

$bt_espaniol="Español";
$bt_ingles="English";

if ($adminstyle=="en") {

	/*************************************************************************/
	/************* INGLES ****************************************************/
	/*************************************************************************/

	$tit_login="Backoffice Access";
	$tit_datospersonales="Personal Information";
	$alt_inicio="Backoffice Home Page";
	$clave="Key";
	$tit_remover_imagen="Remove Image";
	$tit_cambiar_imagen="Change Image";
	$tit_abrir_archivo="Open";
	$tit_remover_archivo="Remove File";
	$tit_cambiar_archivo="Change File";
	$tit_recuperar_eliminar="Recover / Definitive Delete";
	$lk_recuperar="Recover";
	$lk_definitivo="Definitive Delete";
	$bt_eliminartodo="Definitive Delete All";
	
	$NombreMes[1]="Jan";
	$NombreMes[2]="Fab";
	$NombreMes[3]="Mar";
	$NombreMes[4]="Apr";
	$NombreMes[5]="May";
	$NombreMes[6]="Jun";
	$NombreMes[7]="Jul";
	$NombreMes[8]="Aug";
	$NombreMes[9]="Sep";
	$NombreMes[10]="Oct";
	$NombreMes[11]="Nov";
	$NombreMes[12]="Dec";

	$vecmes[1]="January";
	$vecmes[2]="Febrary";
	$vecmes[3]="March";
	$vecmes[4]="April";
	$vecmes[5]="May";
	$vecmes[6]="June";
	$vecmes[7]="July";
	$vecmes[8]="August";
	$vecmes[9]="September";
	$vecmes[10]="October";
	$vecmes[11]="November";
	$vecmes[12]="December";
	
	$lk_modificar="Modify";
	$lk_eliminar="Delete";
	$lk_verparrafos="See Paragraphs";
	$lk_verformulario="See Form";
	$lk_cerrar="Close Content";
	$lk_abrir="See Content";
	$lk_nuevodoc="New Document";
	$lk_nuevofor="New Form";
	$lk_vermes="See Entire Month";
	$lk_verip="Trace IP";
	$lk_imagen="Click Here for Add Image";
	$lk_verimagen="Click Here to See the Image in the Real Size";
	$lk_eliminarimagen="Delete Image";
	$lk_agregararchivo="Click Here to Add File";
	$lk_agregar="Add New";
	$lk_agre="Add";
	
	$error_accesoindebido="Wrong Access";
	$error_noestadoc="Indefined Document";
	$error_noestafor="Indefined Form";
	$error_backoffice="Wrong Access to the Backoffice";
	$error_usuarionohabilitado="This User is not available to use the Backoffice";
	$error_claveinvalida="Invalid password";
	$error_usuarioinvalido="User not registered";		
	$error_nombrevacio="Error: You must complete the Username";
	$error_clavevacio="Error: You must complete the Password";
	$error_sitiovacio="Error: You must complete the Site name";
	$error_vacio="must contain data";
	$error_mailinvalido="must contain a valid e-mail address";
	$error_numero="must contain a number";
	$error_noseenviomail="Error: The E-Mail cannot be sended.";
	$error_nohayregistromail="The record of E-Mail was not fount for the ID";
	$error_algrabar="Saving";
	$error_aleliminar="Deleting";
	$error_almodificardatospersonales="Modifying personal info";
	$error_almodificar="Modifying";
	$error_alrecuperar="Recovering";
	$error_noesjpg="Image have no Format JPG";
	
	$tit_mapadesitio="Site Map";
	$tit_resultado="Result";
	$tit_filtroaplicado="Applicated Filter";
	$tit_item="IDº";
	$tit_elitem="The Item";
	$tit_secciones="Sections";
	$tit_nombre="Name/s";
	$tit_documento="Document";
	$tit_formulario="Form";
	$tit_titulo="Title<br>Text";
	$tit_foto="Photo<br>Apostille";
	$tit_acciones="Actions";
	$tit_campo="Field";
	$tit_modulo="Module";
	$tit_agregararchivo="Adding File to";
	$tit_agregarimagen="Adding Image to";
	$tit_error="Error";
	$tit_agregando="Adding New";
	$tit_modificando="Modifying";
	$tit_datosobligatorios="Obligatory Fields";
	$tit_eliminaron="Have been erased";
	$tit_registros="records";
	$tit_eliminandoregistros="Deleting Records";
	$tit_envioa="sended to";
	$tit_estadisticas="Entry Statistics";
	$tit_enviocorreo="Sending E-Mails to Suscriptors";
	$tit_entradasgenerales="General Entries";
	$tit_cantidad="Quantity";
	$tit_periodo="Period";
	$tit_totales="TOTAL";
	$tit_ayudas="Help";
	$tit_fechahora="Date/Time";
	$tit_ip="IP";
	$tit_entradasip="Entries for the IP";
	$tit_totalperiodo="TOTAL FOR THE PERIOD";
	$tit_modificareliminar="Modify / Delete";
	$tit_buscar="Search";
	$tit_regxpag="Rec x Page";
	$tit_ayudasmapa="Help for the Site Map";
	$tit_agregadobien="Have been successfully added";
	$tit_eliminadobien="Have been successfully deleted";
	$tit_datospersonalesbien="The pesonal info have been modify successfully";
	$tit_modificadobien="Have been successfully modified";
	$tit_recuperadobien="Have been recovered successfully";
	$tit_itemdesde="ID Since";
	$tit_itemhasta="To";
	
	$bt_ayudasmapa="(?) Help for the Site Map";
	$bt_agregarseccion="Add Section";
	$bt_volver="Previous";
	$bt_agregarparrafo="Add Paragraph";
	$bt_agregarcampofor="Add Field to the Form";
	$bt_cancelar="Cancel";
	$bt_login="Log in";
	$bt_modificar="Modify";
	$bt_agregararchivo="Add File";
	$bt_agregarimagen="Add Image";
	$bt_agregar="Add";
	$bt_eliminarregistros="Delete Records";
	$bt_eliminarxcriterio="Delete by Criteria";
	$bt_recuperar="Recover Data";
	
	$ley_gracias="Thank you";
	$ley_cierresesion="your session have been successfully closed";
	$ley_jpg="You can only upload JPG format images.";
	$ley_ajusteimagen="The images will adjust to";
	$ley_proporcion="Use the same proportion.";
	$ley_grabobien="The Content/Message was successfully saved";
	$ley_pruebabien="The test E-Mail was sended successfully";
	$ley_enviomasivo="Masive sended concreted";
	$ley_entradasperiodo="Entries for the Period";
	$ley_filtroaplicado="Search Criteria";
	$ley_contenido="Contents";
	$ley_noimagen="There is no image";
	$ley_nohayarchivo="There is no file";
	
	$campo_usuario="Username";
	$campo_clave="Password";
	$campo_nivel="Level";
	$campo_seleccione="select";
	$campo_quitarseleccion="remove selection";
	$campo_sinseleccion="without selection";
	$campo_publico="Public Item";
	$campo_si="Yes";
	$campo_no="No";
	$campo_campo="Field";
	$campo_contenido="With the Content";
	$campo_modo="Mode";
	$campo_incluido="Included";
	$campo_igualvalor="Equal Data";
	


} elseif($adminstyle=="fr") {

} else {
	// idioma por defecto 
	
	/*************************************************************************/
	/************* ESPAÑOL ***************************************************/
	/*************************************************************************/
	
	$tit_login="Acceso al Backoffice";
	$tit_datospersonales="Modificacion de Datos Personales";
	$alt_inicio="Ir al Inicio del Backoffice";
	$clave="Clave";
	$tit_remover_imagen="Eliminar Imagen";
	$tit_cambiar_imagen="Cambiar Imagen";
	$tit_abrir_archivo="Ver";
	$tit_remover_archivo="Eliminar Archivo";
	$tit_cambiar_archivo="Cambiar Archivo";
	$tit_recuperar_eliminar="Recuperar / Eliminar Definitivo";
	$lk_recuperar="Recuperar";
	$lk_definitivo="Eliminar Definitivo";
	$bt_eliminartodo="Eliminar Definitivo Todo";
	
	$NombreMes[1]="Ene";
	$NombreMes[2]="Feb";
	$NombreMes[3]="Mar";
	$NombreMes[4]="Abr";
	$NombreMes[5]="May";
	$NombreMes[6]="Jun";
	$NombreMes[7]="Jul";
	$NombreMes[8]="Ago";
	$NombreMes[9]="Sep";
	$NombreMes[10]="Oct";
	$NombreMes[11]="Nov";
	$NombreMes[12]="Dic";

	$vecmes[1]="Enero";
	$vecmes[2]="Febrero";
	$vecmes[3]="Marzo";
	$vecmes[4]="Abril";
	$vecmes[5]="Mayo";
	$vecmes[6]="Junio";
	$vecmes[7]="Julio";
	$vecmes[8]="Agosto";
	$vecmes[9]="Septiembre";
	$vecmes[10]="Octubre";
	$vecmes[11]="Noviembre";
	$vecmes[12]="Diciembre";
	
	$lk_modificar="Modificar";
	$lk_eliminar="Eliminar";
	$lk_verparrafos="Ver Parrafos";
	$lk_verformulario="Ver Formulario";
	$lk_cerrar="Cerrar Contenido";
	$lk_abrir="Ver Contenido";
	$lk_nuevodoc="Nuevo Documento";
	$lk_nuevofor="Nuevo Formulario";
	$lk_vermes="Ver Mes Completo";
	$lk_verip="Ver IP";
	$lk_imagen="Click Aqui para Agregar Imagen";
	$lk_verimagen="Click Aqui para Ver la Imagen en Tamano Real";
	$lk_eliminarimagen="Eliminar Imagen";
	$lk_agregararchivo="Click Aqui para Agregar Archivo";
	$lk_agregar="Agregar Nuevo";
	$lk_agre="Agregar";
	
	$error_accesoindebido="Acceso Indebido";
	$error_noestadoc="No esta definido el Documento";
	$error_noestafor="No esta definido el Formulario";
	$error_backoffice="Acceso Indebido al Backoffice";
	$error_usuarionohabilitado="Este Usuario no esta habilitado para utilizar el Backoffice";
	$error_claveinvalida="Contrase&ntilde;a inv&acute;lida";
	$error_usuarioinvalido="Usuario no registrado";		
	$error_nombrevacio="Error: Debe completar el nombre de usuario";
	$error_clavevacio="Error: Debe completar la contrase&ntilde;a";
	$error_sitiovacio="Error: Debe completar el Nombre del Sitio";
	$error_vacio="debe contener un dato";
	$error_mailinvalido="debe contener una direcci&oacute;n de correo v&acute;lida";
	$error_numero="debe contener un número";
	$error_noseenviomail="Error: No se puedo enviar el E-Mail.";
	$error_nohayregistromail="No se encontro el registro de E-Mail para el ID";
	$error_algrabar="Al grabar";
	$error_aleliminar="Al eliminar";
	$error_almodificardatospersonales="Al modificar datos personales";
	$error_almodificar="Al modificar";
	$error_alrecuperar="Al recuperar";
	$error_noesjpg="La Imagen no posee Formato JPG";
	
	$tit_mapadesitio="Mapa del Sitio";
	$tit_resultado="Resultado";
	$tit_filtroaplicado="Filtro Aplicado";
	$tit_item="ID";
	$tit_elitem="El Item";
	$tit_secciones="Secciones";
	$tit_nombre="Nombre/s";
	$tit_documento="Documento";
	$tit_formulario="Formulario";
	$tit_titulo="Título<br>Texto";
	$tit_foto="Foto<br>Apostilla";
	$tit_acciones="Acciones";
	$tit_campo="Campo";
	$tit_modulo="Módulo";
	$tit_agregararchivo="Agregando Archivo a";
	$tit_agregarimagen="Agregando Imagen a";
	$tit_error="Error";
	$tit_agregando="Agregando";
	$tit_modificando="Modificando";
	$tit_datosobligatorios="Datos Obligatorios";
	$tit_eliminaron="Se eliminaron";
	$tit_registros="registros";
	$tit_eliminandoregistros="Eliminando Registros";
	$tit_envioa="envío a";
	$tit_estadisticas="Estadística de Entradas";
	$tit_enviocorreo="Envío de Correo a Suscriptores";
	$tit_entradasgenerales="Entradas Generales";
	$tit_cantidad="Cantidad";
	$tit_periodo="Período";
	$tit_totales="TOTALES";
	$tit_ayudas="Ayuda";
	$tit_fechahora="Fecha/Hora";
	$tit_ip="IP";
	$tit_entradasip="Entradas para la IP";
	$tit_totalperiodo="TOTAL PARA EL PERIODO";
	$tit_modificareliminar="Modificar / Eliminar";
	$tit_buscar="Buscar";
	$tit_regxpag="Reg x Pág";
	$tit_ayudasmapa="Ayudas para el Mapa del Sitio";
	$tit_agregadobien="Ha sido agregado con exito";
	$tit_eliminadobien="Ha sido eliminado con exito";
	$tit_datospersonalesbien="Se modificaron los datos personales con exito";
	$tit_modificadobien="Ha sido modificado con exito";
	$tit_recuperadobien="Ha sido recuperado con exito";
	$tit_itemdesde="Item Desde";
	$tit_itemhasta="Hasta";
	
	$bt_ayudasmapa="(?) Ayudas para Mapa de Sitio";
	$bt_agregarseccion="Agregar Seccion";
	$bt_volver="Volver";
	$bt_agregarparrafo="Agregar Parrafo";
	$bt_agregarcampofor="Agregar Campo al Formulario";
	$bt_cancelar="Cancelar";
	$bt_login="Ingresar";
	$bt_modificar="Modificar";
	$bt_agregararchivo="Agregar Archivo";
	$bt_agregarimagen="Agregar Imagen";
	$bt_agregar="Agregar";
	$bt_eliminarregistros="Eliminar Registros";
	$bt_eliminarxcriterio="Eliminar por Criterio";
	$bt_recuperar="Recuperar Datos";
	
	$ley_gracias="Gracias";
	$ley_cierresesion="su sesión ha sido cerrada con exito";
	$ley_jpg="Se pueden subir imágenes JPG &uacute;nicamente.";
	$ley_ajusteimagen="Las imágenes se ajustarán a";
	$ley_proporcion="Utilice la misma proporción.";
	$ley_grabobien="Se grabó el Contenido/Mensaje con exito";
	$ley_pruebabien="El E-Mail de prueba fue enviado con exito";
	$ley_enviomasivo="Envío masivo concretado";
	$ley_entradasperiodo="Entradas para el Período";
	$ley_filtroaplicado="Filtro Aplicado";
	$ley_contenido="Contenido";
	$ley_noimagen="No hay imagen definida";
	$ley_nohayarchivo="No hay archivo definido";
	
	$campo_usuario="Nombre de Usuario";
	$campo_clave="Contraseña";
	$campo_nivel="Nivel";	
	$campo_seleccione="seleccione";
	$campo_quitarseleccion="quitar selecci&oacute;n";
	$campo_sinseleccion="sin selecci&oacute;n";
	$campo_publico="Item Público";
	$campo_si="Sí";
	$campo_no="No";
	$campo_campo="Campo";
	$campo_contenido="Con el Contenido";
	$campo_modo="Modo";
	$campo_incluido="Incluido";
	$campo_igualvalor="Igual Valor";
	
	
}
?>
