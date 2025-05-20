<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");

$SQL="SELECT * FROM agencias";

$res=$mysqli->query($SQL);

while($re = mysqli_fetch_array($res))
{
    $result[] = $re;
}
// echo '<pre>';print_r($result);exit;




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
		<table>
			<tr>
				<td class="listado_titulogeneral" colspan="3"> ::Lista Agencias</td>
				
				<td class="listado_titulogeneral" align="right">
					<a href="agregar_agencia.php" name="bt_agregar" class="admin_botones"> Agregar Agencia >></a>
				</td>
				
				
			</tr>
		</table>
		<table>
			<tr>
				<th class="admin_titlista">NOMBRE AGENCIA</th>
				<th class="admin_titlista">DESCRIPCION</th>
				<th class="admin_titlista">TELEFONO 1</th>
				<th class="admin_titlista">TELEFONO 2</th>
				<th class="admin_titlista">DIRECCION</th>
				<th class="admin_titlista">ACCION</th>
			</tr>
			<?php foreach($result as $res):?>
			<tr>
				<td class="listado_datos"><?php echo $res['nombre_agencia']?></td>
				<td class="listado_datos"><?php echo $res['descripcion']?></td>
				<td class="listado_datos"><?php echo $res['telefono_1']?></td>
				<td class="listado_datos"><?php echo $res['telefono_2']?></td>
				<td class="listado_datos"><?php echo $res['direccion']?></td>
				<td class="listado_datos">
					<a href="eliminar">ELIMINAR</a><br/>
					<a href="editar">EDITAR</a><br/>
				</td>
			</tr>
			<?php endforeach;?>
		</table>
		<table border="0" cellpadding="3" cellspacing="0">
			<tr>
				
				<form action="admin.php" name="formVolver" method="post">
					<td valign="top" align="left">
						<input type="submit" name="volver" class="admin_botones" value="<< <?php echo utf8($bt_volver) ?>">
					</td>
				</form>
				
				
			</tr>
		</table>
	</body>
</html>