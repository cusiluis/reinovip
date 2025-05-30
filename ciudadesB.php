<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

if(isset($_POST['idProv'])){
    $idProv=$_POST['idProv'];
}
if(isset($_POST['idProvincia'])){
    $idProv=$_POST['idProvincia'];
}
$idCiudad=$_POST['idCiudad'];

$sql="SELECT DISTINCT c.* FROM reino01_Ciudad c INNER JOIN reino01_Escort e ON e.CiudadID = c.ID WHERE c.ProvinciaID ='$idProv' AND c.Publico = 1 AND e.Publico = 1 ORDER BY c.Nombre";
// echo $sql;exit;
$ej=$mysqli->query($sql);
$dat="<option value=''>---o---</option>";
while($arryEJ=mysqli_fetch_array($ej)){
if($idCiudad==$arryEJ["ID"])
{$dat.="<option value='".$arryEJ["ID"]."' selected='selected'>".$arryEJ["Nombre"]."</option>";}
else
{$dat.="<option value='".$arryEJ["ID"]."'>".$arryEJ["Nombre"]."</option>";}
}

die($dat);
?>

