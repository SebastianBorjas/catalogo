<?php


$id = $_POST["id"];
//$id = '2';

$hostname_conexion = "localhost";
$username_conexion = "canacin8_proye20";
$password_conexion = "CDOufbu0fa!A";
$name = "canacin8_proyectos";
$db = new mysqli($hostname_conexion,$username_conexion,$password_conexion,$name,3306);
$db->set_charset('utf8');



include_once('PDF.php');
//require "fpdf/fpdf.php";
$query = "Select * from Empresa where idEmpresa= $id";
$resultado = mysqli_query($db, $query);    

//-----------------------Proceso---------------------------
$query2 = "SELECT * FROM Proceso WHERE idEmpresa = $id";
$resultado2 = mysqli_query($db,$query2); 

$query3 = "SELECT COUNT(*) FROM Proceso WHERE idEmpresa = $id";
$resultado3 = mysqli_query($db,$query3);

//-----------------------Producto--------------------------
$query4 = "SELECT * FROM Producto WHERE idEmpresa = $id";
$resultado4 = mysqli_query($db,$query4); 

$query5 = "SELECT COUNT(*) FROM Producto WHERE idEmpresa = $id";
$resultado5 = mysqli_query($db,$query5);

//-----------------------Cliente---------------------------
$query6 = "SELECT * FROM Cliente WHERE idEmpresa = $id";
$resultado6 = mysqli_query($db,$query6); 

$query7 = "SELECT COUNT(*) FROM Cliente WHERE idEmpresa = $id";
$resultado7 = mysqli_query($db,$query7);

//-----------------------Certificación---------------------
$query8 = "SELECT * FROM Certificacion WHERE idEmpresa = $id";
$resultado8 = mysqli_query($db,$query8); 

$query9 = "SELECT COUNT(*) FROM Certificacion WHERE idEmpresa = $id";
$resultado9 = mysqli_query($db,$query9);



////////IZQUIERDA////////
//Cuadro que encapsula imagen
$posicion_MulticeldaIFX = 10;
$posicion_MulticeldaIFY = 60;
//Imagen a mostrar dentro de cuadro
$posicion_MulticeldaIIX = 15;
$posicion_MulticeldaIIY = 63;
//Texto descriptivo correspondiente al cuadro
$posicion_MulticeldaITX = 10;
$posicion_MulticeldaITY = 95;



