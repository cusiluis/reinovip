<?php
include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Agencias Escort Reino Vip</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?php echo $URLSitio?>reinovip.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo $URLSitio?>reinovip.css"  type="text/css" />
	<link rel="stylesheet" href="<?php echo $URLSitio?>styles.css"  type="text/css" />
	<link rel="stylesheet" href="<?php echo $URLSitio?>jquery.lightbox-0.5.css" />
	<link rel="stylesheet" href="http://www.reinovip.es/css/bootstrap.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"  integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<!-- ####### ED- ######## -->
	<link rel="stylesheet" href="http://trvip.reinovip.com/reinovip-Ampps/CssEcort.css" />

	<link rel="stylesheet" href="http://www.reinovip.es/CssEcort.css" />
	<!-- ####### ED- ######## -->
	<script src="<?php echo $URLSitio?>Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
	<script src="<?php echo $URLSitio?>select.js" type="text/javascript"></script>
	<script src="<?php echo $URLSitio?>jquery.js" type="text/javascript"></script>
	<script src="<?php echo $URLSitio?>jquery.lightbox-0.5.js" type="text/javascript"></script>
	<!-- scripts para SHADOWBOX -->
	<script type="text/javascript" src="<?php echo $URLSitio?>src/adapter/shadowbox-base.js"></script>
	<script type="text/javascript" src="<?php echo $URLSitio?>src/shadowbox.js"></script>
	<style type="text/css">
		.agencias{
		  display: flex; 
		  flex-wrap: wrap;
		}
		.agencias li{
		  flex: 0 0 33.333333%;
		  padding: 10px;
		}
		.foto-agencia{
			
		}
		.lista-escorts{
			display: flex;
		}
		.lista-escorts li{
			float: left;
			padding: 0;

		}
		.lista-escorts li img{
		

		}
	</style>
