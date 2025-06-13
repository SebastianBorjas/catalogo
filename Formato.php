<?php

    try{
        $pdo = new PDO('mysql:host=localhost;dbname=canacin8_proyectos', 'root', '');
        $pdo->exec("set names utf8");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo 'conectado';
    } catch (PDOExeption $e){
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
    }

$id = $_GET["id"];
//$id = '1';


include_once('PDF.php');
//-----------------------------------------------------
$query = "SELECT * FROM Empresa WHERE idEmpresa= $id";
$resultado = $pdo->prepare($query);
$resultado->execute();

//-----------------------Proceso---------------------------
$query2 = "SELECT * FROM Proceso WHERE idEmpresa = $id";
$resultado2 = $pdo->prepare($query2);  
$resultado2->execute();

$query3 = "SELECT COUNT(*) FROM Proceso WHERE idEmpresa = $id";
$resultado3 = $pdo->prepare($query3);
$resultado3->execute();

//-----------------------Producto--------------------------
$query4 = "SELECT * FROM Producto WHERE idEmpresa = $id";
$resultado4 = $pdo->prepare($query4); 
$resultado4->execute();

$query5 = "SELECT COUNT(*) FROM Producto WHERE idEmpresa = $id";
$resultado5 = $pdo->prepare($query5); 
$resultado5->execute();

//-----------------------Cliente---------------------------
$query6 = "SELECT * FROM Cliente WHERE idEmpresa = $id";
$resultado6 = $pdo->prepare($query6); 
$resultado6->execute();

$query7 = "SELECT COUNT(*) FROM Cliente WHERE idEmpresa = $id";
$resultado7 = $pdo->prepare($query7); 
$resultado7->execute();

//-----------------------Certificación---------------------
$query8 = "SELECT * FROM Certificacion WHERE idEmpresa = $id";
$resultado8 = $pdo->prepare($query8);  
$resultado8->execute();

$query9 = "SELECT COUNT(*) FROM Certificacion WHERE idEmpresa = $id";
$resultado9 = $pdo->prepare($query9); 
$resultado9->execute();

////////IZQUIERDA////////

//Texto descriptivo correspondiente al cuadro
$posicion_MulticeldaITX = 10;
$posicion_MulticeldaITY = 95;


//NUEVAS VARIABLES PARA FORMATO



//Número de proceso
$posicion_MulticeldaIPX =10;
$posicion_MulticeldaIPY =130;
$posicion_MulticeldaIPTX =45;
$posicion_MulticeldaIPTY =130;

//Nombre del proceso
$posicion_MulticeldaIPNX =10;
$posicion_MulticeldaIPNY =139;   //91
$posicion_MulticeldaIPRTX =45;
$posicion_MulticeldaIPRTY =139;  //91


//Descripción
$posicion_MulticeldaIDX =10;
$posicion_MulticeldaIDY =151;    //97   //Cuadro que encapsula el primer texto
$posicion_MulticeldaIDTX =45;
$posicion_MulticeldaIDTY =151;   //97   //Texto del segundo cuadro


//Cantidad equipo
$posicion_MulticeldaICEX =10;
$posicion_MulticeldaICEY =157; //103    //Cuadro que encapsula el primer texto
$posicion_MulticeldaICETX =45;
$posicion_MulticeldaICETY =157; //103   //Texto del segundo cuadro


//Capacidad Kg
$posicion_MulticeldaICX =10;
$posicion_MulticeldaICY =163; //109     //Cuadro que encapsula el primer texto
$posicion_MulticeldaICTX =45;
$posicion_MulticeldaICTY =163; //109    //Texto del segundo cuadro


//Operadores
$posicion_MulticeldaIOX = 53;
$posicion_MulticeldaIOY = 130;
$posicion_MulticeldaIOTX = 88;
$posicion_MulticeldaIOTY = 130;



$pdf = new PDF();

