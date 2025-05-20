<?php

require("../includes/globales.inc.php");

require("../includes/conexion.inc.php");

require("../includes/libreria.inc.php");

include("admin.traducciones.php");
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

    	//ImageJpeg($newim,"$path/$name".".jpg");

		imageJpeg($newim,"temp/".$name.".jpg");

		copiarftp ("temp/".$name.".jpg",$path,$name.".jpg");

		unlink("temp/".$name.".jpg");

		ImageDestroy($newim);

	} else {

		//ImageJpeg($im,"$path/$name".".jpg");

		ImageJpeg($im,"temp/".$name.".jpg");

    	copiarftp ("temp/".$name.".jpg",$path,$name.".jpg");

	    unlink("temp/".$name.".jpg");

	}

}  // fin function ResizeImage()



$err=0;

$CualTabla=$_GET["tabla"];

if ((!$CualTabla) or ($Prefijo=="")) {

    header("Location: admin.php?mensaje=".$error_accesoindebido.". ".$tit_modulo.": scriptAltaRegistro.");

    exit;

}

$TomoFront=$_POST['front'];

$itempublico=$_POST['itempublico'];

$NombreTabla=$Prefijo.$CualTabla;

if($CualTabla=="Escort")

{

$fechaReg=date("Y-m-d");

$SQL="INSERT INTO $NombreTabla (Publico,fecha_registro) VALUES ('$itempublico',NOW())";}

else

{$SQL="INSERT INTO $NombreTabla (Publico) VALUES ('$itempublico')";}

$SQL2="SELECT * FROM $NombreTabla ORDER BY ID DESC limit 1;";
$mysqli->query($SQL);
$ultimoarray=$mysqli->query($SQL2);
//$ResultadoAgregar=$mysqli->query($SQL);
while ($row=mysqli_fetch_array($ultimoarray)) {
$ultimoID=$row['ID'];
}



$tablaE=$Prefijo."estructura";

if ($TomoFront=="si") {

	$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenfront='0' ORDER BY Nrodeordenfront ASC";

} else {

	$SQL="SELECT * FROM $tablaE WHERE Nombretabla='$CualTabla' AND NOT Nrodeordenback='0' ORDER BY Nrodeordenback ASC";

}

$ResultadoEstructura=$mysqli->query($SQL);

$ii=1;

$cualnombreitem="";

$nivelPorPer="";

