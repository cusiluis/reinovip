<?php
require("../includes/globales.inc.php");
require("../includes/conexion.inc.php");
require("../includes/libreria.inc.php");
include("admin.traducciones.php");


//echo '<pre>';print_r($_POST);exit;
function ResizeImage ($im,$maxwidth,$maxheight,$path,$name) {
	$width=imagesx($im);
	$height=imagesy($im);
	if (($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight)) {
		if($maxwidth && $width > $maxwidth) {
			$widthratio = $maxwidth/$width;
			$RESIZEWIDTH=true;
		}
		if($maxheight && $height > $maxheight) {
			$heightratio = $maxheight/$height;
			$RESIZEHEIGHT=true;
		}
		if($RESIZEWIDTH && $RESIZEHEIGHT) {
			if($widthratio < $heightratio) {
				$ratio=$widthratio;
			} else {
				$ratio=$heightratio;
			}
		} elseif ($RESIZEWIDTH) {
			$ratio=$widthratio;
		} elseif ($RESIZEHEIGHT) {
			$ratio=$heightratio;
		}
    	$newwidth=$width*$ratio;
        $newheight=$height*$ratio;
		if (function_exists("imagecopyresampled")) {
      		$newim=imagecreatetruecolor($newwidth,$newheight);
      		imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$width,$height);
		} else {
			$newim=imagecreate($newwidth,$newheight);
      		imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$width,$height);			
		}
		imageJpeg($newim,"temp/".$name.".jpg");
		$error_copia=copiarftp("temp/".$name.".jpg",$path,$name.".jpg");
		//debbug ::
		//echo "copiando: ".$path."/".$name.".jpg<br>";
		//echo "error copia: ".$error_copia."<br>";
		//
		unlink("temp/".$name.".jpg");
		ImageDestroy($newim);
	} else {
		ImageJpeg($im,"temp/".$name.".jpg");
    	copiarftp("temp/".$name.".jpg",$path,$name.".jpg");
		//debbug ::
		//echo "copiando: ".$path."/".$name.".jpg<br>";
		//echo "error copia: ".$error_copia."<br>";
		//
	    unlink("temp/".$name.".jpg");
	}
}  // fin function ResizeImage()

if(isset($_POST['vip']) and $_POST['vip']!='')
{
	if($_POST['vip']=='on'){
		$idvip=$_GET["id"];
		$SQL="UPDATE reino01_Escort SET vip='SI' WHERE ID='$id' ";
		$mysqli->query($SQL);
	}
	
}
else{
		$idvip=$_GET["id"];
		$SQL="UPDATE reino01_Escort SET vip=''  WHERE ID='$id' ";
		$mysqli->query($SQL);
	}
if(isset($_POST['agencia_id']) and $_POST['agencia_id']!='')
{
		$agenciaId = $_POST['agencia_id'];
		$idvip=$_GET["id"];
		$SQL="UPDATE reino01_Escort SET agencia_id='$agenciaId' WHERE ID='$id' ";
		$mysqli->query($SQL);
	
	
}
else{
		$idvip=$_GET["id"];
		$SQL="UPDATE reino01_Escort SET agencia_id= NULL  WHERE ID='$id' ";
		$mysqli->query($SQL);
	}


