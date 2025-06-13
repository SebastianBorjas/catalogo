<?php //session_start();

	/*$hostname_conexion = "localhost";
	$username_conexion = "canacin8_proye20";
	$password_conexion = "CDOufbu0fa!A";
	$name = "canacin8_proyectos";
	$db = new mysqli($hostname_conexion,$username_conexion,$password_conexion,$name,3306);
	$db->set_charset('utf8');*/

  include 'conexion.php';
	

    $Especialidad =  $_POST['Especialidad'];

	
	$queryF = "SELECT idEspecialidad,SubEspecialidad FROM sectores where Especialidad = '$Especialidad'"; 
	$resultadoF = $db->query($queryF);
	

	$html = "<option >Seleccione una opción</option>";
	echo $html;
	
	 while($rowF = $resultadoF->fetch_assoc()) 
	 { 
      $html= "<option value='".$rowF['SubEspecialidad']."'>".$rowF['SubEspecialidad']."</option>";
      echo $html;		        
    } 
    //session_destroy();
?>