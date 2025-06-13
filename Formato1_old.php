<?php
session_start();
include 'conexion.php';

$id = $_POST["id"];


include_once('PDF.php');
//require "fpdf/fpdf.php";
$query = "SELECT * FROM Empresa WHERE idEmpresa = $id";
$resultado = $pdo->prepare($query);    

//-----------------------Proceso---------------------------
$query2 = "SELECT * FROM Proceso WHERE idEmpresa = $id";
$resultado2 = $pdo->prepare($query2); 

$query3 = "SELECT COUNT(*) FROM Proceso WHERE idEmpresa = $id";
$resultado3 = $pdo->prepare($query3);

//-----------------------Producto--------------------------
$query4 = "SELECT * FROM Producto WHERE idEmpresa = $id";
$resultado4 = $pdo->prepare($query4); 

$query5 = "SELECT COUNT(*) FROM Producto WHERE idEmpresa = $id";
$resultado5 = $pdo->prepare($query5);

//-----------------------Cliente---------------------------
$query6 = "SELECT * FROM Cliente WHERE idEmpresa = $id";
$resultado6 = $pdo->prepare($query6); 

$query7 = "SELECT COUNT(*) FROM Cliente WHERE idEmpresa = $id";
$resultado7 = $pdo->prepare($query7);

//-----------------------Certificación---------------------
$query8 = "SELECT * FROM Certificacion WHERE idEmpresa = $id";
$resultado8 = $pdo->prepare($query8); 

$query9 = "SELECT COUNT(*) FROM Certificacion WHERE idEmpresa = $id";
$resultado9 = $pdo->prepare($query9);



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

////////DERECHA////////
//Cuadro que encapsula imagen
//$posicion_MulticeldaIFX = 10;
//$posicion_MulticeldaIFY = 60;
//Imagen a mostrar dentro de cuadro
//$posicion_MulticeldaIIX = 30;
//$posicion_MulticeldaIIY = 63;
//Texto descriptivo correspondiente al cuadro
//$posicion_MulticeldaITX = 0;
//$posicion_MulticeldaITY = 0;

//NUEVAS VARIABLES PARA FORMATO

//Imagen 
$posicion_MulticeldaIIX =40;
$posicion_MulticeldaIIY =63;

//Número de proceso
$posicion_MulticeldaIPX =10;
$posicion_MulticeldaIPY =85;
$posicion_MulticeldaIPTX =45;
$posicion_MulticeldaIPTY =85;

//Nombre del proceso
$posicion_MulticeldaIPNX =10;
$posicion_MulticeldaIPNY =91;
$posicion_MulticeldaIPRTX =45;
$posicion_MulticeldaIPRTY =91;
$posicion_MulticeldaIPCX =45;
$posicion_MulticeldaIPCY =91;

//Descripción
$posicion_MulticeldaIDX =10;
$posicion_MulticeldaIDY =97;
$posicion_MulticeldaIDTX =45;
$posicion_MulticeldaIDTY =97;
$posicion_MulticeldaIDCX =45;
$posicion_MulticeldaIDCY =97;

//Cantidad equipo
$posicion_MulticeldaICEX =10;
$posicion_MulticeldaICEY =103;
$posicion_MulticeldaICETX =45;
$posicion_MulticeldaICETY =103;
$posicion_MulticeldaICECX =45;
$posicion_MulticeldaICECY =103;

//Capacidad Kg
$posicion_MulticeldaICX =10;
$posicion_MulticeldaICY =109;
$posicion_MulticeldaICTX =45;
$posicion_MulticeldaICTY =109;
$posicion_MulticeldaICCX =45;
$posicion_MulticeldaICCY =109;

//Operadores
$posicion_MulticeldaIOX = 53;
$posicion_MulticeldaIOY = 85;
$posicion_MulticeldaIOTX = 88;
$posicion_MulticeldaIOTY = 85;
$posicion_MulticeldaIOCX = 45;
$posicion_MulticeldaIOCY = 85;



