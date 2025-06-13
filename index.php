<!DOCTYPE html>
<html>
<head>
	<title>Iniciar sesión catálogo</title>
	<meta charset="utf-8">
	<style type="text/css">
		.login{
			position: absolute;
			left: calc(50% - 150px);
			top: calc(50% - 115px);
			width: 300px;
			height: 170px;
			padding-top: 30px;
			border-radius: 3px;
			border:solid 1px #CCC;
			background-color: #f1f1f1;
		}
		.campo{
			position: relative;
			display: inline-block;
			vertical-align: top;
			width: 60%;
			padding-right: 5%;
			padding-left: 5%;
			line-height: 30px;
			background-color: #FFF;
			border:solid 1px #CCC;
			margin-bottom: 10px;
			border-radius:3px;
		}
		.enviar{
			position: relative;
			width: 330px;
			border-radius: 4px;
			line-height: 25px;
			font-size: 12px;
			margin-bottom: 10px;
			font-weight: bolder;
			text-align: center;
			background-color: #e11327;
			color: #FFF;
			font-family: 'Work Sans', sans-serif;
			margin-top: 15px;
			text-transform: uppercase;
			border: solid #444;
			margin-top: 30px;
			cursor: pointer;
			-webkit-appearance: none;
		}
		#contenedor{
			//position: absolute;
			top: 0px;
			letter-spacing: 0px;
			width: 100%;
			height: 100%;
		}
		
		#contenedorpromo{
		    height: 600px;
			width: 69.5%;
			//background: #A4A4A4;
			/* border-radius: .5em; */
			float: left;
			/* margin: 0.5em; */
			/*border-right: solid;*/
			position: relative;
		}
		#contenedorlogin{
			height: 600px;
			width: 30%;
			//background: #A4A4A4;
			/* border-radius: .5em; */
			float: right;
			/* margin: 0.5em; */
			/* border-right: solid; */
			position: relative;
		}
		#logoevento{
			position: relative;
			display: inline-block;
			vertical-align: top;
			width: 100%;
		}
		#banner{
			position: relative;
 			width: 100%;
		}
		#logocamara{
			position: relative;
 			width: 38%;
			margin-bottom: 2em;
    		margin-top: 3em;
		}
		#patrocinador{
			//height: 95%;
			width: 30%;
			//background: #A4A4A4;
			border-radius: 1em;
			float: left;
			margin: 0.5em;
			//border: solid #A4A4A4;
		}
		#imgpatrocinador{
			position: relative;
			display: inline-block;
			vertical-align: top;
			height: 100vh;
			width:100%;
			margin-right: 0%;
			margin-left: 0%;
			margin-top: 0%;
		}
		#contenedorpatrocinadores{
			margin-top: 10%;
		}
		
		#etiqueta-roja{
			position: relative;
			color: #FFF;
			padding: .3em;
			padding-left: 1em;
			padding-right: 1em;
			background-color: #e11327;
			font-family: 'Rhodium Libre', serif;
			font-weight: 600;
			font-size: 1.2em;
			width: 50%;
			text-align: center;
			letter-spacing: .05em;
			line-height: 1.5em;
			float: left;
		}
			#REQUIRED_STAR {
			color: #ff1744;
			padding-left: 1px;
		}

	</style>
</head>
<body style="margin:0px">

	<div id="contenedor" align="center">
		<div id="contenedorsecundario">
			<div id="contenedorpromo">
				
					<!--<div id="patrocinador">-->
						<img id="imgpatrocinador"  src="imagenes/PORTADA.jpg">
					<!--</div>-->
				
			</div>
			<div id="contenedorlogin">
			<!--<div id="etiqueta-roja">ADMINISTRACIÓN</div>-->
				<div id="logoevento">
					<img id="logocamara" src="imagenes/LOGO-CANACINTRA LINEAS MONCLOVA.png">
				</div>
				<form method="post" action="login.php">
                    <div style="padding-right: 60px; padding-left: 40px;">
                    <label for="user" style="float: left;">Correo electrónico<span  id="REQUIRED_STAR">*</span></label>
                        <input type="text" name="USUARIO" placeholder="Usuario" id="user" class="campo" style="width: 100%;"" required>
                    </div>	
                    <div style="padding-right: 60px; padding-left: 40px;">
                        <label for="pass" style="float: left;">Contraseña<span  id="REQUIRED_STAR">*</span></label>
                        <input type="password" name="PASSWORD" placeholder="Clave" id="pass" class="campo" style="width: 100%;"" required>
                    </div>
                    <div style="padding-right: 60px; padding-left: 40px;">
                    <label class="mt-2"> 
                            <span class="mr-lg-2">¿No tiene cuenta?</span> 
                            <a tabindex="0" class="font-weight-semi-bold" href="register.php"> 
                                Registrarse
                            </a>
                        </label>
                    </div>	
					<input type="submit" value="Entrar" name="ENTRAR" class="enviar">
				</form>
			</div>
		</div>
		
	</div>
</body>
</html>

<!-- Messenger plugin de chat Code -->
    <div id="fb-root"></div>

    <!-- Your plugin de chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "600733856678706");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/es_LA/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>