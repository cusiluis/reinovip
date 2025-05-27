<?php
//conexion y apertura de la base de datos de esta aplicacion
//debe llamarse antes a "include/globales.inc.php"
// global $MensajeDeErrorConexion;

$mysqli = new mysqli($HostPrincipal, $UsuarioPrincipal,$ClavePrincipal, $BasePrincipal);
// mysql_query("SET NAMES 'utf8';"); 
// mysql_query("SET CHARACTER SET 'utf8';"); 
// mysql_query("SET SESSION collation_connection = 'utf8_general_ci';");
global $mysqli;

if ($mysqli -> connect_errno) {
die( "Fallo la conexi�n a MySQL: (" . $mysqli -> mysqli_connect_errno() 
. ") " . $mysqli -> mysqli_connect_error());
}
else
//echo "Conexi�n exitosa!";
//$mysqli -> mysqli_close();

// $ErrorConexion=mysql_connect($HostPrincipal,$UsuarioPrincipal,$ClavePrincipal);
// mysql_select_db($BasePrincipal,$ErrorConexion);
// $ErrorConexion=mysql_errno();
// if ($ErrorConexion!=0) {
//      $MensajeDeErrorConexion="Error ".$ErrorConexion.": ".mysql_error();
// } else {
// 	 $MensajeDeErrorConexion="Conexi�n Exitosa";
// }
?>