if($resultado)
{
while($row = $resultado -> fetch_array()){

$pdf = new PDF();
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
        $pdf->Image('ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

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
                $posicion_MulticeldaIFY = $posicion_MulticeldaIFY + 62;
                //Imagen a mostrar dentro de cuadro
                $posicion_MulticeldaIIX = 15;
                $posicion_MulticeldaIIY = $posicion_MulticeldaIIY + 62;
                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = $posicion_MulticeldaITY + 62;

                //NUEVAS VARIABLES PARA FORMATO

                //Imagen 
                $posicion_MulticeldaIIX =40;
                $posicion_MulticeldaIIY = $posicion_MulticeldaIIY;

                //Número de proceso
                $posicion_MulticeldaIPX =10;
                $posicion_MulticeldaIPY = $posicion_MulticeldaIPY + 62;
                $posicion_MulticeldaIPTX =45;
                $posicion_MulticeldaIPTY = $posicion_MulticeldaIPTY + 62;

                //Nombre del proceso
                $posicion_MulticeldaIPNX =10;
                $posicion_MulticeldaIPNY = $posicion_MulticeldaIPNY + 62;//91
                $posicion_MulticeldaIPRTX =45;
                $posicion_MulticeldaIPRTY = $posicion_MulticeldaIPRTY + 62;
                $posicion_MulticeldaIPCX =45;
                $posicion_MulticeldaIPCY = $posicion_MulticeldaIPCY + 62;

                //Descripción
                $posicion_MulticeldaIDX =10;
                $posicion_MulticeldaIDY = $posicion_MulticeldaIDY + 62;//97
                $posicion_MulticeldaIDTX =45;
                $posicion_MulticeldaIDTY = $posicion_MulticeldaIDTY + 62;
                $posicion_MulticeldaIDCX =45;
                $posicion_MulticeldaIDCY = $posicion_MulticeldaIDCY + 62;

                //Cantidad equipo
                $posicion_MulticeldaICEX =10;
                $posicion_MulticeldaICEY = $posicion_MulticeldaICEY + 62;//103
                $posicion_MulticeldaICETX =45;
                $posicion_MulticeldaICETY = $posicion_MulticeldaICETY + 62;
                $posicion_MulticeldaICECX =45;
                $posicion_MulticeldaICECY = $posicion_MulticeldaICECY + 62;

                //Capacidad Kg
                $posicion_MulticeldaICX =10;
                $posicion_MulticeldaICY = $posicion_MulticeldaICY + 62;//109
                $posicion_MulticeldaICTX =45;
                $posicion_MulticeldaICTY = $posicion_MulticeldaICTY + 62;
                $posicion_MulticeldaICCX =45;
                $posicion_MulticeldaICCY = $posicion_MulticeldaICCY + 62;

                //Operadores
                $posicion_MulticeldaIOX = 53;
                $posicion_MulticeldaIOY = $posicion_MulticeldaIOY + 62;//85
                $posicion_MulticeldaIOTX = 88;
                $posicion_MulticeldaIOTY = $posicion_MulticeldaIOTY + 62;
                $posicion_MulticeldaIOCX = 45;
                $posicion_MulticeldaIOCY = $posicion_MulticeldaIOCY + 62;

                

            }
            if($posicion_MulticeldaIIY >= '230'){
                $pdf->AddPage();

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


                //NUEVAS VARIABLES PARA FORMATO

                //Imagen 
                $posicion_MulticeldaIIX =40;
                $posicion_MulticeldaIIY =63;

                //Número de proceso
                $posicion_MulticeldaIPX =10;
                $posicion_MulticeldaIPY =85;
                $posicion_MulticeldaIPTX =45;
                $posicion_MulticeldaIPTY =85;

                //Nombre del proceso
                $posicion_MulticeldaIPNX =10;
                $posicion_MulticeldaIPNY =91;
                $posicion_MulticeldaIPRTX =45;
                $posicion_MulticeldaIPRTY =91;
                $posicion_MulticeldaIPCX =45;
                $posicion_MulticeldaIPCY =91;

                //Descripción
                $posicion_MulticeldaIDX =10;
                $posicion_MulticeldaIDY =97;
                $posicion_MulticeldaIDTX =45;
                $posicion_MulticeldaIDTY =97;
                $posicion_MulticeldaIDCX =45;
                $posicion_MulticeldaIDCY =97;

                //Cantidad equipo
                $posicion_MulticeldaICEX =10;
                $posicion_MulticeldaICEY =103;
                $posicion_MulticeldaICETX =45;
                $posicion_MulticeldaICETY =103;
                $posicion_MulticeldaICECX =45;
                $posicion_MulticeldaICECY =103;

                //Capacidad Kg
                $posicion_MulticeldaICX =10;
                $posicion_MulticeldaICY =109;
                $posicion_MulticeldaICTX =45;
                $posicion_MulticeldaICTY =109;
                $posicion_MulticeldaICCX =45;
                $posicion_MulticeldaICCY =109;

                //Operadores
                $posicion_MulticeldaIOX = 53;
                $posicion_MulticeldaIOY = 85;
                $posicion_MulticeldaIOTX = 88;
                $posicion_MulticeldaIOTY = 85;
                $posicion_MulticeldaIOCX = 45;
                $posicion_MulticeldaIOCY = 85;

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
                $pdf->Image('ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

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

            //123456789123456789123456789123456789123456789123456789
             
            //CUADRO PROCESO

            
            $pdf->SetXY($posicion_MulticeldaIFX, $posicion_MulticeldaIFY);
            $pdf->SetFont('TIMES','', 6);
            $pdf->MultiCell(90, 25,'', 1, 'J', false);
            $pdf->Image('ImagenesEmpresas/Procesos/'.utf8_decode($fila['imagen']).'', $posicion_MulticeldaIIX, $posicion_MulticeldaIIY, 0, 20);//30.63

            //Número de proceso 
            $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
            $pdf->SetXY($posicion_MulticeldaIPX,$posicion_MulticeldaIPY);
            $pdf->MultiCell(35, 6,'Proceso / Process', 1, 'L', false);
            //Número de proceso (texto)
            $pdf->SetXY($posicion_MulticeldaIPTX,$posicion_MulticeldaIPTY);
            $pdf->MultiCell(8, 6,utf8_decode($fila['numeroProceso']), 1, 'C', false);
            
            //Celda de margen 
            $pdf->SetXY($posicion_MulticeldaIPCX, $posicion_MulticeldaIPCY);
            $pdf->Cell(55,6,'',1,1,'L');
            //Nombre del proceso
            $pdf->SetXY($posicion_MulticeldaIPNX,$posicion_MulticeldaIPNY); 
            $pdf->MultiCell(35, 6,'Nombre proceso / Process description', 1, 'L', false);
            //Nombre del proceso (texto)
            $pdf->SetXY($posicion_MulticeldaIPRTX, $posicion_MulticeldaIPRTY);
            $pdf->MultiCell(55, 3,utf8_decode($fila['nombreProceso']), 0, 'C', false);

            //Celda de margen 
            $pdf->SetXY($posicion_MulticeldaIDCX, $posicion_MulticeldaIDCY);
            $pdf->Cell(55,6,'',1,1,'L');
            //Descripción del equipo
            $pdf->SetXY($posicion_MulticeldaIDX,$posicion_MulticeldaIDY);
            $pdf->MultiCell(35, 3,utf8_decode('Equipo descripción / Machine description'), 1, 'L', false);
            //Descripción del equipo (texto)
            $pdf->SetXY($posicion_MulticeldaIDTX, $posicion_MulticeldaIDTY);
            $pdf->MultiCell(55, 3,utf8_decode($fila['equipoDescripcion']), 0, 'C', false);

            //Celda de margen 
            $pdf->SetXY($posicion_MulticeldaICECX, $posicion_MulticeldaICECY);
            $pdf->Cell(55,6,'',1,1,'L');
            //Cantidad de Equipos
            $pdf->SetXY($posicion_MulticeldaICEX,$posicion_MulticeldaICEY);
            $pdf->MultiCell(35, 3,'Cantidad de equipos / Machine Quantity', 1, 'L', false);
            //Cantidad de Equipos (texto)
            $pdf->SetXY($posicion_MulticeldaICETX,$posicion_MulticeldaICETY);
            $pdf->MultiCell(55, 3,utf8_decode($fila['cantidadEquipo']), 0, 'C', false);

            //Celda de margen 
            $pdf->SetXY($posicion_MulticeldaICCX, $posicion_MulticeldaICCY);
            $pdf->Cell(55,6,'',1,1,'L');
            //Capacidad KG
            $pdf->SetXY($posicion_MulticeldaICX, $posicion_MulticeldaICY);
            $pdf->MultiCell(35, 3,'Capacidad kg o pzas por turno / Capacity per shift in kg or pcs', 1, 'L', false);
            //Capacidad KG (texto)
            $pdf->SetXY($posicion_MulticeldaICTX, $posicion_MulticeldaICTY);
            $pdf->MultiCell(55, 3,utf8_decode($fila['capacidad']) , 0, 'C', false);

            //Celda de margen 
            $pdf->SetXY($posicion_MulticeldaIOCX, $posicion_MulticeldaIOCY);
            $pdf->Cell(55,6,'',1,1,'L');
            //Operadores
            $pdf->SetXY($posicion_MulticeldaIOX,$posicion_MulticeldaIOY);
            $pdf->MultiCell(35, 3,'Operadores / Operators quantity per shift per machine', 1, 'C', false);
            //Operadore(texto)
            $pdf->SetXY($posicion_MulticeldaIOTX, $posicion_MulticeldaIOTY);
            $pdf->MultiCell(12, 6,utf8_decode($fila['operadores']), 1, 'C', false);

/*
*/
           // $pdf->SetXY($posicion_MulticeldaITX, $posicion_MulticeldaITY);
           // $pdf->MultiCell(15, 5,utf8_decode($fila['nombreProceso']), 1, 'C', false);
           // $pdf->MultiCell(40, 5,'123456789123456789123456789123456789123456789123456789123456', 1, 'C', false); 
            
            //$posicion_MulticeldaDX = $posicion_MulticeldaDX+10;47
            $posicion_MulticeldaIFX = $posicion_MulticeldaIFX+95;
            $posicion_MulticeldaIIX = $posicion_MulticeldaIIX+95;
            $posicion_MulticeldaITX = $posicion_MulticeldaITX+95;
            

                //NUEVAS VARIABLES PARA FORMATO

                //Número de proceso
                $posicion_MulticeldaIPX = $posicion_MulticeldaIPX + 95;
                $posicion_MulticeldaIPTX = $posicion_MulticeldaIPTX + 95;

                //Nombre del proceso
                $posicion_MulticeldaIPNX = $posicion_MulticeldaIPNX + 95;
                $posicion_MulticeldaIPRTX = $posicion_MulticeldaIPRTX + 95;
                $posicion_MulticeldaIPCX = $posicion_MulticeldaIPCX + 95;

                //Descripción
                $posicion_MulticeldaIDX = $posicion_MulticeldaIDX + 95;
                $posicion_MulticeldaIDTX = $posicion_MulticeldaIDTX + 95;
                $posicion_MulticeldaIDCX = $posicion_MulticeldaIDCX + 95;

                //Cantidad equipo
                $posicion_MulticeldaICEX = $posicion_MulticeldaICEX + 95;
                $posicion_MulticeldaICETX = $posicion_MulticeldaICETX + 95;
                $posicion_MulticeldaICECX = $posicion_MulticeldaICECX + 95;

                //Capacidad Kg
                $posicion_MulticeldaICX = $posicion_MulticeldaICX + 95;
                $posicion_MulticeldaICTX = $posicion_MulticeldaICTX + 95;
                $posicion_MulticeldaICCX = $posicion_MulticeldaICCX + 95;

                //Operadores
                $posicion_MulticeldaIOX = $posicion_MulticeldaIOX + 95;//53-88-45
                $posicion_MulticeldaIOTX = $posicion_MulticeldaIOTX + 95;
                $posicion_MulticeldaIOCX = $posicion_MulticeldaIOCX + 95;
            
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
        $pdf->Image('ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

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
                $pdf->Image('ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

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
            $pdf->Image('ImagenesEmpresas/Productos/'.utf8_decode($fila['imagen']).'', $posicion_MulticeldaIIX, $posicion_MulticeldaIIY, 30, 30);//30.63

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
        $pdf->Image('ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

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
                $pdf->Image('ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

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
            $pdf->Image('ImagenesEmpresas/Clientes/'.utf8_decode($fila['logo']).'', $posicion_MulticeldaIIX, $posicion_MulticeldaIIY, 30, 30);//30.63

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
        $pdf->Image('ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

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
                $pdf->Image('ImagenesEmpresas/Logos/'.utf8_decode($row['logo']).'', 176, 23, 14, 14);

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
            $pdf->Image('ImagenesEmpresas/Certificaciones/'.utf8_decode($fila['imagen']).'', $posicion_MulticeldaIIX, $posicion_MulticeldaIIY, 30, 30);//30.63

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


//'.utf8_decode($row['nombreEmpresa']).'

$pdf->Output('ArchivosSocios/CATÁLOGO_CAPACIDADES_EMPRESA.pdf','F');
$response['status']  = 'success';
//$response['message'] = 'Correo enviado correctamente!';  
echo json_encode($response);
}
 
?>