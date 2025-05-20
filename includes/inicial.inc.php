<?php
include("includes/globales.inc.php");
include("includes/conexion.inc.php");

session_start();
$fechadehoy=date('Y').date('m').date('d');
$tablaN=$Prefijo."TmpNavegante";
$tablaPC=$Prefijo."TmpProductoCarrito";
// Funciones para el Carrito - Actualizacion de Tmp
/*
// Primera Parte: Mantenimiento, elimina datos de usuarios de antes de ayer
$FechaVieja=$fechadehoy-2;
$SQL="SELECT * FROM $tablaN WHERE Fechadeingreso < $FechaVieja";
$Resultado=mysql_query($SQL);
while ($RegN=mysql_fetch_array($Resultado)) {
	$navegante=$RegN['ID'];
	$SQL="DELETE FROM $tablaPC WHERE NaveganteID=$navegante";
	$ResultadoBorrar=mysql_query($SQL);
	$SQL="DELETE FROM $tablaN WHERE ID=$navegante";
	$ResultadoBorrar=mysql_query($SQL);
}
*/

// Segunda Parte: Administra el ID del Navegante
// Verifico si tengo UID en SESSION y si esta dentro de la base de datos
if ($_SESSION['UID']!="") {
	// echo "ID del Navegante ya existe en $_SESSION";
	// Busca en la base de datos el Identificador del Navegante
	$Iden=$_SESSION['UID'];
	$SQL="SELECT * FROM $tablaN WHERE Nombre='$Iden' ";
	$Resultado=mysql_query($SQL);	
	$CantReg=mysql_num_rows($Resultado); 
	if ($CantReg=="0") { // no hay registros con ese nombre de navegante, lo creo y asigno
		$dt=date('YmdHis'); 
		$Iden="$dt - $REMOTE_ADDR";
		$Fecha=$fechadehoy;
		$SQL="INSERT INTO $tablaN (Publico,Nombre,Fechadeingreso,Idioma,Moneda) VALUES (0,'$Iden','$Fecha','$idioma','')";
		$ResultadoAgregar=mysql_query($SQL);
		//session_unregister('UID');
		//$UID=$Iden;
		//session_register('UID');		
		$_SESSION['UID']=$Iden;
	}
} else {
	$dt=date('YmdHis');
	$Iden="$dt - $REMOTE_ADDR";
	$Fecha=$fechadehoy;
	$SQL="INSERT INTO $tablaN (Publico,Nombre,Fechadeingreso,Idioma,Moneda) VALUES (0,'$Iden','$Fecha','$idioma','')";
	$ResultadoAgregar=mysql_query($SQL);
	//$UID=$Iden;
	session_register('UID');
	$_SESSION['UID']=$Iden;
}
?>