if($resultado){
    while($row = $resultado->fetch(PDO::FETCH_ASSOC)){

        $pdf->AddPage();

        $pdf->SetFont('Arial','B', 10);
        $pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA 2.png', 25,80, 170, 130);
        $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10);
        $pdf->Image('imagenes/LOGO-CANACINTRA HORIZONTAL NEGRO.png', 10, 10, 45, 10);

         //Texto de Título
        $pdf->SetFont('Times','B', 11);
        $pdf->SetXY(60, 10);
        $pdf->Cell(65, 5, utf8_decode('CATÁLOGO DE CAPACIDADES DE MANUFACTURA'), 0, 'C');
        
        //Texto Explicativo
        $pdf->SetFont('TIMES','', 9);
        $pdf->SetXY(62, 15);
        $pdf->Cell(90, 4, utf8_decode('PROCESOS DE MANUFACTURA / MANUFACTURING PROCESSES'), 0, 'C');

        // Número de página 
        $pdf->SetFont('Arial','I',8);
        $pdf->SetXY(171, 8);
        $pdf->Cell(0,10,utf8_decode('Página / Page ').$pdf->PageNo(),0,0,'C');

        //Fecha actual
        $pdf->SetXY(180, 13);
        $pdf->Cell(40,10,date('d/m/Y'),0,1,'L');

        //LOGO DE LA EMPRESA
        $pdf->SetXY(80, 23);
        $pdf->MultiCell(50, 35,'', 1, 'J', false);
        $pdf->Image('ImagenesEmpresas/Logos/'.$row['logo'].'', 80, 26, 50, 35);

        //Texto Explicativo 2
        $pdf->SetFont('TIMES','', 12);
        $pdf->SetTextColor(255,255,255);  // Establece el color del texto 
        $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
        $pdf->SetDrawColor(207,207,207,255);
        $pdf->SetXY(10, 65);
        $pdf->MultiCell(80, 5,utf8_decode('EMPRESA / COMPANY'), 1, 'C', true);

        //CAMPO DE DIRECCIÓN
        $pdf->SetFont('TIMES','', 12);
        $pdf->SetXY(100, 65);
        $pdf->MultiCell(80, 5,utf8_decode('DIRECCIÓN / ADDRESS'), 1, 'C', true);

        //ACTIVIDAD PRINCIPAL DE LA EMPRESA
        $pdf->SetFont('TIMES','', 12);
        $pdf->SetXY(10, 90);
        $pdf->MultiCell(80, 5,utf8_decode('ACTIVIDAD PRINCIPAL / MAIN ACTIVITY'), 1, 'C', true);


        //DATOS DE CONTACTO
        $pdf->SetFont('TIMES','', 12);
        $pdf->SetXY(100, 90);
        $pdf->MultiCell(100, 5, utf8_decode('DATOS DE CONTACTO / CONTACT INFORMATION'), 1, 'C', true);

        //SITIO WEB (DATO DE CONTACTO)
        $pdf->SetFont('TIMES','', 10);
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 100);
        $pdf->MultiCell(40, 4,'SITIO WEB/WEB SITE', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetFont('TIMES','U', 10);
        $pdf->SetTextColor(8,8,194);
        $pdf->SetXY(140, 100);
        $pdf->MultiCell(60, 4, utf8_decode($row['sitioWeb']), 1, 'J', false);

        //CORREO/E-MAIL (DATO DE CONTACTO)
        $pdf->SetFont('TIMES','', 10);
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 104);
        $pdf->MultiCell(40, 4,'CORREO/E-MAIL', 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 104);
        $pdf->MultiCell(60, 4,utf8_decode($row['correo']), 1, 'J', false);

        //NOMBRE DE CONTACTO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 108);
        $pdf->MultiCell(40, 4,'CONTACTO/CONTACT', 1, 'L', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 108);
        $pdf->MultiCell(60, 4,utf8_decode($row['nombre']), 1, 'J', false);

        //TELÉFONO (DATO DE CONTACTO)
        $pdf->SetTextColor(0,0,0,255);
        $pdf->SetXY(100, 112);
        $pdf->MultiCell(40, 4,utf8_decode('TELÉFONO / PHONE'), 1, 'J', false);
        //CUADRO DE TEXTO
        $pdf->SetXY(140, 112);
        $pdf->MultiCell(60, 4,utf8_decode($row['telefono']), 1, 'J', false);

        //CUADRO DE TEXTO (EMPRESA)
        $pdf->SetFont('TIMES','', 10);
        $pdf->SetXY(10, 70);
        $pdf->MultiCell(80, 5,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

        //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
        $pdf->SetFont('TIMES','', 10);
        $pdf->SetXY(10, 100);
        $pdf->MultiCell(80, 5,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

        //CUADRO DE TEXTO (DIRECCIÓN)
        $pdf->SetFont('TIMES','', 10);
        $pdf->SetXY(100, 70);
        $pdf->MultiCell(80, 5,utf8_decode($row['colonia']), 1, 'J', false);

        //Texto de Procesos
        $pdf->SetFont('TIMES','B', 14);
        $pdf->SetXY(90, 120);
        $pdf->Cell(65, 5, utf8_decode('Procesos'), 0, 'C');

        ///////////////////////////////////////////////////////////////////////////////////////////////
        //$pdf->AddPage();

        $pdf->Ln();
        while($fila = $resultado2->fetch(PDO::FETCH_ASSOC)){
            for($i=1; $i <= $resultado3; $i++){
                if($posicion_MulticeldaIIX >= '200'){


                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = $posicion_MulticeldaITY + 62;

                //NUEVAS VARIABLES PARA FORMATO


                //Número de proceso
                $posicion_MulticeldaIPX =10;
                $posicion_MulticeldaIPY = $posicion_MulticeldaIPY + 62;
                $posicion_MulticeldaIPTX =45;
                $posicion_MulticeldaIPTY = $posicion_MulticeldaIPTY + 62;

                //Nombre del proceso
                $posicion_MulticeldaIPNX =10;
                $posicion_MulticeldaIPNY = $posicion_MulticeldaIPNY + 62;
                $posicion_MulticeldaIPRTX =45;
                $posicion_MulticeldaIPRTY = $posicion_MulticeldaIPRTY + 62;
                $posicion_MulticeldaIPCX =45;
                $posicion_MulticeldaIPCY = $posicion_MulticeldaIPCY + 62;

                //Descripción
                $posicion_MulticeldaIDX =10;
                $posicion_MulticeldaIDY = $posicion_MulticeldaIDY + 62;
                $posicion_MulticeldaIDTX =45;
                $posicion_MulticeldaIDTY = $posicion_MulticeldaIDTY + 62;
                $posicion_MulticeldaIDCX =45;
                $posicion_MulticeldaIDCY = $posicion_MulticeldaIDCY + 62;

                //Cantidad equipo
                $posicion_MulticeldaICEX =10;
                $posicion_MulticeldaICEY = $posicion_MulticeldaICEY + 62;
                $posicion_MulticeldaICETX =45;
                $posicion_MulticeldaICETY = $posicion_MulticeldaICETY + 62; 
                $posicion_MulticeldaICECX =45;
                $posicion_MulticeldaICECY = $posicion_MulticeldaICECY + 62;

                //Capacidad Kg
                $posicion_MulticeldaICX =10;
                $posicion_MulticeldaICY = $posicion_MulticeldaICY + 62;
                $posicion_MulticeldaICTX =45;
                $posicion_MulticeldaICTY = $posicion_MulticeldaICTY + 62;
                $posicion_MulticeldaICCX =45;
                $posicion_MulticeldaICCY = $posicion_MulticeldaICCY + 62;

                //Operadores
                $posicion_MulticeldaIOX = 53;
                $posicion_MulticeldaIOY = $posicion_MulticeldaIOY + 62;
                $posicion_MulticeldaIOTX = 88;
                $posicion_MulticeldaIOTY = $posicion_MulticeldaIOTY + 62;
                $posicion_MulticeldaIOCX = 45;
                $posicion_MulticeldaIOCY = $posicion_MulticeldaIOCY + 62;
                }

                if($posicion_MulticeldaIIY >= '230'){
                    $pdf->AddPage();


                //Texto descriptivo correspondiente al cuadro
                $posicion_MulticeldaITX = 10;
                $posicion_MulticeldaITY = 95;


                //NUEVAS VARIABLES PARA FORMATO


                //Número de proceso
                $posicion_MulticeldaIPX =10;
                $posicion_MulticeldaIPY =95;
                $posicion_MulticeldaIPTX =45;
                $posicion_MulticeldaIPTY =95;

                //Nombre del proceso
                $posicion_MulticeldaIPNX =10;
                $posicion_MulticeldaIPNY =101;
                $posicion_MulticeldaIPRTX =45;
                $posicion_MulticeldaIPRTY =101;
                $posicion_MulticeldaIPCX =45;
                $posicion_MulticeldaIPCY =101;

                //Descripción
                $posicion_MulticeldaIDX =10;
                $posicion_MulticeldaIDY =107;
                $posicion_MulticeldaIDTX =45;
                $posicion_MulticeldaIDTY =107;
                $posicion_MulticeldaIDCX =45;
                $posicion_MulticeldaIDCY =107;

                //Cantidad equipo
                $posicion_MulticeldaICEX =10;
                $posicion_MulticeldaICEY =113;
                $posicion_MulticeldaICETX =45;
                $posicion_MulticeldaICETY =113;
                $posicion_MulticeldaICECX =45;
                $posicion_MulticeldaICECY =113;

                //Capacidad Kg
                $posicion_MulticeldaICX =10;
                $posicion_MulticeldaICY =119;
                $posicion_MulticeldaICTX =45;
                $posicion_MulticeldaICTY =119;
                $posicion_MulticeldaICCX =45;
                $posicion_MulticeldaICCY =119;

                //Operadores
                $posicion_MulticeldaIOX = 53;
                $posicion_MulticeldaIOY = 95;
                $posicion_MulticeldaIOTX = 88;
                $posicion_MulticeldaIOTY = 95;
                $posicion_MulticeldaIOCX = 45;
                $posicion_MulticeldaIOCY = 95;

                $pdf->SetFont('Arial','B', 10);
                //Imagen fondo/ marca de agua iniciando en 0, 0
                $pdf->Image('imagenes/LOGO CANACINTRA MARCA DE AGUA 2.png', 25,80, 170, 130);

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
                $pdf->SetFont('TIMES','U', 8);
                $pdf->SetTextColor(8,8,194);
                $pdf->SetXY(140, 41);
                $pdf->MultiCell(60, 4,utf8_decode($row['sitioWeb']), 1, 'J', false);

                //CORREO/E-MAIL (DATO DE CONTACTO)
                $pdf->SetFont('TIMES','', 8);
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
                $pdf->MultiCell(80, 5,utf8_decode($row['nombreEmpresa']), 1, 'J', false);

                //CUADRO DE TEXTO (ACTIVIDAD PRINCIPAL)
                $pdf->SetXY(10, 44);
                $pdf->MultiCell(80, 5,utf8_decode($row['actividadPrincipal']), 1, 'J', false);

                //CUADRO DE TEXTO (DIRECCIÓN)
                $pdf->SetFont('TIMES','', 7);
                $pdf->SetXY(100, 27);
                $pdf->MultiCell(70, 5,utf8_decode($row['colonia']), 1, 'J', false);   
                }

                //Número de proceso 
                $pdf->SetFont('TIMES','', 9);
                $pdf->SetFillColor(26,45,82,255); // establece el color del fondo de la celda 
                $pdf->SetXY($posicion_MulticeldaIPX,$posicion_MulticeldaIPY);
                $pdf->MultiCell(35, 9,'Proceso / Process', 1, 'L', false);
                //Número de proceso (texto)
                $pdf->SetXY($posicion_MulticeldaIPTX,$posicion_MulticeldaIPTY);
                $pdf->MultiCell(8, 9,utf8_decode($fila['numeroProceso']), 1, 'C', false);
                
                //Celda de margen 
                $pdf->SetXY($posicion_MulticeldaIPCX, $posicion_MulticeldaIPCY);
                $pdf->Cell(55,6,'',1,1,'L');
                //Nombre del proceso
                $pdf->SetXY($posicion_MulticeldaIPNX,$posicion_MulticeldaIPNY); 
                $pdf->MultiCell(35, 6,'Nombre proceso / Process description', 1, 'L', false);
                //Nombre del proceso (texto)
                $pdf->SetXY($posicion_MulticeldaIPRTX, $posicion_MulticeldaIPRTY);
                $pdf->MultiCell(55, 6,utf8_decode($fila['nombreProceso']), 1, 'C', false);

                //Celda de margen 
                $pdf->SetXY($posicion_MulticeldaIDCX, $posicion_MulticeldaIDCY);
                $pdf->Cell(55,6,'',1,1,'L');
                //Descripción del equipo
                $pdf->SetXY($posicion_MulticeldaIDX,$posicion_MulticeldaIDY);
                $pdf->MultiCell(35, 3,utf8_decode('Equipo descripción / Machine description'), 1, 'L', false);
                //Descripción del equipo (texto)
                $pdf->SetXY($posicion_MulticeldaIDTX, $posicion_MulticeldaIDTY);
                $pdf->MultiCell(55, 6,utf8_decode($fila['equipoDescripcion']), 1, 'C', false);

                //Celda de margen 
                $pdf->SetXY($posicion_MulticeldaICECX, $posicion_MulticeldaICECY);
                $pdf->Cell(55,6,'',1,1,'L');
                //Cantidad de Equipos
                $pdf->SetXY($posicion_MulticeldaICEX,$posicion_MulticeldaICEY);
                $pdf->MultiCell(35, 3,'Cantidad de equipos / Machine Quantity', 1, 'L', false);
                //Cantidad de Equipos (texto)
                $pdf->SetXY($posicion_MulticeldaICETX,$posicion_MulticeldaICETY);
                $pdf->MultiCell(55, 6,utf8_decode($fila['cantidadEquipo']), 1, 'C', false);

                //Celda de margen 
                $pdf->SetXY($posicion_MulticeldaICCX, $posicion_MulticeldaICCY);
                $pdf->Cell(55,6,'',1,1,'L');
                //Capacidad KG
                $pdf->SetXY($posicion_MulticeldaICX, $posicion_MulticeldaICY);
                $pdf->MultiCell(35, 3,'Capacidad kg o pzas por turno / Capacity per shift in kg or pcs', 1, 'L', false);
                //Capacidad KG (texto)
                $pdf->SetXY($posicion_MulticeldaICTX, $posicion_MulticeldaICTY);
                $pdf->MultiCell(55, 9,utf8_decode($fila['capacidad']), 1, 'C', false);

                //Celda de margen 
                $pdf->SetXY($posicion_MulticeldaIOCX, $posicion_MulticeldaIOCY);
                $pdf->Cell(55,6,'',1,1,'L');
                //Operadores
                $pdf->SetXY($posicion_MulticeldaIOX,$posicion_MulticeldaIOY);
                $pdf->MultiCell(35, 3,'Operadores / Operators quantity per shift per machine', 1, 'C', false);
                //Operadore(texto)
                $pdf->SetXY($posicion_MulticeldaIOTX, $posicion_MulticeldaIOTY);
                $pdf->MultiCell(12, 9,utf8_decode($fila['operadores']), 1, 'C', false);
 
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
    }

}
    $pdf->Output();
?>