if($resultado)
{
while($row = $resultado -> fetch_array()){

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B', 10);
//Imagen fondo/ marca de agua iniciando en 0, 0
$pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA.png', 25,80, 170, 130, 'PNG');

/*class pdf2 extends FPDF{ 
        function Hader(){ */
        //IMAGE (RUTA,X,Y,ANCHO,ALTO,EXTEN) 
        //Imagen izquierda
        $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10, 'PNG');

        //Texto de Título
        $pdf->SetFont('Times','B', 11);
        $pdf->SetXY(60, 10);
        $pdf->Cell(65, 5, utf8_decode('CATÁLOGO DE CAPACIDADES DE MANUFACTURA'), 0, 'C');
        
        //Texto Explicativo
        $pdf->SetFont('TIMES','', 9);
        $pdf->SetXY(62, 15);
        $pdf->Cell(90, 4, utf8_decode('PROCESOS DE MANUFACTURA / MANUFACTURING PROCESSES'), 0, 'J');

        // Número de página 
        $pdf->SetFont('Arial','I',8);
        $pdf->SetXY(171, 8);
        $pdf->Cell(0,10,utf8_decode('Página / Page ').$pdf->PageNo(),0,0,'C');

        //Fecha actual
        $pdf->SetXY(180, 13);
        $pdf->Cell(40,10,date('d/m/Y'),0,1,'L');

        //Texto Explicativo 2
        $pdf->SetFont('TIMES','', 9);
        $pdf->SetTextColor(255,255,255);  // Establece el color del texto 
        $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
        $pdf->SetDrawColor(207,207,207,255);
        $pdf->SetXY(10, 23);
        $pdf->MultiCell(80, 4, utf8_decode('EMPRESA / COMPANY'), 1, 'J', true);

        //CAMPO DE DIRECCIÓN
        $pdf->SetXY(100, 23);
        $pdf->MultiCell(70, 4, utf8_decode('DIRECCIÓN / ADDRESS'), 1, 'J', true);

        //LOGO DE LA EMPRESA
        $pdf->SetXY(170, 23);
        $pdf->MultiCell(30, 14,'', 1, 'J', false);
        $pdf->Image('../ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14, 'PNG');

        //ACTIVIDAD PRINCIPAL DE LA EMPRESA
        $pdf->SetXY(10, 40);
        $pdf->MultiCell(80, 4,utf8_decode('ACTIVIDAD PRINCIPAL / MAIN ACTIVITY'), 1, 'J', true);


        //DATOS DE CONTACTO
        $pdf->SetXY(100, 37);
        $pdf->MultiCell(100, 4, utf8_decode('DATOS DE CONTACTO / CONTACT INFORMATION'), 1, 'J', true);

        //SITIO WEB (DATO DE CONTACTO)
        $pdf->SetFont('TIMES','', 8);
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 41);
        $pdf->MultiCell(40, 4,'SITIO WEB / WEB SITE', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 41);
        $pdf->MultiCell(60, 4,utf8_decode($row['sitioWeb']), 1, 'J', false);

        //CORREO/E-MAIL (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 45);
        $pdf->MultiCell(40, 4,'CORREO/E-MAIL', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 45);
        $pdf->MultiCell(60, 4,utf8_decode($row['correo']), 1, 'J', false);

        //NOMBRE DE CONTACTO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 49);
        $pdf->MultiCell(40, 4,'CONTACTO / CONTACT', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 49);
        $pdf->MultiCell(60, 4,utf8_decode($row['nombre']), 1, 'J', false);

        //TELÉFONO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 53);
        $pdf->MultiCell(40, 4,utf8_decode('TELÉFONO / PHONE'), 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 53);
        $pdf->MultiCell(60, 4,utf8_decode($row['telefono']), 1, 'J', false);

        //CUADRO DE TEXTO (EMPRESA)
        $pdf->SetXY(10, 27);
        $pdf->MultiCell(80, 10,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

        //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
        $pdf->SetXY(10, 44);
        $pdf->MultiCell(80, 13,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

        //CUADRO DE TEXTO (DIRECCIÓN)
        $pdf->SetFont('TIMES','', 7);
        $pdf->SetXY(100, 27);
        $pdf->MultiCell(70, 5,utf8_decode($row['colonia']), 1, 'J', false);
   /* }
}


$pdf = new pdf2();
$pdf->AddPage();*/

$pdf->Ln();
while($fila = $resultado2 -> fetch_array())
	{
        for ($i=1; $i <= $resultado3 ; $i++) { //$resultado3

             if($posicion_MulticeldaIIX >= '200' )
            {
                //Cuadro que encapsula imagen
                $posicion_MulticeldaIFX = 10;
                $posicion_MulticeldaIFY = $posicion_MulticeldaIFY + 47;
                //Imagen a mostrar dentro de cuadro
                $posicion_MulticeldaIIX = 15;
                $posicion_MulticeldaIIY = $posicion_MulticeldaIIY + 47;
                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = $posicion_MulticeldaITY + 47;
            }
            if($posicion_MulticeldaIIY >= '230'){
                $pdf->AddPage();

                $posicion_MulticeldaIFX = 10;
                $posicion_MulticeldaIFY = 60;
                //Imagen a mostrar dentro de cuadro
                $posicion_MulticeldaIIX = 15;
                $posicion_MulticeldaIIY = 63;
                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = 95;

                $pdf->SetFont('Arial','B', 10);
                //Imagen fondo/ marca de agua iniciando en 0, 0
                $pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA.png', 25,80, 170, 130, 'PNG');

                 //Imagen izquierda
                $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10, 'PNG');

                //Texto de Título
                $pdf->SetFont('Times','B', 11);
                $pdf->SetXY(60, 10);
                $pdf->Cell(65, 5, utf8_decode('CATÁLOGO DE CAPACIDADES DE MANUFACTURA'), 0, 'C');
                
                //Texto Explicativo
                $pdf->SetFont('TIMES','', 9);
                $pdf->SetXY(62, 15);
                $pdf->Cell(90, 4, utf8_decode('PROCESOS DE MANUFACTURA / MANUFACTURING PROCESSES'), 0, 'J');
                
                // Número de página 
                $pdf->SetFont('Arial','I',8);
                $pdf->SetXY(171, 8);
                $pdf->Cell(0,10,utf8_decode('Página / Page ').$pdf->PageNo(),0,0,'C');

                //Fecha actual
                $pdf->SetXY(180, 13);
                $pdf->Cell(40,10,date('d/m/Y'),0,1,'L');
                
                //Texto Explicativo 2
                $pdf->SetFont('TIMES','', 9);
                $pdf->SetTextColor(255,255,255);  // Establece el color del texto 
                $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
                $pdf->SetDrawColor(207,207,207,255);
                $pdf->SetXY(10, 23);
                $pdf->MultiCell(80, 4, utf8_decode('EMPRESA / COMPANY'), 1, 'J', true);

                //CAMPO DE DIRECCIÓN
                $pdf->SetXY(100, 23);
                $pdf->MultiCell(70, 4, utf8_decode('DIRECCIÓN / ADDRESS'), 1, 'J', true);

                //LOGO DE LA EMPRESA
                $pdf->SetXY(170, 23);
                $pdf->MultiCell(30, 14,'', 1, 'J', false);
                $pdf->Image('../ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14, 'PNG');

                //ACTIVIDAD PRINCIPAL DE LA EMPRESA
                $pdf->SetXY(10, 40);
                $pdf->MultiCell(80, 4,utf8_decode('ACTIVIDAD PRINCIPAL / MAIN ACTIVITY'), 1, 'J', true);


                //DATOS DE CONTACTO
                $pdf->SetXY(100, 37);
                $pdf->MultiCell(100, 4, utf8_decode('DATOS DE CONTACTO / CONTACT INFORMATION'), 1, 'J', true);

                //SITIO WEB (DATO DE CONTACTO)
                $pdf->SetFont('TIMES','', 8);
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 41);
                $pdf->MultiCell(40, 4,'SITIO WEB / WEB SITE', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 41);
                $pdf->MultiCell(60, 4,utf8_decode($row['sitioWeb']), 1, 'J', false);

                //CORREO/E-MAIL (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 45);
                $pdf->MultiCell(40, 4,'CORREO/E-MAIL', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 45);
                $pdf->MultiCell(60, 4,utf8_decode($row['correo']), 1, 'J', false);

                //NOMBRE DE CONTACTO (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 49);
                $pdf->MultiCell(40, 4,'CONTACTO / CONTACT', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 49);
                $pdf->MultiCell(60, 4,utf8_decode($row['nombre']), 1, 'J', false);

                //TELÉFONO (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 53);
                $pdf->MultiCell(40, 4,utf8_decode('TELÉFONO / PHONE'), 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 53);
                $pdf->MultiCell(60, 4,utf8_decode($row['telefono']), 1, 'J', false);

                //CUADRO DE TEXTO (EMPRESA)
                $pdf->SetXY(10, 27);
                $pdf->MultiCell(80, 10,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

                //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
                $pdf->SetXY(10, 44);
                $pdf->MultiCell(80, 13,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

                //CUADRO DE TEXTO (DIRECCIÓN)
                $pdf->SetFont('TIMES','', 7);
                $pdf->SetXY(100, 27);
                $pdf->MultiCell(70, 5,utf8_decode($row['colonia']), 1, 'J', false);   
            }
             

            //CUADRO PROCESO
            $pdf->SetXY($posicion_MulticeldaIFX, $posicion_MulticeldaIFY);
            $pdf->MultiCell(40, 35,'', 1, 'J', false);
            $pdf->Image('../ImagenesEmpresas/Procesos/'.utf8_decode($fila['imagen']).'', $posicion_MulticeldaIIX, $posicion_MulticeldaIIY, 30, 30);//30.63

            $pdf->SetXY($posicion_MulticeldaITX, $posicion_MulticeldaITY);
           // $pdf->MultiCell(80, 10,'', 1, 'J', false);
            $pdf->MultiCell(40, 5,utf8_decode($fila['nombreProceso']), 0, 'C', false); 
           // $pdf->MultiCell(40, 5,'123456789123456789123456789123456789123456789123456789123456', 1, 'C', false); 
            
            //$posicion_MulticeldaDX = $posicion_MulticeldaDX+10;
            $posicion_MulticeldaIFX = $posicion_MulticeldaIFX+47;
            $posicion_MulticeldaIIX = $posicion_MulticeldaIIX+47;
            $posicion_MulticeldaITX = $posicion_MulticeldaITX+47;
            
            
            
        }
    }



////////IZQUIERDA////////
//Cuadro que encapsula imagen
$posicion_MulticeldaIFX = 10;
$posicion_MulticeldaIFY = 60;
//Imagen a mostrar dentro de cuadro
$posicion_MulticeldaIIX = 15;
$posicion_MulticeldaIIY = 63;
//Texto descriptivo correspondiente al cuadro
$posicion_MulticeldaITX = 10;
$posicion_MulticeldaITY = 95;



//$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B', 10);
//Imagen fondo/ marca de agua iniciando en 0, 0
$pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA.png', 25,80, 170, 130);

/*class pdf2 extends FPDF{ 
        function Hader(){ */
        //IMAGE (RUTA,X,Y,ANCHO,ALTO,EXTEN) 
        //Imagen izquierda
        $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10);

        //Texto de Título
        $pdf->SetFont('Times','B', 11);
        $pdf->SetXY(60, 10);
        $pdf->Cell(65, 5, utf8_decode('CATÁLOGO DE CAPACIDADES DE MANUFACTURA'), 0, 'C');
        
        //Texto Explicativo
        $pdf->SetFont('TIMES','', 9);
        $pdf->SetXY(70, 15);
        $pdf->Cell(90, 4, utf8_decode('PRODUCTOS / SAMPLES PRODUCTS'), 0, 'J');

        // Número de página 
        $pdf->SetFont('Arial','I',8);
        $pdf->SetXY(171, 8);
        $pdf->Cell(0,10,utf8_decode('Página / Page ').$pdf->PageNo(),0,0,'C');

        //Fecha actual
        $pdf->SetXY(180, 13);
        $pdf->Cell(40,10,date('d/m/Y'),0,1,'L');

        //Texto Explicativo 2
        $pdf->SetFont('TIMES','', 9);
        $pdf->SetTextColor(255,255,255);  // Establece el color del texto 
        $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
        $pdf->SetDrawColor(207,207,207,255);
        $pdf->SetXY(10, 23);
        $pdf->MultiCell(80, 4, utf8_decode('EMPRESA / COMPANY'), 1, 'J', true);

        //CAMPO DE DIRECCIÓN
        $pdf->SetXY(100, 23);
        $pdf->MultiCell(70, 4, utf8_decode('DIRECCIÓN / ADDRESS'), 1, 'J', true);

        //LOGO DE LA EMPRESA
        $pdf->SetXY(170, 23);
        $pdf->MultiCell(30, 14,'', 1, 'J', false);
        $pdf->Image('../ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

        //ACTIVIDAD PRINCIPAL DE LA EMPRESA
        $pdf->SetXY(10, 40);
        $pdf->MultiCell(80, 4,utf8_decode('ACTIVIDAD PRINCIPAL / MAIN ACTIVITY'), 1, 'J', true);


        //DATOS DE CONTACTO
        $pdf->SetXY(100, 37);
        $pdf->MultiCell(100, 4, utf8_decode('DATOS DE CONTACTO / CONTACT INFORMATION'), 1, 'J', true);

        //SITIO WEB (DATO DE CONTACTO)
        $pdf->SetFont('TIMES','', 8);
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 41);
        $pdf->MultiCell(40, 4,'SITIO WEB / WEB SITE', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 41);
        $pdf->MultiCell(60, 4,utf8_decode($row['sitioWeb']), 1, 'J', false);

        //CORREO/E-MAIL (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 45);
        $pdf->MultiCell(40, 4,'CORREO/E-MAIL', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 45);
        $pdf->MultiCell(60, 4,utf8_decode($row['correo']), 1, 'J', false);

        //NOMBRE DE CONTACTO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 49);
        $pdf->MultiCell(40, 4,'CONTACTO / CONTACT', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 49);
        $pdf->MultiCell(60, 4,utf8_decode($row['nombre']), 1, 'J', false);

        //TELÉFONO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 53);
        $pdf->MultiCell(40, 4,utf8_decode('TELÉFONO / PHONE'), 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 53);
        $pdf->MultiCell(60, 4,utf8_decode($row['telefono']), 1, 'J', false);

        //CUADRO DE TEXTO (EMPRESA)
        $pdf->SetXY(10, 27);
        $pdf->MultiCell(80, 10,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

        //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
        $pdf->SetXY(10, 44);
        $pdf->MultiCell(80, 13,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

        //CUADRO DE TEXTO (DIRECCIÓN)
        $pdf->SetFont('TIMES','', 7);
        $pdf->SetXY(100, 27);
        $pdf->MultiCell(70, 5,utf8_decode($row['colonia']), 1, 'J', false);
   /* }
}


$pdf = new pdf2();
$pdf->AddPage();*/

$pdf->Ln();
while($fila = $resultado4 -> fetch_array())
    {
        for ($i=1; $i <= $resultado5 ; $i++) { //$resultado5

             if($posicion_MulticeldaIIX >= '200' )
            {
                //Cuadro que encapsula imagen
                $posicion_MulticeldaIFX = 10;
                $posicion_MulticeldaIFY = $posicion_MulticeldaIFY + 47;
                //Imagen a mostrar dentro de cuadro
                $posicion_MulticeldaIIX = 15;
                $posicion_MulticeldaIIY = $posicion_MulticeldaIIY + 47;
                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = $posicion_MulticeldaITY + 47;
            }
            if($posicion_MulticeldaIIY >= '200'){
                $pdf->AddPage();

                $posicion_MulticeldaIFX = 10;
                $posicion_MulticeldaIFY = 60;
                //Imagen a mostrar dentro de cuadro
                $posicion_MulticeldaIIX = 15;
                $posicion_MulticeldaIIY = 63;
                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = 95;

                $pdf->SetFont('Arial','B', 10);
                //Imagen fondo/ marca de agua iniciando en 0, 0
                $pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA.png', 25,80, 170, 130);

                 //Imagen izquierda
                $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10);

                //Texto de Título
                $pdf->SetFont('Times','B', 11);
                $pdf->SetXY(60, 10);
                $pdf->Cell(65, 5, utf8_decode('CATÁLOGO DE CAPACIDADES DE MANUFACTURA'), 0, 'C');
                
                //Texto Explicativo
                $pdf->SetFont('TIMES','', 9);
                $pdf->SetXY(62, 15);
                $pdf->Cell(90, 4, utf8_decode('PRODUCTOS / SAMPLES PRODUCTS'), 0, 'J');
                
                // Número de página 
                $pdf->SetFont('Arial','I',8);
                $pdf->SetXY(171, 8);
                $pdf->Cell(0,10,utf8_decode('Página / Page ').$pdf->PageNo(),0,0,'C');

                //Fecha actual
                $pdf->SetXY(180, 13);
                $pdf->Cell(40,10,date('d/m/Y'),0,1,'L');
                
                //Texto Explicativo 2
                $pdf->SetFont('TIMES','', 9);
                $pdf->SetTextColor(255,255,255);  // Establece el color del texto 
                $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
                $pdf->SetDrawColor(207,207,207,255);
                $pdf->SetXY(10, 23);
                $pdf->MultiCell(80, 4, utf8_decode('EMPRESA / COMPANY'), 1, 'J', true);

                //CAMPO DE DIRECCIÓN
                $pdf->SetXY(100, 23);
                $pdf->MultiCell(70, 4, utf8_decode('DIRECCIÓN / ADDRESS'), 1, 'J', true);

                //LOGO DE LA EMPRESA
                $pdf->SetXY(170, 23);
                $pdf->MultiCell(30, 14,'', 1, 'J', false);
                $pdf->Image('../ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

                //ACTIVIDAD PRINCIPAL DE LA EMPRESA
                $pdf->SetXY(10, 40);
                $pdf->MultiCell(80, 4,utf8_decode('ACTIVIDAD PRINCIPAL / MAIN ACTIVITY'), 1, 'J', true);


                //DATOS DE CONTACTO
                $pdf->SetXY(100, 37);
                $pdf->MultiCell(100, 4, utf8_decode('DATOS DE CONTACTO / CONTACT INFORMATION'), 1, 'J', true);

                //SITIO WEB (DATO DE CONTACTO)
                $pdf->SetFont('TIMES','', 8);
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 41);
                $pdf->MultiCell(40, 4,'SITIO WEB / WEB SITE', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 41);
                $pdf->MultiCell(60, 4,utf8_decode($row['sitioWeb']), 1, 'J', false);

                //CORREO/E-MAIL (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 45);
                $pdf->MultiCell(40, 4,'CORREO/E-MAIL', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 45);
                $pdf->MultiCell(60, 4,utf8_decode($row['correo']), 1, 'J', false);

                //NOMBRE DE CONTACTO (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 49);
                $pdf->MultiCell(40, 4,'CONTACTO / CONTACT', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 49);
                $pdf->MultiCell(60, 4,utf8_decode($row['nombre']), 1, 'J', false);

                //TELÉFONO (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 53);
                $pdf->MultiCell(40, 4,utf8_decode('TELÉFONO / PHONE'), 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 53);
                $pdf->MultiCell(60, 4,utf8_decode($row['telefono']), 1, 'J', false);

                //CUADRO DE TEXTO (EMPRESA)
                $pdf->SetXY(10, 27);
                $pdf->MultiCell(80, 10,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

                //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
                $pdf->SetXY(10, 44);
                $pdf->MultiCell(80, 13,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

                //CUADRO DE TEXTO (DIRECCIÓN)
                $pdf->SetFont('TIMES','', 7);
                $pdf->SetXY(100, 27);
                $pdf->MultiCell(70, 5,utf8_decode($row['colonia']), 1, 'J', false);   
            }
             

            //CUADRO PROCESO
            $pdf->SetXY($posicion_MulticeldaIFX, $posicion_MulticeldaIFY);
            $pdf->MultiCell(40, 35,'', 1, 'J', false);
            $pdf->Image('../ImagenesEmpresas/Productos/'.utf8_decode($fila['imagen']).'', $posicion_MulticeldaIIX, $posicion_MulticeldaIIY, 30, 30);//30.63

            $pdf->SetXY($posicion_MulticeldaITX, $posicion_MulticeldaITY);
           // $pdf->MultiCell(80, 10,'', 1, 'J', false);
            $pdf->MultiCell(40, 5,utf8_decode($fila['descripcion']), 1, 'C', false); 
          //  $pdf->MultiCell(40, 5,'123456789123456789123456789123456789123456789123456789123456', 1, 'C', false); 
            
            //$posicion_MulticeldaDX = $posicion_MulticeldaDX+10;
            $posicion_MulticeldaIFX = $posicion_MulticeldaIFX+47;
            $posicion_MulticeldaIIX = $posicion_MulticeldaIIX+47;
            $posicion_MulticeldaITX = $posicion_MulticeldaITX+47;
            
            
            
        }
    }


////////IZQUIERDA////////
//Cuadro que encapsula imagen
$posicion_MulticeldaIFX = 10;
$posicion_MulticeldaIFY = 60;
//Imagen a mostrar dentro de cuadro
$posicion_MulticeldaIIX = 15;
$posicion_MulticeldaIIY = 63;
//Texto descriptivo correspondiente al cuadro
$posicion_MulticeldaITX = 10;
$posicion_MulticeldaITY = 95;


$pdf->AddPage();
$pdf->SetFont('Arial','B', 10);
//Imagen fondo/ marca de agua iniciando en 0, 0
$pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA.png', 25,80, 170, 130);

/*class pdf2 extends FPDF{ 
        function Hader(){ */
        //IMAGE (RUTA,X,Y,ANCHO,ALTO,EXTEN) 
        //Imagen izquierda
        $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10);

        //Texto de Título
        $pdf->SetFont('Times','B', 11);
        $pdf->SetXY(60, 10);
        $pdf->Cell(65, 5, utf8_decode('CATÁLOGO DE CAPACIDADES DE MANUFACTURA'), 0, 'C');
        
        //Texto Explicativo
        $pdf->SetFont('TIMES','', 9);
        $pdf->SetXY(85, 15);
        $pdf->Cell(90, 4, utf8_decode('CLIENTES / CUSTOMERS'), 0, 'J');

        // Número de página 
        $pdf->SetFont('Arial','I',8);
        $pdf->SetXY(171, 8);
        $pdf->Cell(0,10,utf8_decode('Página / Page ').$pdf->PageNo(),0,0,'C');

        //Fecha actual
        $pdf->SetXY(180, 13);
        $pdf->Cell(40,10,date('d/m/Y'),0,1,'L');

        //Texto Explicativo 2
        $pdf->SetFont('TIMES','', 9);
        $pdf->SetTextColor(255,255,255);  // Establece el color del texto 
        $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
        $pdf->SetDrawColor(207,207,207,255);
        $pdf->SetXY(10, 23);
        $pdf->MultiCell(80, 4, utf8_decode('EMPRESA / COMPANY'), 1, 'J', true);

        //CAMPO DE DIRECCIÓN
        $pdf->SetXY(100, 23);
        $pdf->MultiCell(70, 4, utf8_decode('DIRECCIÓN / ADDRESS'), 1, 'J', true);

        //LOGO DE LA EMPRESA
        $pdf->SetXY(170, 23);
        $pdf->MultiCell(30, 14,'', 1, 'J', false);
        $pdf->Image('../ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

        //ACTIVIDAD PRINCIPAL DE LA EMPRESA
        $pdf->SetXY(10, 40);
        $pdf->MultiCell(80, 4,utf8_decode('ACTIVIDAD PRINCIPAL / MAIN ACTIVITY'), 1, 'J', true);


        //DATOS DE CONTACTO
        $pdf->SetXY(100, 37);
        $pdf->MultiCell(100, 4, utf8_decode('DATOS DE CONTACTO / CONTACT INFORMATION'), 1, 'J', true);

        //SITIO WEB (DATO DE CONTACTO)
        $pdf->SetFont('TIMES','', 8);
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 41);
        $pdf->MultiCell(40, 4,'SITIO WEB / WEB SITE', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 41);
        $pdf->MultiCell(60, 4,utf8_decode($row['sitioWeb']), 1, 'J', false);

        //CORREO/E-MAIL (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 45);
        $pdf->MultiCell(40, 4,'CORREO/E-MAIL', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 45);
        $pdf->MultiCell(60, 4,utf8_decode($row['correo']), 1, 'J', false);

        //NOMBRE DE CONTACTO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 49);
        $pdf->MultiCell(40, 4,'CONTACTO / CONTACT', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 49);
        $pdf->MultiCell(60, 4,utf8_decode($row['nombre']), 1, 'J', false);

        //TELÉFONO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 53);
        $pdf->MultiCell(40, 4,utf8_decode('TELÉFONO / PHONE'), 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 53);
        $pdf->MultiCell(60, 4,utf8_decode($row['telefono']), 1, 'J', false);

        //CUADRO DE TEXTO (EMPRESA)
        $pdf->SetXY(10, 27);
        $pdf->MultiCell(80, 10,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

        //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
        $pdf->SetXY(10, 44);
        $pdf->MultiCell(80, 13,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

        //CUADRO DE TEXTO (DIRECCIÓN)
        $pdf->SetFont('TIMES','', 7);
        $pdf->SetXY(100, 27);
        $pdf->MultiCell(70, 5,utf8_decode($row['colonia']), 1, 'J', false);
   /* }
}


$pdf = new pdf2();
$pdf->AddPage();*/

$pdf->Ln();
while($fila = $resultado6 -> fetch_array())
    {
        for ($i=1; $i <= $resultado7 ; $i++) { //$resultado7

             if($posicion_MulticeldaIIX >= '200' )
            {
                //Cuadro que encapsula imagen
                $posicion_MulticeldaIFX = 10;
                $posicion_MulticeldaIFY = $posicion_MulticeldaIFY + 47;
                //Imagen a mostrar dentro de cuadro
                $posicion_MulticeldaIIX = 15;
                $posicion_MulticeldaIIY = $posicion_MulticeldaIIY + 47;
                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = $posicion_MulticeldaITY + 47;
            }
            if($posicion_MulticeldaIIY >= '200'){
                $pdf->AddPage();

                $posicion_MulticeldaIFX = 10;
                $posicion_MulticeldaIFY = 60;
                //Imagen a mostrar dentro de cuadro
                $posicion_MulticeldaIIX = 15;
                $posicion_MulticeldaIIY = 63;
                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = 95;

                $pdf->SetFont('Arial','B', 10);
                //Imagen fondo/ marca de agua iniciando en 0, 0
                $pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA.png', 25,80, 170, 130);

                 //Imagen izquierda
                $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10);

                //Texto de Título
                $pdf->SetFont('Times','B', 11);
                $pdf->SetXY(60, 10);
                $pdf->Cell(65, 5, utf8_decode('CATÁLOGO DE CAPACIDADES DE MANUFACTURA'), 0, 'C');
                
                //Texto Explicativo
                $pdf->SetFont('TIMES','', 9);
                $pdf->SetXY(62, 15);
                $pdf->Cell(90, 4, utf8_decode('CLIENTES / CUSTOMERS'), 0, 'J');

                // Número de página 
                $pdf->SetFont('Arial','I',8);
                $pdf->SetXY(171, 8);
                $pdf->Cell(0,10,utf8_decode('Página / Page ').$pdf->PageNo(),0,0,'C');

                //Fecha actual
                $pdf->SetXY(180, 13);
                $pdf->Cell(40,10,date('d/m/Y'),0,1,'L');

                //Texto Explicativo 2
                $pdf->SetFont('TIMES','', 9);
                $pdf->SetTextColor(255,255,255);  // Establece el color del texto 
                $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
                $pdf->SetDrawColor(207,207,207,255);
                $pdf->SetXY(10, 23);
                $pdf->MultiCell(80, 4, utf8_decode('EMPRESA / COMPANY'), 1, 'J', true);

                //CAMPO DE DIRECCIÓN
                $pdf->SetXY(100, 23);
                $pdf->MultiCell(70, 4, utf8_decode('DIRECCIÓN / ADDRESS'), 1, 'J', true);

                //LOGO DE LA EMPRESA
                $pdf->SetXY(170, 23);
                $pdf->MultiCell(30, 14,'', 1, 'J', false);
                $pdf->Image('../ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

                //ACTIVIDAD PRINCIPAL DE LA EMPRESA
                $pdf->SetXY(10, 40);
                $pdf->MultiCell(80, 4,utf8_decode('ACTIVIDAD PRINCIPAL / MAIN ACTIVITY'), 1, 'J', true);


                //DATOS DE CONTACTO
                $pdf->SetXY(100, 37);
                $pdf->MultiCell(100, 4, utf8_decode('DATOS DE CONTACTO / CONTACT INFORMATION'), 1, 'J', true);

                //SITIO WEB (DATO DE CONTACTO)
                $pdf->SetFont('TIMES','', 8);
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 41);
                $pdf->MultiCell(40, 4,'SITIO WEB / WEB SITE', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 41);
                $pdf->MultiCell(60, 4,utf8_decode($row['sitioWeb']), 1, 'J', false);

                //CORREO/E-MAIL (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 45);
                $pdf->MultiCell(40, 4,'CORREO/E-MAIL', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 45);
                $pdf->MultiCell(60, 4,utf8_decode($row['correo']), 1, 'J', false);

                //NOMBRE DE CONTACTO (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 49);
                $pdf->MultiCell(40, 4,'CONTACTO / CONTACT', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 49);
                $pdf->MultiCell(60, 4,utf8_decode($row['nombre']), 1, 'J', false);

                //TELÉFONO (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 53);
                $pdf->MultiCell(40, 4,utf8_decode('TELÉFONO / PHONE'), 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 53);
                $pdf->MultiCell(60, 4,utf8_decode($row['telefono']), 1, 'J', false);

                //CUADRO DE TEXTO (EMPRESA)
                $pdf->SetXY(10, 27);
                $pdf->MultiCell(80, 10,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

                //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
                $pdf->SetXY(10, 44);
                $pdf->MultiCell(80, 13,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

                //CUADRO DE TEXTO (DIRECCIÓN)
                $pdf->SetFont('TIMES','', 7);
                $pdf->SetXY(100, 27);
                $pdf->MultiCell(70, 5,utf8_decode($row['colonia']), 1, 'J', false);   
            }
             

            //CUADRO PROCESO
            $pdf->SetXY($posicion_MulticeldaIFX, $posicion_MulticeldaIFY);
            $pdf->MultiCell(40, 35,'', 1, 'J', false);
            $pdf->Image('../ImagenesEmpresas/Clientes/'.utf8_decode($fila['logo']).'', $posicion_MulticeldaIIX, $posicion_MulticeldaIIY, 30, 30);//30.63

            $pdf->SetXY($posicion_MulticeldaITX, $posicion_MulticeldaITY);
           // $pdf->MultiCell(80, 10,'', 1, 'J', false);
            $pdf->MultiCell(40, 5,utf8_decode($fila['nombre']), 1, 'C', false); 
           // $pdf->MultiCell(40, 5,'123456789123456789123456789123456789123456789123456789123456', 1, 'C', false); 
            
            //$posicion_MulticeldaDX = $posicion_MulticeldaDX+10;
            $posicion_MulticeldaIFX = $posicion_MulticeldaIFX+47;
            $posicion_MulticeldaIIX = $posicion_MulticeldaIIX+47;
            $posicion_MulticeldaITX = $posicion_MulticeldaITX+47;
            
            
            
        }
    }

////////IZQUIERDA////////
//Cuadro que encapsula imagen
$posicion_MulticeldaIFX = 10;
$posicion_MulticeldaIFY = 60;
//Imagen a mostrar dentro de cuadro
$posicion_MulticeldaIIX = 15;
$posicion_MulticeldaIIY = 63;
//Texto descriptivo correspondiente al cuadro
$posicion_MulticeldaITX = 10;
$posicion_MulticeldaITY = 95;

$pdf->AddPage();
$pdf->SetFont('Arial','B', 10);
//Imagen fondo/ marca de agua iniciando en 0, 0
$pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA.png', 25,80, 170, 130);

/*class pdf2 extends FPDF{ 
        function Hader(){ */
        //IMAGE (RUTA,X,Y,ANCHO,ALTO,EXTEN) 
        //Imagen izquierda
        $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10);

        //Texto de Título
        $pdf->SetFont('Times','B', 11);
        $pdf->SetXY(60, 10);
        $pdf->Cell(65, 5, utf8_decode('CATÁLOGO DE CAPACIDADES DE MANUFACTURA'), 0, 'C');
        
        //Texto Explicativo
        $pdf->SetFont('TIMES','', 9);
        $pdf->SetXY(82, 15);
        $pdf->Cell(90, 4, utf8_decode('CERTIFICACIONES / CERTIFICATIONS'), 0, 'J');

        // Número de página 
        $pdf->SetFont('Arial','I',8);
        $pdf->SetXY(171, 8);
        $pdf->Cell(0,10,utf8_decode('Página / Page ').$pdf->PageNo(),0,0,'C');

        //Fecha actual
        $pdf->SetXY(180, 13);
        $pdf->Cell(40,10,date('d/m/Y'),0,1,'L');

        //Texto Explicativo 2
        $pdf->SetFont('TIMES','', 9);
        $pdf->SetTextColor(255,255,255);  // Establece el color del texto 
        $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
        $pdf->SetDrawColor(207,207,207,255);
        $pdf->SetXY(10, 23);
        $pdf->MultiCell(80, 4, utf8_decode('EMPRESA / COMPANY'), 1, 'J', true);

        //CAMPO DE DIRECCIÓN
        $pdf->SetXY(100, 23);
        $pdf->MultiCell(70, 4, utf8_decode('DIRECCIÓN / ADDRESS'), 1, 'J', true);

        //LOGO DE LA EMPRESA
        $pdf->SetXY(170, 23);
        $pdf->MultiCell(30, 14,'', 1, 'J', false);
        $pdf->Image('../ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

        //ACTIVIDAD PRINCIPAL DE LA EMPRESA
        $pdf->SetXY(10, 40);
        $pdf->MultiCell(80, 4,utf8_decode('ACTIVIDAD PRINCIPAL / MAIN ACTIVITY'), 1, 'J', true);


        //DATOS DE CONTACTO
        $pdf->SetXY(100, 37);
        $pdf->MultiCell(100, 4, utf8_decode('DATOS DE CONTACTO / CONTACT INFORMATION'), 1, 'J', true);

        //SITIO WEB (DATO DE CONTACTO)
        $pdf->SetFont('TIMES','', 8);
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 41);
        $pdf->MultiCell(40, 4,'SITIO WEB / WEB SITE', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 41);
        $pdf->MultiCell(60, 4,utf8_decode($row['sitioWeb']), 1, 'J', false);

        //CORREO/E-MAIL (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 45);
        $pdf->MultiCell(40, 4,'CORREO/E-MAIL', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 45);
        $pdf->MultiCell(60, 4,utf8_decode($row['correo']), 1, 'J', false);

        //NOMBRE DE CONTACTO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 49);
        $pdf->MultiCell(40, 4,'CONTACTO / CONTACT', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 49);
        $pdf->MultiCell(60, 4,utf8_decode($row['nombre']), 1, 'J', false);

        //TELÉFONO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 53);
        $pdf->MultiCell(40, 4,utf8_decode('TELÉFONO / PHONE'), 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 53);
        $pdf->MultiCell(60, 4,utf8_decode($row['telefono']), 1, 'J', false);

        //CUADRO DE TEXTO (EMPRESA)
        $pdf->SetXY(10, 27);
        $pdf->MultiCell(80, 10,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

        //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
        $pdf->SetXY(10, 44);
        $pdf->MultiCell(80, 13,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

        //CUADRO DE TEXTO (DIRECCIÓN)
        $pdf->SetFont('TIMES','', 7);
        $pdf->SetXY(100, 27);
        $pdf->MultiCell(70, 5,utf8_decode($row['colonia']), 1, 'J', false);
   /* }
}


$pdf = new pdf2();
$pdf->AddPage();*/

$pdf->Ln();
while($fila = $resultado8 -> fetch_array())
    {
        for ($i=1; $i <= $resultado9 ; $i++) { //$resultado9

             if($posicion_MulticeldaIIX >= '200' )
            {
                //Cuadro que encapsula imagen
                $posicion_MulticeldaIFX = 10;
                $posicion_MulticeldaIFY = $posicion_MulticeldaIFY + 47;
                //Imagen a mostrar dentro de cuadro
                $posicion_MulticeldaIIX = 15;
                $posicion_MulticeldaIIY = $posicion_MulticeldaIIY + 47;
                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = $posicion_MulticeldaITY + 47;
            }
            if($posicion_MulticeldaIIY >= '200'){
                $pdf->AddPage();

                $posicion_MulticeldaIFX = 10;
                $posicion_MulticeldaIFY = 60;
                //Imagen a mostrar dentro de cuadro
                $posicion_MulticeldaIIX = 15;
                $posicion_MulticeldaIIY = 63;
                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = 95;

                $pdf->SetFont('Arial','B', 10);
                //Imagen fondo/ marca de agua iniciando en 0, 0
                $pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA.png', 25,80, 170, 130);

                 //Imagen izquierda
                $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10);

                //Texto de Título
                $pdf->SetFont('Times','B', 11);
                $pdf->SetXY(60, 10);
                $pdf->Cell(65, 5, utf8_decode('CATÁLOGO DE CAPACIDADES DE MANUFACTURA'), 0, 'C');
                
                //Texto Explicativo
                $pdf->SetFont('TIMES','', 9);
                $pdf->SetXY(62, 15);
                $pdf->Cell(90, 4, utf8_decode('CERTIFICACIONES / CERTIFICATIONS'), 0, 'J');
                
                // Número de página 
                $pdf->SetFont('Arial','I',8);
                $pdf->SetXY(171, 8);
                $pdf->Cell(0,10,utf8_decode('Página / Page ').$pdf->PageNo(),0,0,'C');

                //Fecha actual
                $pdf->SetXY(180, 13);
                $pdf->Cell(40,10,date('d/m/Y'),0,1,'L');

                //Texto Explicativo 2
                $pdf->SetFont('TIMES','', 9);
                $pdf->SetTextColor(255,255,255);  // Establece el color del texto 
                $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
                $pdf->SetDrawColor(207,207,207,255);
                $pdf->SetXY(10, 23);
                $pdf->MultiCell(80, 4, utf8_decode('EMPRESA / COMPANY'), 1, 'J', true);

                //CAMPO DE DIRECCIÓN
                $pdf->SetXY(100, 23);
                $pdf->MultiCell(70, 4, utf8_decode('DIRECCIÓN / ADDRESS'), 1, 'J', true);

                //LOGO DE LA EMPRESA
                $pdf->SetXY(170, 23);
                $pdf->MultiCell(30, 14,'', 1, 'J', false);
                $pdf->Image('../ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

                //ACTIVIDAD PRINCIPAL DE LA EMPRESA
                $pdf->SetXY(10, 40);
                $pdf->MultiCell(80, 4,utf8_decode('ACTIVIDAD PRINCIPAL / MAIN ACTIVITY'), 1, 'J', true);


                //DATOS DE CONTACTO
                $pdf->SetXY(100, 37);
                $pdf->MultiCell(100, 4, utf8_decode('DATOS DE CONTACTO / CONTACT INFORMATION'), 1, 'J', true);

                //SITIO WEB (DATO DE CONTACTO)
                $pdf->SetFont('TIMES','', 8);
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 41);
                $pdf->MultiCell(40, 4,'SITIO WEB / WEB SITE', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 41);
                $pdf->MultiCell(60, 4,utf8_decode($row['sitioWeb']), 1, 'J', false);

                //CORREO/E-MAIL (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 45);
                $pdf->MultiCell(40, 4,'CORREO/E-MAIL', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 45);
                $pdf->MultiCell(60, 4,utf8_decode($row['correo']), 1, 'J', false);

                //NOMBRE DE CONTACTO (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 49);
                $pdf->MultiCell(40, 4,'CONTACTO / CONTACT', 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 49);
                $pdf->MultiCell(60, 4,utf8_decode($row['nombre']), 1, 'J', false);

                //TELÉFONO (DATO DE CONTACTO)
                $pdf->SetTextColor(0,0,0,255);
                $pdf->SetXY(100, 53);
                $pdf->MultiCell(40, 4,utf8_decode('TELÉFONO / PHONE'), 1, 'J', false);
                //CUADRO DE TEXTO
                $pdf->SetXY(140, 53);
                $pdf->MultiCell(60, 4,utf8_decode($row['telefono']), 1, 'J', false);

                //CUADRO DE TEXTO (EMPRESA)
                $pdf->SetXY(10, 27);
                $pdf->MultiCell(80, 10,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

                //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
                $pdf->SetXY(10, 44);
                $pdf->MultiCell(80, 13,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

                //CUADRO DE TEXTO (DIRECCIÓN)
                $pdf->SetFont('TIMES','', 7);
                $pdf->SetXY(100, 27);
                $pdf->MultiCell(70, 5,utf8_decode($row['colonia']), 1, 'J', false);   
            }
             

            //CUADRO PROCESO
            $pdf->SetXY($posicion_MulticeldaIFX, $posicion_MulticeldaIFY);
            $pdf->MultiCell(40, 35,'', 1, 'J', false);
            $pdf->Image('../ImagenesEmpresas/Certificaciones/'.utf8_decode($fila['imagen']).'', $posicion_MulticeldaIIX, $posicion_MulticeldaIIY, 30, 30);//30.63

            $pdf->SetXY($posicion_MulticeldaITX, $posicion_MulticeldaITY);
           // $pdf->MultiCell(80, 10,'', 1, 'J', false);
            $pdf->MultiCell(40, 5,utf8_decode($fila['nombre']), 1, 'C', false); 
           // $pdf->MultiCell(40, 5,'123456789123456789123456789123456789123456789123456789123456', 1, 'C', false); 
            
            //$posicion_MulticeldaDX = $posicion_MulticeldaDX+10;
            $posicion_MulticeldaIFX = $posicion_MulticeldaIFX+47;
            $posicion_MulticeldaIIX = $posicion_MulticeldaIIX+47;
            $posicion_MulticeldaITX = $posicion_MulticeldaITX+47;
            
            
            
        }
    }


}




$pdf->Output('ArchivosSocios/CATÁLOGO_CAPACIDADES_EMPRESA_CORTO.pdf','F');
$response['status']  = 'success';
//$response['message'] = 'Correo enviado correctamente!';  
echo json_encode($response);
}
 
?>