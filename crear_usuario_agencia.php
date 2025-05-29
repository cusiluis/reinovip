<?php

include ("includes/globales.inc.php");
include ("includes/conexion.inc.php");

// $donde='mapa.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $TituloSitio; ?></title>
  <meta name="description" content="Guía Erótica de España donde encontraras acompañantes vip, chicas, escorts, travestis, eros,  etc.  Publica tu anuncio GRATIS">
  <meta name="keywords" content="acompañantes vip, chicas, escorts, travestis, eros, gays, chicas en las palmas, transexuales,">

   

<?php 
  include ('cabecera.php');
  
?>
<style>
    .content-container-crear {
  max-width: 500px;
  margin: 0 auto;
  padding: 0 36px;
  margin-top: 2em;
  }
 .content-container-crear h1{
      color: #793a57;
      font-size: 1.5rem;
      text-align: center;
    }
.content-container-crear h2{
    color: #793a57;
  font-size: 1.1rem;
  margin-bottom: 20px;
    }
    p {
      color: #333;
      line-height: 1.6;
      margin-top: 1em;
      text-align: justify;
    }
    .content-container-crear ul.listado li{
      font-size: 0.9rem;
    list-style-type: square !important;
  display: list-item;
  border: none;
  padding: 0;
  margin: 10px 18px;
    }

    @media (max-width: 600px) {
      .content-container-crear {
        padding: 0;
      }
    }
    .login-box {
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 400px;
        max-width: 100%;
    }

    .input-group {
        margin-bottom: 20px;
        width: 100%;
    }

    .input-group label {
        font-size: .8rem !important;
        color: #666;
    }
.radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
  position: absolute;
  margin-top: 4px \9;
  margin-left: -22px;
  margin-top: 10px;
}
    .input-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px !important;
        margin-top: 5px;
        font-size: .8rem;
    }

    .input-group input:focus {
        border-color: #00a850;
        outline: none;
    }

    .error-message {
        color: red;
        font-size: .7rem;
        margin-top: 5px;
    }

.submit-btn {
  background-color: #702343;
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: background-color 0.4s ease, transform 0.3s ease;
  width: 100%;
  margin-top: 30px;
}
input[type="radio"], input[type="checkbox"] {
  margin: 4px 0 0;
    margin-top: 4px;
    margin-left: 0px;
  margin-top: 1px \9;
  line-height: normal;
  -ms-transform: scale(1.5);
  -moz-transform: scale(1.5);
  -webkit-transform: scale(1.5);
  -o-transform: scale(1.5);
  padding: 10px;
}
/* Hover: agrandar y tono más claro */
.submit-btn:hover {
  background-color: #8a2d52;
  transform: scale(1.05);
}

/* Línea brillante dorada */
.submit-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    120deg,
    transparent,
    rgba(255, 215, 0, 0.6),
    transparent
  );
  transition: all 0.5s ease;
}

/* Animación al pasar el mouse */
.submit-btn:hover::before {
  left: 100%;
}
.formlink  {
    color: #333;
    text-decoration: none;
}
.formlink:hover {
    color: #cc922f;
}
.error { color: red; display: none; margin-top: 5px; font-size: 14px; }
</style>