</head>
<body>
<script type="text/javascript" src="<?php echo $URLSitio?>libraries/formDialog/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="<?php echo $URLSitio?>libraries/formDialog/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $URLSitio?>libraries/formDialog/subform.js"></script>
<link rel="stylesheet" href="<?php echo $URLSitio?>libraries/formDialog/jquery-ui-1.8.16.custom.css" />
	<!-- <center>   -->
	<div id='wrapper'>
		<div class="container">
			<div class="row">
				<div class="contHeader">
					<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 hidden-xs">
					   	<div class="logo">
					   		<a href="http://www.reinovip.es/">
					   			<img src="http://www.reinovip.es/img/header.png">
					   		</a>
					   	</div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 hidden-xs">
					   	<div class="banner">
					   		<a href="http://www.reinovip.es/registro.php">
					   			<img src="http://www.reinovip.es/img/anunciotop.png">
					   		</a>
					   		<div style="margin-top:3px;">
					   			<a href="http://www.reinovip.es/modificar.php">
					   				<img src="<?php echo $URLSitio?>img/login.png">
					   			</a>
					   		</div>
					   	</div>
					</div>

					 <div class="col-xs-12 visible-xs">
	                    <div class="logo">
	                        <div class="contLogo">
	                            <a href="http://www.reinovip.es/">
	                                <img src="http://www.reinovip.es/img/header-in.png">
	                            </a>
	                        </div>
	                    </div>
	                    <button type="button" id="mobile-menu-button" class="btn btn-default " aria-label="Left Align">
	                        <span class="fa fa-align-justify fa-2x" aria-hidden="true"></span>
	                    </button> 
	                </div>
				</div>
			</div>
		</div>
	</div>
    
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-12">
				<ul class="agencias">
					<li>
						<a href="#">
							<div class="foto-agencia"><img src="https://cdn.topescort.com/dynamic/agent/88518/12d5372cbb51f6a56bb28d9bf1cef0fd_01_header.jpg" /></div>
							<div class="chicas-agencia">
								<ul class="lista-escorts">
									<li><img src="https://tse2.mm.bing.net/th?id=OIP.XY9tRltObRQUv8ABtSjPLwAAAA&pid=15.1" /></li>
									<li><img src="https://tse2.mm.bing.net/th?id=OIP.XY9tRltObRQUv8ABtSjPLwAAAA&pid=15.1" /></li>
									<li><img src="https://tse2.mm.bing.net/th?id=OIP.XY9tRltObRQUv8ABtSjPLwAAAA&pid=15.1" /></li>
									<li><img src="https://tse2.mm.bing.net/th?id=OIP.XY9tRltObRQUv8ABtSjPLwAAAA&pid=15.1" /></li>
								</ul>
							</div>
							<div class="descripcion-agencia">
								<h3>NOMBRE AGENCIA</h3>
								<div class="descrip">Donec mattis lorem maximus, semper dui in, pharetra massa. In justo nibh, hendrerit quis ipsum ac, volutpat accumsan est. Nam semper augue tortor, nec molestie ex placerat ut. Pellentesque vel bibendum justo. Cras sed diam ac diam scelerisque lacinia. Quisque mauris est, finibus a varius eu, laoreet a leo. Quisque id sapien finibus, malesuada eros vel, posuere tortor. Morbi fermentum hendrerit diam sed laoreet. </div>
							</div>
						</a>
					</li>
					<li>
						<a href="#">
							<div class="foto-agencia"><img src="https://cdn.topescort.com/dynamic/agent/88518/12d5372cbb51f6a56bb28d9bf1cef0fd_01_header.jpg" /></div>
							<div class="chicas-agencia">
								<ul class="lista-escorts">
									<li><img src="https://tse2.mm.bing.net/th?id=OIP.XY9tRltObRQUv8ABtSjPLwAAAA&pid=15.1" /></li>
								</ul>
							</div>
							<div class="descripcion-agencia">
								<h3>NOMBRE AGENCIA</h3>
								<div class="descrip">Donec mattis lorem maximus, semper dui in, pharetra massa. In justo nibh, hendrerit quis ipsum ac, volutpat accumsan est. Nam semper augue tortor, nec molestie ex placerat ut. Pellentesque vel bibendum justo. Cras sed diam ac diam scelerisque lacinia. Quisque mauris est, finibus a varius eu, laoreet a leo. Quisque id sapien finibus, malesuada eros vel, posuere tortor. Morbi fermentum hendrerit diam sed laoreet. </div>
							</div>
						</a>
					</li>
					<li>
						<a href="#">
							<div class="foto-agencia"><img src="https://cdn.topescort.com/dynamic/agent/88518/12d5372cbb51f6a56bb28d9bf1cef0fd_01_header.jpg" /></div>
							<div class="chicas-agencia">
								<ul class="lista-escorts">
									<li><img src="https://tse2.mm.bing.net/th?id=OIP.XY9tRltObRQUv8ABtSjPLwAAAA&pid=15.1" /></li>
								</ul>
							</div>
							<div class="descripcion-agencia">
								<h3>NOMBRE AGENCIA</h3>
								<div class="descrip">Donec mattis lorem maximus, semper dui in, pharetra massa. In justo nibh, hendrerit quis ipsum ac, volutpat accumsan est. Nam semper augue tortor, nec molestie ex placerat ut. Pellentesque vel bibendum justo. Cras sed diam ac diam scelerisque lacinia. Quisque mauris est, finibus a varius eu, laoreet a leo. Quisque id sapien finibus, malesuada eros vel, posuere tortor. Morbi fermentum hendrerit diam sed laoreet. </div>
							</div>
						</a>
					</li>
					<li>
						<a href="#">
							<div class="foto-agencia"><img src="https://cdn.topescort.com/dynamic/agent/88518/12d5372cbb51f6a56bb28d9bf1cef0fd_01_header.jpg" /></div>
							<div class="chicas-agencia">
								<ul class="lista-escorts">
									<li><img src="https://tse2.mm.bing.net/th?id=OIP.XY9tRltObRQUv8ABtSjPLwAAAA&pid=15.1" /></li>
								</ul>
							</div>
							<div class="descripcion-agencia">
								<h3>NOMBRE AGENCIA</h3>
								<div class="descrip">Donec mattis lorem maximus, semper dui in, pharetra massa. In justo nibh, hendrerit quis ipsum ac, volutpat accumsan est. Nam semper augue tortor, nec molestie ex placerat ut. Pellentesque vel bibendum justo. Cras sed diam ac diam scelerisque lacinia. Quisque mauris est, finibus a varius eu, laoreet a leo. Quisque id sapien finibus, malesuada eros vel, posuere tortor. Morbi fermentum hendrerit diam sed laoreet. </div>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
   
	<div class="final"></div>
	<div id="pie">
		<?php include ("pie.inc.php") ?>
	</div>
	<!-- FIN EN CASO DE NO ENCONTRARSE LA INFORMACION -->
      
</body>
</html>