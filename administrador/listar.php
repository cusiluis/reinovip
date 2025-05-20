<?php
include("../includes/globales.inc.php");
include("../includes/conexion.inc.php");
include("../includes/libreria.inc.php");
include("admin.traducciones.php");

$CualTabla=$_GET["tabla"];


if($CualTabla=='PieProvincias'):?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>BackOffice :: <?php echo utf8($NombreSitio) ?></title>
<?php
if ($admin_en_utf8==true) { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php
} else { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<?php
} 
?>
<?php include("metatags.txt"); ?>
<link href="admin.css" rel="stylesheet" type="text/css">
<link href="../css/dropzone.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../js/dropzone.js" type="text/javascript"></script>
</head>

<body>
<?php
include("topadmin.inc.php"); 
?>
<table border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td class="listado_titulogeneral" colspan="3">LISTADO DE DATOS EN PIE DE PAGINA POR PROVINCIA ::
	<td class="listado_titulogeneral" align="right">
	<input name="tabla" type="hidden" value="<?php echo $CualTabla ?>">
	<input name="filtro" type="hidden" value="<?php echo $FiltroAplicado ?>">	
	<input name="front" type="hidden" value="<?php echo $TomoFront ?>">
	<input name="bt_agregar" type="submit" class="admin_botones" value="<?php echo $bt_agregar ?> >>">
	</td>
	</form>
  </tr>
  <tr>
    <td colspan="4" id="barra_de_filtros" style="padding:0px;">
	</td>
  </tr>
  <tr> 
    <td width="5%" class="admin_titlista">Provincia</td>
	<td width="5%" class="admin_titlista">Acciones</td>
    
  </tr>
   
	  	<?php
				$SQLprov="SELECT DISTINCT p.id, c.provincia_id, p.nombre FROM reino01_pie as c, reino01_Provincia as p 
				 where c.provincia_id = p.id and p.Publico ='1' and p.PaisID='1' ORDER BY c.provincia_id";
				$Resultprov=$mysqli->query($SQLprov);
				while ($data=mysqli_fetch_array($Resultprov)):?>
				 <tr>
      
	  	<td class="celdainput">			
					
					<?php echo $data['nombre']?>
				
		</td>		
		<td align="left" class="celdainput">
	  	 <a href="editarpies.php?id=<?php echo $data['id']?>" class="admin_linkaccion">Modificar</a>
	  	<a href="eliminarpies.php?id=<?php echo $data['id']?>" class="admin_linkaccion">Eliminar</a> 
	  </td>
				<?php endwhile;
		?>
	  
	  

	  
</table>

<table border="0" cellpadding="3" cellspacing="0">
  <tr>
	
	<form action="admin.php" name="formVolver" method="post"> 		  
    <td valign="top" align="left">
	<input type="submit" name="volver" class="admin_botones" value="<< <?php echo utf8($bt_volver) ?>">
	</td>
	<td valign="top" align="right">
	<a href="listar.php?tabla=insertarpie" class="admin_botones">AGREGAR >></a>
	</td>
	</form>
	
   
  </tr>
</table>			

</body>
</html>
<?php endif;?>
<?
if($CualTabla=='BannerCiudades'):?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>BackOffice :: <?php echo utf8($NombreSitio) ?></title>
<?php
if ($admin_en_utf8==true) { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php
} else { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<?php
} 
?>
<?php include("metatags.txt"); ?>
<link href="admin.css" rel="stylesheet" type="text/css">
<link href="../css/dropzone.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../js/dropzone.js" type="text/javascript"></script>
</head>

