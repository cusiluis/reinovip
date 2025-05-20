<?php
// LIBRERIA DE FUNCIONES
//
// funciones genericas con cadenas (varchar)
$CadenaACortar="";
function PrimerValorSubcadena () {
    global $CadenaACortar;
    $Subcadena=$CadenaACortar;
	if ($PosPalito=strpos($Subcadena,"|")) {
	     $Subcadena=substr($CadenaACortar,0,$PosPalito);
		 $CadenaACortar=substr($CadenaACortar,$PosPalito+1);
	} else {
		$CadenaACortar="";
	}
    return $Subcadena;
}

function TextoAntesDe ($Caracter, $Texto) {
	if ($PosCaracter=strpos($Texto,$Caracter)) {
	     $Texto=substr($Texto,0,$PosCaracter);
	} else {
		$Texto="";
	}
    return $Texto;
}    

function TextoDespuesDe ($Caracter, $Texto) {
	if ($PosCaracter=strpos($Texto,$Caracter)) {
	     $Texto=substr($Texto,$PosCaracter+1);
	} else {
		$Texto="";
	}
    return $Texto;
}    

function TextoCambiado ($QueTexto, $QueCambiar, $CambiarPor) {
	$PosCambio=strpos($QueTexto,$QueCambiar);
	if ($PosCambio!=0) {
		$Texto=substr($QueTexto,0,$PosCambio);
		$QueSigue=substr($QueTexto,$PosCambio+strlen($QueCambiar));
		$QueTexto=$Texto.$CambiarPor.$QueSigue;
	}
	return $QueTexto;
}


//funciones de copia y borrado via ftp
function copiarftp ($ArchFuente, $Directorio, $NombreArchDestino) {
  session_start();
  global $FTPhost;
  global $FTPpublica;
  global $FTPrelativa;
  global $FTPuser;
  global $FTPpass;

	$ArchDestino="";
	if ($FTPpublica!="") {
		$ArchDestino.=$FTPpublica."/";
	}
	if ($FTPrelativa!="") {
		$ArchDestino.=$FTPrelativa."/";
	}
	if ($Directorio!="") {
		$ArchDestino.=$Directorio."/";
	} 
	$ArchDestino.=$NombreArchDestino;
	if (!$ftpID=@ftp_connect($FTPhost)) {
		$mensaje="Error al conectarme al ftp";
	} else {
		if (!@ftp_login($ftpID,$FTPuser,$FTPpass)) {
			$mensaje="Error en el login del ftp";
		} else {
			if (!@ftp_put($ftpID,$ArchDestino,$ArchFuente,FTP_BINARY)) {
				$mensaje="Error al grabar el archivo ".$ArchDestino;
			} else {
				$mensaje="1";
			}
		}
		@ftp_close($ftpID);		
	}
	return $mensaje;
}

function borrarftp ($Directorio, $NombreArchDestino) {
  session_start();	
  global $FTPhost;
  global $FTPpublica;
  global $FTPrelativa;
  global $FTPuser;
  global $FTPpass;
	$ArchDestino="";
	$URLArchivo="ftp://".$FTPhost;
	if ($FTPpublica!="") {
		$ArchDestino.=$FTPpublica."/";
		$URLArchivo.=$FTPpublica."/";
	}
	if ($FTPrelativa!="") {
		$ArchDestino.=$FTPrelativa."/";
		$URLArchivo.=$FTPrelativa."/";
	} 
	if ($Directorio!="") {
		$ArchDestino.=$Directorio."/";
		$URLArchivo.=$Directorio."/";
	} 
	$ArchDestino.=$NombreArchDestino;
	$URLArchivo.=$NombreArchDestino;
	/*
	$existe=@file($URLArchivo);
	if (!$existe) {
		$mensaje="2";
	} else {
	*/
		if (!$ftpID=@ftp_connect($FTPhost)) {
			$mensaje="Error al conectarme al ftp";
		} else {
			if (!@ftp_login($ftpID,$FTPuser,$FTPpass)) {
				$mensaje="Error en el login del ftp";
			} else {
				if (!@ftp_delete($ftpID,$ArchDestino)) {
					$mensaje="Error al borrar el archivo ".$ArchDestino;
		        } else {
        		 	$mensaje="1";
		        }
			}
			@ftp_close($ftpID);		
		}
	/*
	}
	*/
	return $mensaje;
}
?>