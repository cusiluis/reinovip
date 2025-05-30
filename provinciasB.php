<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

$idPais=$_POST['idPais'];
$idProvincia=$_POST['idProvincia'];

//$sql="select * from reino01_Provincia where PaisID='$idPais' and Publico=1 ORDER BY Nombre";

$sql="SELECT DISTINCT pr.* FROM reino01_Provincia pr JOIN reino01_Escort e ON e.ProvinciaID = pr.ID AND pr.PaisID = e.PaisID WHERE pr.Publico = 1 AND e.Publico = 1 AND pr.PaisID = '$idPais' ORDER BY pr.Nombre";

$ej=$mysqli->query($sql);
$dat="<option value=''>---o---</option>";
while($arryEJ=mysqli_fetch_array($ej)){
if($idProvincia==$arryEJ["ID"])
{$dat.="<option value='".$arryEJ["ID"]."' selected='selected'>".$arryEJ["Nombre"]."</option>";}
else
{$dat.="<option value='".$arryEJ["ID"]."'>".$arryEJ["Nombre"]."</option>";}
}

die($dat);
?>

