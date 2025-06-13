<!DOCTYPE html>
<html>
<head>
	<title>ADMINISTRACION-REGISTROS</title>
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
			margin-top: 10px;
			border-radius:3px;
		}
		.enviar{
			position: relative;
			width: 50%;
			height: 30px;
			margin-top: 10px;
			border-radius: 3px;
			border:0px;
			font-weight: bolder;
			text-transform: uppercase;
			cursor: pointer;
		}
		.contenedor{
			position: absolute;
			top: 0px;
			letter-spacing: 0px;
			width: 100%;
			height: 100%;
		}
	</style>
</head>
<body>

	<div class="contenedor" align="center">
		<div class="login" align="center">
			<form method="post" action="login.php">
				<input type="text" name="NOMBRE" class="campo">
				<input type="password" name="PASSWORD" class="campo">
				<input type="submit" value="Entrar" name="ENVIAR" class="enviar">
			</form>
		</div>
	</div>
</body>
</html>