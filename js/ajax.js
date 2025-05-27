function ajaxFunction() {

  var xmlHttp;

  try {

    xmlHttp=new XMLHttpRequest();

    return xmlHttp;

  } catch (e) {

    try {

      xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");

      return xmlHttp;

    } catch (e) {

	  try {

        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");

        return xmlHttp;

      } catch (e) {

        alert("Tu navegador no soporta AJAX!");

        return false;

      }}}

}

function terminar(){

	document.getElementById("terminar").style.display="inline";
	document.getElementById("cargaFinal").style.display="inline";

	if (document.getElementById("f_pais").options[document.getElementById("f_pais").selectedIndex].value=="0") {
		document.getElementById("terminar").style.display="none";
	document.getElementById("cargaFinal").style.display="none";
	}
	if (document.getElementById("f_provincia").options[document.getElementById("f_provincia").selectedIndex].value=="0") {
		document.getElementById("terminar").style.display="none";
	document.getElementById("cargaFinal").style.display="none";
	}
	if (document.getElementById("f_ciudad").options[document.getElementById("f_ciudad").selectedIndex].value=="0") {
document.getElementById("terminar").style.display="none";
	document.getElementById("cargaFinal").style.display="none";
	}	
	
		document.getElementById("terminar").style.display="none";
	document.getElementById("cargaFinal").style.display="none";
		
}

function verProvincias(idPais,idProv) {

	document.getElementById("cargProv").style.display="inline";

	var ajax;

    ajax = ajaxFunction();

    ajax.open("POST", "provincias.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	

    ajax.onreadystatechange = function() {

		if (ajax.readyState==1){

				document.getElementById("cargProv").style.display="inline";

			     }

		if (ajax.readyState == 4) {

				 document.getElementById("f_provincia").disabled=false;

                 document.getElementById("f_provincia").innerHTML=ajax.responseText;

				 document.getElementById("cargProv").style.display="none";

		     }}

			 

	ajax.send('idPais='+idPais+'&idProvincia='+idProv);

} 

function verProvinciasB(idPais,idProv) {

	document.getElementById("cargProv").style.display="inline";

	var ajax;

    ajax = ajaxFunction();

    ajax.open("POST", "provinciasB.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	

    ajax.onreadystatechange = function() {

		if (ajax.readyState==1){

				document.getElementById("cargProv").style.display="inline";

			     }

		if (ajax.readyState == 4) {

				 document.getElementById("f_provincia").disabled=false;

                 document.getElementById("f_provincia").innerHTML=ajax.responseText;

				 document.getElementById("cargProv").style.display="none";

		     }}

			 
			$('.f_provincia').select2();
	ajax.send('idPais='+idPais+'&idProvincia='+idProv);

} 

function verProvinciasE(idPais,idProv,seleccion) {

	document.getElementById("cargProv").style.display="inline";

	var ajax;

    ajax = ajaxFunction();

    ajax.open("POST", "provincias_e.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	

    ajax.onreadystatechange = function() {

		if (ajax.readyState==1){

				document.getElementById("cargProv").style.display="inline";

			     }

		if (ajax.readyState == 4) {

				 document.getElementById("f_provincia").disabled=false;

                 document.getElementById("f_provincia").innerHTML=ajax.responseText;

				 document.getElementById("cargProv").style.display="none";

		     }}

			 

	ajax.send('idPais='+idPais+'&idProvincia='+idProv+'&s='+seleccion);

} 


function verCiudades(idPais,idCiudad) {

	document.getElementById("cargCiu").style.display="inline";

	var ajax;

    ajax = ajaxFunction();

    ajax.open("POST", "ciudades.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	

    ajax.onreadystatechange = function() {

		if (ajax.readyState==1){

			document.getElementById("cargCiu").style.display="inline";

			     }

		if (ajax.readyState == 4) {

				 document.getElementById("f_ciudad").disabled=false;

                 document.getElementById("f_ciudad").innerHTML=ajax.responseText;

				 document.getElementById("cargCiu").style.display="none";

		     }}

			 $('.f_ciudad').select2();
	ajax.send('idProv='+idPais+'&idCiudad='+idCiudad);

}
function verCiudadesB(idPais,idCiudad) {

	document.getElementById("cargCiu").style.display="inline";

	var ajax;

    ajax = ajaxFunction();

    ajax.open("POST", "ciudadesB.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	

    ajax.onreadystatechange = function() {

		if (ajax.readyState==1){

			document.getElementById("cargCiu").style.display="inline";

			     }

		if (ajax.readyState == 4) {

				 document.getElementById("f_ciudad").disabled=false;

                 document.getElementById("f_ciudad").innerHTML=ajax.responseText;

				 document.getElementById("cargCiu").style.display="none";

		     }}

			 $('.f_ciudad').select2();
	ajax.send('idProv='+idPais+'&idCiudad='+idCiudad);

}

function verCiudadesE(idPais,idCiudad,seleccion) {

	document.getElementById("cargCiu").style.display="inline";

	var ajax;

    ajax = ajaxFunction();

    ajax.open("POST", "ciudades_e.php", true);

    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

	

    ajax.onreadystatechange = function() {

		if (ajax.readyState==1){

			document.getElementById("cargCiu").style.display="inline";

			     }

		if (ajax.readyState == 4) {

				 document.getElementById("f_ciudad").disabled=false;

                 document.getElementById("f_ciudad").innerHTML=ajax.responseText;

				 document.getElementById("cargCiu").style.display="none";

		     }}

			 $('.f_ciudad').select2();
	ajax.send('idProv='+idPais+'&idCiudad='+idCiudad+'&s='+seleccion);

} 