<!-- Cards -->
<div class="container">
   <div class="content-container-crear">
                            <?php if ($_GET['error'] == '1') { ?>
                        <div class="login-box"><p id="mensajeError" class="error" style="display: block;">Por favor, debe completar todos los campos obligatorios.</p></div><br>
                        <?php } ?>
                           <div class="login-box">
                            <h2>Registrar una agencia:</h2>
                            <form action="creacion_usuario_completado.php" id="registroForm" method="post" name="frmIngreso">
                                <input type="hidden" name="agencia" value="true">
                                <div class="input-group">
                                    <label for="email">Nombre de la agencia</label>
                                    <input name="usuario" id="usuario" type="text" class="form_celdainput_ingreso" required />
                                    <small id="email-error" class="error-message"></small>
                                </div>

                                <div class="input-group">
                                    <label for="password">Contraseña</label>
                                    <input name="contrasena1" id="contrasena1" type="password"
                                        class="form_celdainput_ingreso" required />
                                    <small id="password-error" class="error-message"></small>
                                </div>
                                <div class="input-group">
                                    <label for="password">Volver a poner la contraseña</label>
                                    <input name="contrasena2" id="contrasena2" type="password"
                                        class="form_celdainput_ingreso" required />
                                    <small id="password-error" class="error-message"></small>
                                </div>
                                <p id="mensajeError" class="error" required>Los campos de contraseña no coinciden.</p>

                                <div class="input-group">
                                    <label for="password">Correo electrónico</label>
                                    <input name="correo1" id="correo1" type="email" class="form_celdainput_ingreso"
                                    type="email" class="form_celdainput_ingreso" required />
                                    <small id="password-error" class="error-message"></small>
                                </div>
                                <span class="error" id="emailError">No se permiten correos temporales.</span>
                                <div class="input-group">
                                    <label for="password">Volver a colocar el email</label>
                                    <input name="correo2" id="correo2" type="email" class="form_celdainput_ingreso"
                                     type="email" class="form_celdainput_ingreso" required />
                                    <small id="password-error" class="error-message"></small>
                                </div>
                                <p id="mensajeError2"  class="error">Los campos de correo  no coinciden.</p>
                                <div class="input-group" style="margin-left: 21px;">
                                    <label class="checkbox">
                                        <input type="checkbox" name="condition" style="width:auto"
                                            id="frm-signUpForm-condition" required="" data-lfv-initialized="true"
                                            data-lfv-message-id="frm-signUpForm-condition_message">
                                        <span class="checkmark"></span>
                                        He leído y acepto las
                                        <a class="formlink" href="/terminos.php" target="_blank"><strong>Términos y condiciones, Política
                                            de privacidad</strong></a>
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="condition1" style="width:auto"
                                            id="frm-signUpForm-condition1" required="" data-lfv-initialized="true"
                                            data-lfv-message-id="frm-signUpForm-condition1_message">
                                        <span class="checkmark"></span>
                                        Acepto el procesamiento de mis datos personales <a class="formlink" href="/gdpr.php"
                                            target="_blank"><strong>(GDPR)</strong></a>
                                    </label>
                                    <span id="frm-signUpForm-condition_message"></span><span
                                        id="frm-signUpForm-condition1_message"></span>
                                </div>
                                <button type="submit" onclick="compararCampos();" class="submit-btn">Finalizar el registro</button>


                            </form>


                        </div>
  
   
  </div>
 
</div>

<script>
    function compararCampos() {
      const campo1 = document.getElementById('contrasena1').value;
      const campo2 = document.getElementById('contrasena2').value;
	  const campo3 = document.getElementById('correo1').value;
      const campo4 = document.getElementById('correo2').value;
      const mensajeError = document.getElementById('mensajeError');
	  const mensajeError2 = document.getElementById('mensajeError2');

      if (campo1 !== campo2) {
        mensajeError.style.display = 'block';
		return false; // Mostrar mensaje de error
      } else {
        mensajeError.style.display = 'none'; // Ocultar mensaje de error
      }
	  if (campo3 !== campo4) {
        mensajeError2.style.display = 'block'; 
		return false;// Mostrar mensaje de error
      } else {
        mensajeError2.style.display = 'none'; // Ocultar mensaje de error
        return true;
    }
    }
</script>
<script>
    const correoDesechable = [
      "mailinator.com", "10minutemail.com", "guerrillamail.com", "yopmail.com",
      "temp-mail.org", "throwawaymail.com", "emailondeck.com", "maildrop.cc",
      "moakt.com", "inboxkitten.com", "getnada.com", "fakemail.net",
      "trashmail.com", "dispostable.com"
    ];

    const form = document.getElementById("registroForm");
    const emailInput = document.getElementById("correo1");
    const errorMsg = document.getElementById("emailError");

    form.addEventListener("submit", function(e) {
      const emailValue = emailInput.value.trim().toLowerCase();
      const dominio = emailValue.split("@")[1];
      if(compararCampos() == false) {
        e.preventDefault();
      }
      if (correoDesechable.includes(dominio)) {
        errorMsg.style.display = "block";
        e.preventDefault();
       
      } else {
        errorMsg.style.display = "none";
        
      }
      
    });
</script>
<!-- Footer -->
<?php include ('footer.php') ?>