$err="";
$CualTabla=$_GET["tabla"];
if (!$CualTabla) {
    header("Location: index.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": scriptModRegistro.");
    exit;
}
$Item=$_GET["id"];

$NombreTabla=$Prefijo.$CualTabla;
$tablaE=$Prefijo."estructura";
if ($TomoFront=="si") {
	$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenfront='0' ORDER BY Nrodeordenfront ASC";
} else {
	$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenback='0' ORDER BY Nrodeordenback ASC";
}
$ResultadoEstructura=$mysqli->query($SQL);
$ii=1;
$cualnombreitem="";
while ($RegistroEstructura=mysqli_fetch_array($ResultadoEstructura)) {
    $TipoDeEntrada=$RegistroEstructura['Tipodeentrada'];
	$NombreCampo=$RegistroEstructura['Nombrecampo'];
	$Directorio=$RegistroEstructura['Directorio'];
	$valor="Campo".$ii;
	
	if (($CualTabla=="logueo") && ($NombreCampo=="Nivel")) {
	$nivelPorPer=$_POST[$valor];
	}
	
	$Contenido=$_POST[$valor];
	if ($NombreCampo=="Nombre") $cualnombreitem=$Contenido;	
	// debugging 
	// echo $ii." :: ".$TipoDeEntrada."-".$NombreCampo." :: ".$Contenido."<br>";
	//
	if (($TipoDeEntrada=="IMAGEN") or ($TipoDeEntrada=="JPG") or ($TipoDeEntrada=="ARCHIVO")) {
		$TamanioArchivo=$_FILES[$valor]['size'];
		$TemporalArchivo=$_FILES[$valor]['tmp_name'];
		$NombreArchivo=$_FILES[$valor]['name'];
	}
	//
	$actualizar=false;
    if (($TipoDeEntrada=="INPUT") or ($TipoDeEntrada=="CALENDARIO") or ($TipoDeEntrada=="MEMO") or ($TipoDeEntrada=="HTML")) {
	    $Contenido=addslashes($Contenido);
		$actualizar=true;
	}
	if (($TipoDeEntrada=="RADIO") or ($TipoDeEntrada=="TABLA") or ($TipoDeEntrada=="COMBO")) {
		$actualizar=true;
	}
	if ($TipoDeEntrada=="CHECK") {
	    if ($Contenido=="checkbox") $Contenido="1";
		$actualizar=true;
    } 
	if ($TipoDeEntrada=="FECHA") {
		$valor="Campo".$ii."_anio";
		$Anio=$_POST[$valor];
		$valor="Campo".$ii."_mes";
		$Mes=$_POST[$valor];
		$valor="Campo".$ii."_dia";
		$Dia=$_POST[$valor];
		$Contenido=$Anio."-".$Mes."-".$Dia;
		$actualizar=true;
	}
	if ($TipoDeEntrada=="ANIDADO") {
		$valor="Campo".$ii."_cantitems";
		$cantkk=$_POST[$valor];
		$kk=0;
		$Anidado="";
		$PusoAlgo=false;
		while ($kk < $cantkk) {
			$kk++;
			$valor="Campo".$ii."_".$kk;
			$seleccion=$_POST[$valor];
			if ($seleccion!="") {
				if ($PusoAlgo==false) {
					$Anidado=" |";
					$PusoAlgo=true;
				}
				$Anidado.=$seleccion."|";
			}
		}
		//debbug :: echo "Anidado: ".$Anidado."<br>";
		//
		$Contenido=$Anidado;
		$actualizar=true;
	}

	//--------------- NUEVO ------------------------------------------------------------------
	if (($TipoDeEntrada=="IMAGEN") or ($TipoDeEntrada=="JPG")) {
		//debugg ::	echo $NombreCampo."(name): -".$NombreArchivo."-<br>";
		//debugg ::	echo $NombreCampo."(tmp_name): -".$TemporalArchivo."-<br>";
		$que_hacer=$valor."_eliminar";
		if ($_POST[$que_hacer]=="si") {
			$nombre_anterior=$NombreCampo."_falso";
			$ArchivoAnterior=$_POST[$nombre_anterior];
			if ($Directorio!="") {
				$ArchivoABorrar="../".$Directorio."/".$ArchivoAnterior;
			} else {
				$ArchivoABorrar="../".$ArchivoAnterior;
			}
			
			$Contenido="";
			$actualizar=true;
		}
		$que_hacer=$valor."_cambiar";
		if (($_POST[$que_hacer]=="si") or ($NombreArchivo!="")) {
			$nombreimagen=strtoupper($NombreArchivo);
			if (!strpos($nombreimagen,'.JPG')) {
				$err.=$error_noesjpg;
			}
			if ($TamanioArchivo) {
				$PrefijoFoto=$RegistroEstructura['Prefijoimagen'];
				//armo la miniatura
				//debbug ::	echo "entre a fabricar la imagen chica<br>";
				$Ancho=$RegistroEstructura['Imagenanchominiatura'];
				$Alto=$RegistroEstructura['Imagenaltominiatura'];
				$FILENAME=$PrefijoFoto.$Item."c";
			    $RESIZEWIDTH=$Ancho;
				$RESIZEHEIGHT=$Alto;
				if ($TamanioArchivo) {
    				$imagen=imagecreatefromjpeg($TemporalArchivo);
				}
				if ($imagen) {
					//borro si existe
					if ($Directorio!="") {
						$ArchivoABorrar="../".$Directorio."/".$FILENAME.".jpg";
					} else {
						$ArchivoABorrar="../".$FILENAME.".jpg";
					}
					//debbug ::	echo "archivo a generarse: ".$ArchivoABorrar."<br>";
					
				    ResizeImage($imagen,$RESIZEWIDTH,$RESIZEHEIGHT,$Directorio,$FILENAME);
    				ImageDestroy($imagen);
				}
				//armo la imagen grande
				$Ancho=$RegistroEstructura['Imagenanchofoto'];
				$Alto=$RegistroEstructura['Imagenaltofoto'];
				$FILENAME=$PrefijoFoto.$Item."g";
				if (($Ancho==0) or ($Alto==0)) {
					//paso la imagen tal cual, sin redimensionarla 
					if ($Directorio!="") {
						$ArchivoABorrar="../".$Directorio."/".$FILENAME.".jpg";
					} else {
						$ArchivoABorrar="../".$FILENAME.".jpg";
					}
					
				    $error=copiarftp($campoimagen,$Directorio,$FILENAME.".jpg");
					if ($error!="1") $err.=$error;
				} else {
					//hago resize (redimension) de la imagen 
					//debugg ::	echo "entre a fabricar la imagen grande<br>";
			    	$RESIZEWIDTH=$Ancho;
					$RESIZEHEIGHT=$Alto;
					if ($TamanioArchivo) {
    					$imagen=imagecreatefromjpeg($TemporalArchivo);
					}
					if ($imagen) {
						//borro si existe
						if ($Directorio!="") {
							$ArchivoABorrar=$Directorio."/".$FILENAME.".jpg";
							$dondecrear=$Directorio;
						} else {
							$ArchivoABorrar=$FILENAME.".jpg";
							$dondecrear="";
						}
						
				    	ResizeImage($imagen,$RESIZEWIDTH,$RESIZEHEIGHT,$Directorio,$FILENAME);
			    		ImageDestroy($imagen);
					}
				}
				$Contenido=$NombreArchivo;
				$actualizar=true;
				$err='';
			}
		}		
		
		
	}
	if ($TipoDeEntrada=="ARCHIVO") {
		//debugg ::
		//echo $NombreCampo."(name)-".$NombreArchivo."<br>";
		//echo $NombreCampo."(tmp_name)-".$TemporalArchivo."<br>";
		//
		$que_hacer=$valor."_eliminar";
		if ($_POST[$que_hacer]=="si") {
			$nombre_anterior=$NombreCampo."_falso";
			$ArchivoAnterior=$_POST[$nombre_anterior];
			if ($Directorio!="") {
				$ArchivoABorrar="../".$Directorio."/".$ArchivoAnterior;
			} else {
				$ArchivoABorrar="../".$ArchivoAnterior;
			}
			if (file_exists($ArchivoABorrar)) $err=borrarftp($Directorio,$ArchivoAnterior);
			$Contenido="";
			$actualizar=true;
		}
		$que_hacer=$valor."_cambiar";
		if (($_POST[$que_hacer]=="si") or ($NombreArchivo!="")) {
			if ($NombreArchivo!="") {
				if ($Directorio!="") {
					$ArchivoABorrar="../".$Directorio."/".$NombreArchivo;
				} else {
					$ArchivoABorrar="../".$NombreArchivo;
				}
				if (file_exists($ArchivoABorrar)) $error_borrar=borrarftp($Directorio,$NombreArchivo);
				$error_copia=copiarftp($TemporalArchivo,$Directorio,$NombreArchivo);
				if ($error_copia!=1) $err.=$error_copia;
				//debbug ::
				//echo "copiando: ".$Directorio."/".$NombreArchivo."<br>";
				//echo "error copia: ".$error_copia."<br>";
				//
				$Contenido=$NombreArchivo;
				$actualizar=true;
			}
		}

	}
	if ($TipoDeEntrada=="TRADUCCION") {
	    $Contenido=addslashes($Contenido);
		$actualizar=true;
		$tablaI=$Prefijo."Idioma";
		$SQL="SELECT * FROM $tablaI WHERE (Publico='1') ORDER BY Nrodeorden ASC";
		$ResultI=$mysqli->query($SQL);
		while ($RegI=mysqli_fetch_array($ResultI)) {
			$id_idioma=$RegI['ID'];
			$trad=$valor."_traduccion_".$id_idioma;
			$cont_trad=addslashes($_POST[$trad]);
			$tablaT=$Prefijo."Traduccion";
			$SQL="SELECT * FROM $tablaT WHERE (Publico='1') AND (Tabla='$CualTabla') AND (TablaID='$Item') AND (Campo='$NombreCampo') AND (IdiomaID='$id_idioma')";
			$ResultT=$mysqli->query($SQL);
			$error=mysqli_error();
			//debbug ::
			//echo "sql: ".$SQL."<br>";
			//echo "error: ".$error."<br>";
			//
			if ($RegT=mysqli_fetch_array($ResultT)) {
				//existe
				$id_a_cambiar=$RegT['ID'];
				$SQL="UPDATE $tablaT SET Nombre='$cont_trad' WHERE ID='$id_a_cambiar' ";
				$update=$mysqli->query($SQL);
				$err.=mysqli_error();
				//debbug ::
				//echo "sql: ".$SQL."<br>";
				//echo "error: ".$err."<br>";
				//
			} else {
				//no existe
				$SQL="INSERT INTO $tablaT (Publico,Tabla,TablaID,Campo,IdiomaID,Nombre) VALUES ('1','$CualTabla','$Item','$NombreCampo','$id_idioma','$cont_trad') ";
				$agregar=$mysqli->query($SQL);
				$err.=mysqli_error();
				//debbug ::
				//echo "sql: ".$SQL."<br>";
				//echo "error: ".$err."<br>";
				//
			}
		}
		
	}
	//-----------------------------------------------------------------------------------------
	if ($actualizar==true) {
		if ($CualTabla=="Escort") {
			if($NombreCampo=="Telefono")
			{
				$Contenido=str_replace(" ","",$Contenido);
				$Contenido=str_replace("<br>","",$Contenido);
				$Contenido=str_replace("\n","",$Contenido);				
			}
			else
			{
				if($NombreCampo=="Comentario" && $Contenido!="")
				{
					$Contenido=strtolower($Contenido);
					$ContenidoTEMP = explode(">",$Contenido,2);
					$ContenidoUPF=ucfirst($ContenidoTEMP[1]);
					
					$Contenido=$ContenidoTEMP[0].">".$ContenidoUPF;
				}
			}
		}

		$SQL="UPDATE $NombreTabla SET $NombreCampo='$Contenido' WHERE ID='$Item'";
		$modificar_contenido=$mysqli->query($SQL);
		$err.=mysqli_error();

		//debbug ::
		//echo "sql: ".$SQL."<br>";
		//echo "error: ".$err."<br>";
		//
		
	}
	$ii++;
} // del while

	if ($CualTabla=="Banner") {
				$SQLElimBanProv="DELETE FROM reino01_banner_provincia WHERE IDBanner='$Item'";
				$mysqli->query($SQLElimBanProv);
				$SQLElimBanCiu="DELETE FROM reino01_banner_ciudad WHERE IDBanner='$Item'";
				$mysqli->query($SQLElimBanCiu);
				
				$SQLprov="SELECT * FROM reino01_Provincia WHERE Publico=1 ORDER BY Nombre";
				$Resultprov=$mysqli->query($SQLprov) or die (mysqli_error());
				while ($arryProv=mysqli_fetch_array($Resultprov)) {
					  $idProvincia=$arryProv['ID'];
					  $resProvincia=$_POST['prov'.$idProvincia];
					  
					  if($resProvincia)
					  {
					  	$SQLInsBP="INSERT INTO reino01_banner_provincia (IDBanner,IDProvincia) VALUES ('$Item','$idProvincia') ";
						$mysqli->query($SQLInsBP);
					  }

							$SQLciu="SELECT * FROM reino01_Ciudad WHERE Publico=1 AND ProvinciaID='$idProvincia' ORDER BY Nombre";
							$Resultciu=$mysqli->query($SQLciu) or die (mysqli_error());
							
							while ($arryCiu=mysqli_fetch_array($Resultciu)) {
								$idCiudad=$arryCiu['ID'];
								$resCiudad=$_POST['ciu'.$idCiudad];
							  if($resCiudad)
							  {
								$SQLInsBC="INSERT INTO reino01_banner_ciudad (IDBanner,IDCiudad) VALUES ('$Item','$idCiudad') ";
								$mysqli->query($SQLInsBC);
							  }
							}
				}
	}
	
	if(isset($_POST['campo22'])){
		$SQL="UPDATE $NombreTabla SET Publico='$itempublico',EstadoEnvioWac='2' WHERE ID='$Item'";
	}
	
	if ($CualTabla=="logueo") {	
	if($nivelPorPer=="Administrador")
	{$permisosGen="|100|110|120|200|210|215|220|230|240|160|165|";
	}elseif($nivelPorPer=="Cliente")
	{$permisosGen="|270|280|";}
	
	$SQLper="UPDATE $NombreTabla SET Permisos='$permisosGen' WHERE ID='$Item' ";
	$mysqli->query($SQLper);
	$err.=mysqli_error();
	}

	/* ESPECIFICACIONES ESCORT */
	if ($CualTabla=="Escort") {
		$tablaGuardarFP=$Prefijo."escort_formas_pagos_registro";
		$mysqli->query("DELETE FROM $tablaGuardarFP WHERE ID_escort='".$Item."'");
		
		$tablaFP=$Prefijo."escort_formas_pagos";
		$sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");

		while($arryFP = mysqli_fetch_array($sqlFP))
		{
			$idFP=$arryFP["ID"];
			if(isset($_POST['FP_'.$idFP]) && $_POST['FP_'.$idFP]==1)
			{
				$mysqli->query("INSERT INTO $tablaGuardarFP (ID_escort,ID_forma_pago)values('".$Item."','".$arryFP["ID"]."')");
			}
		}
		
		
		$tablaGuardarLA=$Prefijo."escort_lugares_atencion_registro";
		$mysqli->query("DELETE FROM $tablaGuardarLA WHERE ID_escort='".$Item."'");
		
		$tablaLA=$Prefijo."escort_lugares_atencion";
		$sqlLA = $mysqli->query("select * from $tablaLA where Publico='1'");

		while($arryLA = mysqli_fetch_array($sqlLA))
		{
			$idLA=$arryLA["ID"];
			if(isset($_POST['LA_'.$idLA]) && $_POST['LA_'.$idLA]==1)
			{
				$mysqli->query("INSERT INTO $tablaGuardarLA (ID_escort,ID_lugar_atencion)values('".$Item."','".$arryLA["ID"]."')");
			}
		}
		
		$tablaGuardarS=$Prefijo."escort_servicios_registro";
		$mysqli->query("DELETE FROM $tablaGuardarS WHERE ID_escort='".$Item."'");
		
		$tablaS=$Prefijo."escort_servicios";
		$sqlS = $mysqli->query("select * from $tablaS where Publico='1'");

		while($arryS = mysqli_fetch_array($sqlS))
		{
			$idS=$arryS["ID"];
			if(isset($_POST['S_'.$idS]) && $_POST['S_'.$idS]==1)
			{
				$mysqli->query("INSERT INTO $tablaGuardarS (ID_escort,ID_servicio)values('".$Item."','".$arryS["ID"]."')");
			}
		}
	}
	/**********************************/

$itempublico=$_POST['itempublico'];
if($CualTabla=="Escort")
{$SQL="UPDATE $NombreTabla SET Publico='$itempublico',EstadoEnvioWac='0' WHERE ID='$Item'";}
else
{$SQL="UPDATE $NombreTabla SET Publico='$itempublico' WHERE ID='$Item'";}

$ResultadoAgregar=$mysqli->query($SQL);
$err.=mysqli_error();

$volver=$_GET['backto'];
if ($volver=="") {
	if ($err) {
		$mensaje=$tit_error.": <b>".$err."</b>: ".$error_almodificar.": ".$Item."-".$cualnombreitem.".";
    	header("Location: listarTabla.php?tabla=".$CualTabla."&filtro=".$filtro."&titulo=".$titulo."&mensaje=".$mensaje);
	} else {
		$mensaje=$tit_elitem.": <b>".$Item."-".$cualnombreitem."</b> ".$tit_modificadobien.".";
    	header("Location: ModRegistro.php?tabla=".$CualTabla."&id=".$Item."&filtro=&mensaje=".$mensaje);
	}
} else {
	if (strpos($volver,'?')) {
	} else {
		$volver.="?ref=1";
	}
	if ($err) {
		$mensaje=$tit_error.": <b>".$err."</b>: ".$error_almodificar.": ".$Item."-".$cualnombreitem.".";
    	header("Location: ".$volver."&tabla=".$CualTabla."&filtro=".$filtro."&titulo=".$titulo."&mensaje=".$mensaje);
	} else {
		$mensaje=$tit_elitem.": <b>".$Item."-".$cualnombreitem."</b> ".$tit_modificadobien.".";
    	header("Location: ".$volver."&tabla=".$CualTabla."&filtro=".$filtro."&titulo=".$titulo."&mensaje=".$mensaje);
	}
}

?>
