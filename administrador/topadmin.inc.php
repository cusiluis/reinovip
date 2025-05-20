<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<body onLoad="MM_preloadImages(
	'img/bt_inicio_<?php echo $adminstyle ?>_rol.gif',
	'img/bt_datos_<?php echo $adminstyle ?>_rol.gif',
	'img/bt_cerrar_<?php echo $adminstyle ?>_rol.gif',
	'img/bt_ayuda_<?php echo $adminstyle ?>_rol.gif')">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%">
	  <table width="100%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
		  <td align="left" valign="middle"><a href="admin.php"><img src="img/top.jpg" border="0" alt="<?php echo utf8($alt_inicio) ?>"></a></td>
		</tr>
	  </table>
	</td>
  </tr>
  <?php
  if ($_SESSION['usuariolog']!="") {
  	  //esta logueado
	  ?>
	  <tr>
	    <td height="5"></td>
	  </tr>
	  <tr> 
    	<td height="10">
		  <table cellpadding="0" cellspacing="0" border="0">
            <tr>
        	  <td width="240" valign="middle" class="admin_txt"><?php echo $Prefijo." | ".utf8($NombreSitio)." | ".$_SESSION['usuariolog'] ?></td>
              <td><a href="admin.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('BtHome','','img/bt_inicio_<?php echo $adminstyle ?>_rol.gif',1)"><img src="img/bt_inicio_<?php echo $adminstyle ?>.gif" name="BtHome" border="0"></a></td>
			  <td width="5"></td>
    	      <td><a href="admin.php?accion=datospersonales" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('BtDP','','img/bt_datos_<?php echo $adminstyle ?>_rol.gif',1)"><img src="img/bt_datos_<?php echo $adminstyle ?>.gif" name="BtDP" border="0"></a></td>
			  <td width="5"></td>
              <td><a href="admin.php?accion=logout" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('BtLogout','','img/bt_cerrar_<?php echo $adminstyle ?>_rol.gif',1)"><img src="img/bt_cerrar_<?php echo $adminstyle ?>.gif" name="BtLogout" border="0"></a></td>
			  <td width="5"></td>
    	      <td><a href="ayuda_<?php echo $adminstyle ?>.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('BtAyuda','','img/bt_ayuda_<?php echo $adminstyle ?>_rol.gif',1)"><img src="img/bt_ayuda_<?php echo $adminstyle ?>.gif" name="BtAyuda" border="0"></a></td>
			  <td width="5"></td>
        	</tr>
	      </table>
    	</td>
	  </tr>
	  <tr>
	    <td height="5"></td>
	  </tr>
	  <?php
  } else {
  	  //no esta logueado
	  ?>
	  <tr>
	    <td height="5"></td>
	  </tr>
	  <?php
  }
  if ($mensaje=="") $mensaje=$_GET['mensaje'];
  ?>
  <tr>
    <td class="celdamensaje" style="padding:3px;">&nbsp;<?php echo $mensaje ?></td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
</table>