<body>
<?php
include("topadmin.inc.php"); 
?>
<table border="0" cellpadding="3" cellspacing="0">
  <tr>
    <td class="listado_titulogeneral" colspan="3">LISTADO DE BANNERS POR PROVINCIA ::
	<td class="listado_titulogeneral" align="right">
	<input name="tabla" type="hidden" value="<?php echo $CualTabla ?>">
	<input name="filtro" type="hidden" value="<?php echo $FiltroAplicado ?>">	
	<input name="front" type="hidden" value="<?php echo $TomoFront ?>">
	<input name="bt_agregar" type="submit" class="admin_botones" value="<?php echo $bt_agregar ?> >>">
	</td>
	</form>
  </tr>
  <tr>
    <td colspan="4" id="barra_de_filtros" style="padding:0px;">
	</td>
  </tr>
  <tr> 
    <td width="5%" class="admin_titlista">Provincia</td>
	<td width="5%" class="admin_titlista">Acciones</td>
    
  </tr>
   
	  	<?php
				$SQLprov="SELECT DISTINCT p.id, c.provincia_id, p.nombre FROM reino01_banner_ciudades as c, reino01_Provincia as p  where c.provincia_id = p.id and p.Publico ='1' and p.PaisID='1' ORDER BY c.provincia_id";
				$Resultprov=$mysqli->query($SQLprov);
				while ($data=mysqli_fetch_array($Resultprov)):?>
				 <tr>
      
	  	<td class="celdainput">			
					
					<?php echo $data['nombre']?>
				
		</td>		
		<td align="left" class="celdainput">
	  	<a href="editarbanners.php?id=<?php echo $data['id']?>" class="admin_linkaccion">Modificar</a>
	  	<a href="eliminarbanners.php?id=<?php //echo $data['id']?>" onclick="return confirm('Esta seguro eliminarlo?');" class="admin_linkaccion">Eliminar</a>
	  </td>
				<?php endwhile;
		?>
	  
	  

	  
</table>

<table border="0" cellpadding="3" cellspacing="0">
  <tr>
	
	<form action="admin.php" name="formVolver" method="post"> 		  
    <td valign="top" align="left">
	<input type="submit" name="volver" class="admin_botones" value="<< <?php echo utf8($bt_volver) ?>">
	</td>
	<td valign="top" align="right">
	<a href="listar.php?tabla=insertarbanner" class="admin_botones">AGREGAR >></a>
	</td>
	</form>
	
   
  </tr>
</table>			

</body>
</html>
<?php endif;?>
<?php if($CualTabla=='insertarbanner'):?>

<?php

$nombreusuario=$_SESSION['usuariolog'];
// valido el usuario en la tabla de logueos
$tablaL=$Prefijo."logueo";
$SQL="SELECT * FROM $tablaL WHERE Nombre='$nombreusuario' ";
$ResultL=$mysqli->query($SQL);
$cantreg=mysqli_num_rows($ResultL);
if ($cantreg < 1) {$nombreusuario="";}
else
{$arryLog=mysqli_fetch_array($ResultL);}

if ($nombreusuario=="") {
	header("Location: admin.php?mensaje=".$error_accesoindebido.".");
	exit;
}

$volver=$_GET['backto'];

// no es necesario poner a la variable como "global" cuando se utiliza 
// directamente en el body (y no en una funcion)
// global $LongitudMaximaDeCampoEnPantalla;
$TomoFront=$_GET["front"];
if ($TomoFront=="") $TomoFront=$_POST["front"];
$CualTabla=$_GET["tabla"];
if (($CualTabla=="") or ($Prefijo=="")) {
    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": AltaRegistro.");
    exit;
}
$Mensaje=$_GET["mensaje"];

$filtro=$_GET['filtro'];
if ($filtro=="") $filtro=$_POST['filtro'];
if ($filtro!="") {
	$CampoFiltro=TextoAntesDe(">",$filtro);
	$ValorFiltro=TextoDespuesDe(">",$filtro);
} else {
	$CampoFiltro="";
}

