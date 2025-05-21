
<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");
$_SESSION['usuario_id']='';
$_SESSION['email']='';
$_SESSION['nombre']='';
$_SESSION['tipo']='';

session_destroy();


header("Location: index.php");

?>