while ($RegistroEstructura=mysqli_fetch_array($ResultadoEstructura)) {

    $TipoDeEntrada=$RegistroEstructura['Tipodeentrada'];

	$NombreCampo=$RegistroEstructura['Nombrecampo'];

	$Directorio=$RegistroEstructura['Directorio'];

	//debugg ::

	//echo $ii." :: ".$TipoDeEntrada."-".$NombreCampo."<br>";

	//

	

	$valor="Campo".$ii;

	

	if (($CualTabla=="logueo") && ($NombreCampo=="Nivel")) {

		$nivelPorPer=$_POST[$valor];

	}

	

	$Contenido=$_POST[$valor];

	if (($TipoDeEntrada=="IMAGEN") or ($TipoDeEntrada=="JPG") or ($TipoDeEntrada=="ARCHIVO")) {

		$TamanioArchivo=$_FILES[$valor]['size'];

		$TemporalArchivo=$_FILES[$valor]['tmp_name'];

		$NombreArchivo=$_FILES[$valor]['name'];

	}

	if ($NombreCampo=="Nombre") $cualnombreitem=$Contenido;

    if (($TipoDeEntrada=="INPUT") or ($TipoDeEntrada=="MEMO") or ($TipoDeEntrada=="HTML")) {

	     $Contenido=addslashes($Contenido);

	} 

	if ($TipoDeEntrada=="CHECK") {

	    if ($Contenido=="checkbox") $Contenido="1";

    }

	//debugg ::

	//echo $NombreCampo."()contenido: ".$Contenido."<br>";

	//echo $NombreCampo."()nombre archivo: ".$NombreArchivo."<br>";

	//

	if($CualTabla!="Escort")

	{

	if (($TipoDeEntrada=="IMAGEN") or ($TipoDeEntrada=="JPG")) {

		//debugg ::	echo $NombreCampo."(name): -".$NombreArchivo."-<br>";

		//debugg ::	echo $NombreCampo."(tmp_name): -".$TemporalArchivo."-<br>";

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

			$FILENAME=$PrefijoFoto.$ultimoID."c";

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

				if (file_exists($ArchivoABorrar)) $err=borrarftp($Directorio,$FILENAME.".jpg");

			    ResizeImage($imagen,$RESIZEWIDTH,$RESIZEHEIGHT,$Directorio,$FILENAME);

    			ImageDestroy($imagen);

			}

			//armo la imagen grande

			$Ancho=$RegistroEstructura['Imagenanchofoto'];

			$Alto=$RegistroEstructura['Imagenaltofoto'];

			$FILENAME=$PrefijoFoto.$ultimoID."g";

			if (($Ancho==0) or ($Alto==0)) {

				//paso la imagen tal cual, sin redimensionarla 

				if ($Directorio!="") {

					$ArchivoABorrar="../".$Directorio."/".$FILENAME.".jpg";

				} else {

					$ArchivoABorrar="../".$FILENAME.".jpg";

				}

				if (file_exists($ArchivoABorrar)) $err=borrarftp($Directorio,$FILENAME.".jpg");

			    $err.=copiarftp($campoimagen,$Directorio,$FILENAME.".jpg");

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

					if (file_exists($ArchivoABorrar)) borrarftp($Directorio, $FILENAME.".jpg");

			    	ResizeImage($imagen,$RESIZEWIDTH,$RESIZEHEIGHT,$Directorio,$FILENAME);

			    	ImageDestroy($imagen);

				}

			}

			$Contenido=$NombreArchivo;

		}

	}

	}

	if (($TipoDeEntrada=="ARCHIVO") && ($CualTabla != "Banner")) {

		if ($NombreArchivo!="") {

			if ($Directorio!="") {

				$ArchivoABorrar="../".$Directorio."/".$NombreArchivo;

			} else {

				$ArchivoABorrar="../".$NombreArchivo;

			}

			if (file_exists($ArchivoABorrar)) $err=borrarftp($Directorio,$NombreArchivo);

			$err.=copiarftp($TemporalArchivo,$Directorio,$NombreArchivo);

			if ($err=="1") $err="";

			$Contenido=$NombreArchivo;

		}	

	}

	else

	{


	$target_path = "../banners/".$NombreArchivo;

		if(@move_uploaded_file($_FILES['Campo3']['tmp_name'], $target_path)) {

		$archivoSuvido="OK";


		$Contenido=$NombreArchivo;



   		}

	}

	

	if ($TipoDeEntrada=="FECHA") {

		$valor="Campo".$ii."_anio";

		$Anio=$_POST[$valor];

		$valor="Campo".$ii."_mes";

		$Mes=$_POST[$valor];

		$valor="Campo".$ii."_dia";

		$Dia=$_POST[$valor];

		$Contenido=$Anio."-".$Mes."-".$Dia;

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

	}

	if ($TipoDeEntrada=="TRADUCCION") {

	    $Contenido=addslashes($Contenido);

		$tablaI=$Prefijo."Idioma";

		$SQL="SELECT * FROM $tablaI WHERE (Publico='1') ORDER BY Nrodeorden ASC";

		$ResultI=$mysqli->query($SQL);

		while ($RegI=mysqli_fetch_array($ResultI)) {

			$id_idioma=$RegI['ID'];

			$trad=$valor."_traduccion_".$id_idioma;

			$cont_trad=addslashes($_POST[$trad]);

			$tablaT=$Prefijo."Traduccion";

			$SQL="INSERT INTO $tablaT (Publico,Tabla,TablaID,Campo,IdiomaID,Nombre) VALUES ('1','$CualTabla','$ultimoID','$NombreCampo','$id_idioma','$cont_trad') ";

			$agregar_traduccion=$mysqli->query($SQL);

			$error=mysqli_error();

		}

	}

	

	//$Contenido=utf8($Contenido);

	

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



		$SQL="UPDATE $NombreTabla SET $NombreCampo='$Contenido' WHERE ID='$ultimoID' ";
		
		$ResultadoAgregar=$mysqli->query($SQL);