//BUSQUEDA DE CANTIDAD DE ESCORTS REGISTRADOS
$idUs=$arryLog['ID'];
$nivelUs=$arryLog['Nivel'];
if($arryLog['Cmax']!=0){
	$tablaEsVer=$Prefijo."Escort";
	$SQLeVer="SELECT * FROM $tablaEsVer WHERE IDusuario='$idUs' AND ((Publico=1) OR (Publico=0)) ";
	$ResultEVer=$mysqli->query($SQLeVer);
	$cantEVer=mysqli_num_rows($ResultEVer);
	if ($cantEVer >= $arryLog['Cmax'])
	{	header("Location: listarTabla.php?tabla=".$CualTabla."&mensaje=Usted solo puede registrar ".$arryLog['Cmax']." anuncios, ya se ha excedido esta capacidad.");
		exit;
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>BackOffice :: <?php echo utf8($NombreSitio)?></title>
<?php
if ($admin_en_utf8) { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php 
} else { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<?php
} 
?>
<?php include("metatags.txt"); ?>
<link href="admin.css" rel="stylesheet" type="text/css">
<link href="../css/dropzone.css" rel="stylesheet" type="text/css" />
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../js/dropzone.js" type="text/javascript"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>


</head>

<body>
<?php include("topadmin.inc.php"); ?>
  <form enctype="multipart/form-data"
	    action="registrarbanner.php" 
	    method="post">
<?php if(isset($_GET['error'])):?>
	<h3>ERROR LA PROVINCIA YA TIENE BANNER SELECCIONADOS, POR FAVOR ESCOJA OTRA PROVINCIA</h3>
<?php endif?>
<table border="0" cellpadding="3" cellspacing="0" class="admin_form_derecha">
  	<tr>
    	<td class="listado_titulogeneral" colspan="2">REGISTRO DE BANNER POR CIUDAD</td>
	</tr>        
	<tr>
    		<td width="25%" class="celdatitulo">
			Provincias - ciudades
			</td>
		    <td width="75%" class="celdainput">
		    	<select name='provincia' id="provincia">
			    <?php
				$SQLprov="SELECT * FROM reino01_Provincia WHERE Publico=1 ORDER BY Nombre";
				$Resultprov=$mysqli->query($SQLprov) or die (mysql_error());
				?>
				 <option value="0"> - Seleccione la provincia - </option>
				 <?php
				while ($arryProv=mysqli_fetch_array($Resultprov)):?>
					 
					  <option value="<?php echo $arryProv['ID'] ?>"><?php echo $arryProv['Nombre']?></option>
				<?php endwhile;?>
				</select>
			</td>
	</tr>
	<tr>
		<td><label for="fotos">FOTOGRAFIAS</label></td>
		<td align="center">
			 
					
	          		<div class="dropzone" id="my-dropzone" name="mainFileUploader">
          				<div class="fallback">
                			<input name="file" type="file" multiple />
			            </div>
        			</div>
				    
				  
                
       

		</td>	
		<td></td>
	</tr>
	
	<tr>
		<td class="celdabotones" colspan="2">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr>
			<td width="50%" valign="top" align="left">
				<a class="admin_botones" href="listarTabla.php?tabla=Banner"> << Volver</a>
			</td>
			<td width="50%" valign="top" align="right">
				<input class="admin_botones" id="submit-all" type="submit" value="Agregar >>" name="agregar">
			</td>
			</tr>
			</table>	
		</td>
	</tr>
</table>

  </form>
</body>
<script type="text/javascript">
        $(document).ready(function(){
            Dropzone.autoDiscover = false;

            $("#my-dropzone").dropzone({
                url: "registrarbanner.php",
        		addRemoveLinks: true,
        		autoProcessQueue: false,
        		uploadMultiple: true,
        		parallelUploads: 10,
        		maxFiles: 10,
        		dictDefaultMessage: "Por favor arrastre sus imagenes aca o haga click para buscar",


        		// The setting up of the dropzone
			    init: function() {
			        var myDropzone = this;
			        

			        // Here's the change from enyo's tutorial...
			         this.on("sending", function(file, xhr, formData) {
					 	var provincia = $('#provincia').val();
					 	formData.append('provincia', provincia);    
					 	

					 	

					 	
					 	
						
						
					 	
	
					  });
			        $("#submit-all").click(function (e) {
			            e.preventDefault();
			            e.stopPropagation();
			            myDropzone.processQueue();

			        });
			        this.on("sendingmultiple", function() {
				      // Gets triggered when the form is actually being sent.
				      // Hide the success button or the complete form.
				    });
				    this.on("successmultiple", function(files, response) {
				      // Gets triggered when the files have successfully been sent.
				      // Redirect user or notify of success.
				      window.location.href = "listar.php?tabla=BannerCiudades";
				    });
				    this.on("errormultiple", function(files, response) {
				      // Gets triggered when there was an error sending the files.
				      // Maybe show form again, and notify user of error
				    });
			    },
		        success: function (file, response) {
            	var imgName = response;

            	file.previewElement.classList.add("dz-success");
            	console.log("Successfully uploaded :" + imgName);
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
            });

        });
    </script>
</html>


<?php endif;?>

<?php if($CualTabla=='insertarpie'):?>

<?php

$nombreusuario=$_SESSION['usuariolog'];
// valido el usuario en la tabla de logueos
$tablaL=$Prefijo."logueo";
$SQL="SELECT * FROM $tablaL WHERE Nombre='$nombreusuario' ";
$ResultL=$mysqli->query($SQL);
$cantreg=mysqli_num_rows($ResultL);
if ($cantreg < 1) {$nombreusuario="";}
else
{$arryLog=mysqli_fetch_array($ResultL);}

if ($nombreusuario=="") {
	header("Location: admin.php?mensaje=".$error_accesoindebido.".");
	exit;
}

$volver=$_GET['backto'];

// no es necesario poner a la variable como "global" cuando se utiliza 
// directamente en el body (y no en una funcion)
// global $LongitudMaximaDeCampoEnPantalla;
$TomoFront=$_GET["front"];
if ($TomoFront=="") $TomoFront=$_POST["front"];
$CualTabla=$_GET["tabla"];
if (($CualTabla=="") or ($Prefijo=="")) {
    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": AltaRegistro.");
    exit;
}
$Mensaje=$_GET["mensaje"];

$filtro=$_GET['filtro'];
if ($filtro=="") $filtro=$_POST['filtro'];
if ($filtro!="") {
	$CampoFiltro=TextoAntesDe(">",$filtro);
	$ValorFiltro=TextoDespuesDe(">",$filtro);
} else {
	$CampoFiltro="";
}

//BUSQUEDA DE CANTIDAD DE ESCORTS REGISTRADOS
$idUs=$arryLog['ID'];
$nivelUs=$arryLog['Nivel'];
if($arryLog['Cmax']!=0){
	$tablaEsVer=$Prefijo."Escort";
	$SQLeVer="SELECT * FROM $tablaEsVer WHERE IDusuario='$idUs' AND ((Publico=1) OR (Publico=0)) ";
	$ResultEVer=$mysqli->query($SQLeVer);
	$cantEVer=mysqli_num_rows($ResultEVer);
	if ($cantEVer >= $arryLog['Cmax'])
	{	header("Location: listarTabla.php?tabla=".$CualTabla."&mensaje=Usted solo puede registrar ".$arryLog['Cmax']." anuncios, ya se ha excedido esta capacidad.");
		exit;
	}
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>BackOffice :: <?php echo utf8($NombreSitio)?></title>
<?php
if ($admin_en_utf8) { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php 
} else { 
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<?php
} 
?>
<?php include("metatags.txt"); ?>
<link href="admin.css" rel="stylesheet" type="text/css">
<link href="../css/dropzone.css" rel="stylesheet" type="text/css" />
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
<script src="../js/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../js/dropzone.js" type="text/javascript"></script>
<script language="javascript" src="calendar/calendar.js"></script>
<link href="calendar/calendar.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>


</head>

<body>
<?php include("topadmin.inc.php"); ?>
  <form enctype="multipart/form-data"
	    action="registrarpie.php" 
	    method="post">
	    <?php if(isset($_GET['error'])):?>
	<h3>ERROR LA PROVINCIA YA TIENE DATOS EN PIE DE PAGINA, POR FAVOR ESCOJA OTRA PROVINCIA</h3>
<?php endif?>
<table border="0" cellpadding="3" cellspacing="0" class="admin_form_derecha">
  	<tr>
    	<td class="listado_titulogeneral" colspan="2">REGISTRO DE DATOS EN PIE DE PAGINA POR CIUDAD</td>
	</tr>        
	<tr>
    		<td width="25%" class="celdatitulo">
			Provincias - ciudades
			</td>
		    <td width="75%" class="celdainput">
		    	<select name='provincia' id="provincia">
			    <?php
				$SQLprov="SELECT * FROM reino01_Provincia WHERE Publico=1 ORDER BY Nombre";
				$Resultprov=$mysqli->query($SQLprov);
				?>
				 <option value="0"> - Seleccione la provincia - </option>
				 <?php
				while ($arryProv=mysqli_fetch_array($Resultprov)):?>
					 
					  <option value="<?php echo $arryProv['ID'] ?>"><?php echo $arryProv['Nombre']?></option>
				<?php endwhile;?>
				</select>
			</td>
	</tr>
	
	
	
	<tr>
		
		<td width="25%" class="celdatitulo">
			datos (coloque colocando por una coma)
			</td>
			<td>
				<input type="text" name="datospie" size="30">
			</td>
	</tr>

	<tr><td width="50%" valign="top" align="right">
				<input class="admin_botones" id="submit-all" type="submit" value="Agregar >>" name="agregar">
			</td></tr>
</table>

  </form>
</body>
</html>


<?php endif;?>