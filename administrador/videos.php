<?php
require("../includes/globales.inc.php");
require("../includes/conexion.inc.php");

   // Edit upload location here
    $idEscort=$_POST['idEscort'];
	$Pincipal=$_POST['imgPrincipal'];
	$video=$_POST['txtVideo'];
	$result = 0;
	
	$videoId=ExtractVideoid($video);
	
	if($Pincipal==1){
	$SQLGC="update reino01_video_escort set Principal=0 where IdEscort='$idEscort'";	
	$mysqli->query($SQLGC);
	}

   	$SQLMP="insert into reino01_video_escort(IdEscort,Video,Principal) 
					values ('$idEscort','$videoId','$Pincipal')";	
   if($mysqli->query($SQLMP)){
      $result = 1;
   }
   
   sleep(1);
   
function ExtractVideoid($code){
            $pos = strpos($code,'?v=',0);
                if($pos>0){
                    $next = strpos($code,'&',$pos+3);
                    if ($next>0)
                        return substr($code, $pos+3,$next-$pos-3);
                    return substr($code, $pos+3);
            }
            return false;
        }  
?>

<script language="javascript" type="text/javascript">window.top.window.stopSubirVideo(<?php echo $result; ?>,<?php echo $idEscort; ?>);</script>