//		$err.=mysqli_error();

		$ii++;



	

	

	

	

	

} // del while



	if ($CualTabla=="Banner") {

				$SQLprov="SELECT * FROM reino01_Provincia WHERE Publico=1 ORDER BY Nombre";

				$Resultprov=$mysqli->query($SQLprov) or die (mysqli_error());

				while ($arryProv=mysqli_fetch_array($Resultprov)) {

					  $idProvincia=$arryProv['ID'];

					  $resProvincia=$_POST['prov'.$idProvincia];

					  

					  if($resProvincia)

					  {

					  	$SQLInsBP="INSERT INTO reino01_banner_provincia (IDBanner,IDProvincia) VALUES ('$ultimoID','$idProvincia') ";

						$mysqli->query($SQLInsBP);

						$target_path = "../banners/".$NombreArchivo;

						if(@move_uploaded_file($_FILES['Campo2']['tmp_name'], $target_path)) {

								$mysql="UPDATE $NombreTabla SET ArchivoMultimedia='$NombreArchivo' WHERE ID='$ultimoID' ";
						
						$mysqli->query($mysql);

				   		}

						

					  }



							$SQLciu="SELECT * FROM reino01_Ciudad WHERE Publico=1 AND ProvinciaID='$idProvincia' ORDER BY Nombre";

							$Resultciu=$mysqli->query($SQLciu) or die (mysqli_error());

							

							while ($arryCiu=mysqli_fetch_array($Resultciu)) {

								$idCiudad=$arryCiu['ID'];

								$resCiudad=$_POST['ciu'.$idCiudad];

							  if($resCiudad)

							  {

								$SQLInsBC="INSERT INTO reino01_banner_ciudad (IDBanner,IDCiudad) VALUES ('$ultimoID','$idCiudad') ";

								$mysqli->query($SQLInsBC);

							  }

							}

				}

	}

	

	if ($CualTabla=="logueo") {

	if($nivelPorPer=="Administrador")

	{$permisosGen="|100|110|120|200|210|215|220|230|240|160|165|";

	}elseif($nivelPorPer=="Cliente")

	{$permisosGen="|270|280|";}

	

	$SQLper="UPDATE $NombreTabla SET Permisos='$permisosGen' WHERE ID='$ultimoID' ";

	$mysqli->query($SQLper);

	$err.=mysqli_error();

	}

	

	/* ESPECIFICACIONES ESCORT */

	if ($CualTabla=="Escort") {

		$Item=$ultimoID;

		$tablaGuardarFP=$Prefijo."escort_formas_pagos_registro";

		$tablaFP=$Prefijo."escort_formas_pagos";

		$sqlFP = $mysqli->query("select * from $tablaFP where Publico='1'");
		$sql="select * from $tablaFP where Publico='1'";
		//echo $sql;exit;


		while($arryFP = mysqli_fetch_array($sqlFP))

		{

			$idFP=$arryFP["ID"];

			if(isset($_POST['FP_'.$idFP]) && $_POST['FP_'.$idFP]==1)

			{

				$mysqli->query("INSERT INTO $tablaGuardarFP (ID_escort,ID_forma_pago)values('".$Item."','".$arryFP["ID"]."')");

			}

		}

			

		$tablaGuardarLA=$Prefijo."escort_lugares_atencion_registro";

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



$volver=$_GET['backto'];

if ($volver=="") {

	if ($err) {

		$mensaje=$tit_error.": <b>".$err."</b>: ".$error_algrabar.": ".$ultimoID."-".$cualnombreitem.".";

	    header("Location: listarTabla.php?tabla=".$CualTabla."&filtro=".$filtro."&titulo=".$titulo."&front=".$TomoFront."&mensaje=".$mensaje);

	} else {

		$mensaje=$tit_elitem.": <b>".$ultimoID."-".$cualnombreitem."</b> ".$tit_agregadobien.".";

    	header("Location: ModRegistro.php?tabla=".$CualTabla."&id=".$ultimoID."&filtro=&mensaje=".$mensaje);

	}

} else {

	if (strpos($volver,'?')) {

	} else {

		$volver.="?ref=1";

	}

	if ($err) {

		$mensaje=$tit_error.": <b>".$err."</b>: ".$error_algrabar.": ".$ultimoID."-".$cualnombreitem.".";

	    header("Location: ".$volver."&tabla=".$CualTabla."&filtro=".$filtro."&titulo=".$titulo."&front=".$TomoFront."&mensaje=".$mensaje);

	} else {

		$mensaje=$tit_elitem.": <b>".$ultimoID."-".$cualnombreitem."</b> ".$tit_agregadobien.".";

    	header("Location: ".$volver."&tabla=".$CualTabla."&filtro=".$filtro."&titulo=".$titulo."&front=".$TomoFront."&mensaje=".$mensaje);

	}

}

?>