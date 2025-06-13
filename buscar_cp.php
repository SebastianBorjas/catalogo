<?php
include('conexion.php');

$cp = $_POST['cp'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($con, "SELECT estado, municipio, ciudad, asentamiento, tipo FROM sepomex WHERE cp = '$cp' LIMIT 1");


//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX



    while($registro2 = mysqli_fetch_array($registro)){
                
        echo"
        código postal<input type='text' name='codigo_postal' id='codigo_postal' minlength='5' 
                        maxlength='5' onkeypress='return justNumbers(event)' readonly='readonly' style='width:50px;' value='".$registro2['cp']."'</input>";
        
                        echo"estado<input type='text' name='estado' id='estado' readonly='readonly' value='".$registro2['estado']."'</input>
                        municipio<input type='text' name='municipio' id='municipio' readonly='readonly' value='".$registro2['municipio']."'</input>
                        ciudad<input type='text' name='ciudad' id='ciudad' readonly='readonly' value='".$registro2['ciudad']."'</input></br></br>
        
						tipo zona postal<input type='text' name='zona_postal' id='zona_postal' readonly='readonly' style='width:30px;' value='".$registro2['tipo']."'</input>";
                
                        echo "colonia<select name='colonia' id='colonia'>";
                        $reg = mysqli_query($con, "SELECT colonia FROM Sepomex WHERE cp='$dato'");
                        while ($registro2=mysqli_fetch_array($reg)) {
                        echo"<option value='".$registro2['colonia']."'>".$registro2['colonia']."</option>";
                        }
                        echo"</select>";
                
                        
    
} 