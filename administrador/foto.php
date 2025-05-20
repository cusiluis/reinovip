<?php
$foto=$_GET['id'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo $foto ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="" content="text/html; charset=iso-8859-1">
<?php include("metatags.txt"); ?>
<style type="text/css">
<!--
BODY {
	margin: 0px;
}
-->
</style>
</head>

<body>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="middle" align="center"><a href="javascript:window.close();"><img src="<?php echo $foto ?>" border="0" alt="Cerrar/Close"></a></td>
  </tr>
</table>
</body>
</html>
