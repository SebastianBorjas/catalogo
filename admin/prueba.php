<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
<script src="bootstrap/js/bootstrap.bundle.min.js" ></script>
<script src="bootstrap/js/bootstrap.min.js" ></script>
</head>
<body>


<?php include("conexion.php"); ?>




<div class="container mt-5">
    <div class="col-12">
 


    <div class="row">
<div class="col-12 grid-margin">
<div class="card">
<div class="card-body">

        <h4 class="card-title">Buscador</h4>


<form id="form2" name="form2" method="POST" action="index.php">
        <div class="col-12 row">

            <div class="mb-3">
                    <label  class="form-label">Nombre a buscar</label>
                    <input type="text" class="form-control" id="buscar" name="buscar" value="<?php echo $_POST["buscar"] ?>" >
            </div>

                <div class="col-11">

                        <table class="table">
                                <thead>
                                        <tr class="filters">
                                                <th>
                                                        Departamento
                                                        <select id="assigned-tutor-filter" id="buscadepartamento" name="buscadepartamento" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                <?php if ($_POST["buscadepartamento"] != ''){ ?>
                                                                <option value="<?php echo $_POST["buscadepartamento"]; ?>"><?php echo $_POST["buscadepartamento"]; ?></option>
                                                                <?php } ?>
                                                                <option value="Todos">Todos</option>
                                                                <option value="Compras">Compras</option>
                                                                <option value="Ventas">Ventas</option>
                                                                <option value="Alquileres">Alquileres</option>
                                                        </select>
                                                </th>
                                                <th>
                                                        Fecha desde:
                                                        <input type="date" id="buscafechadesde" name="buscafechadesde" class="form-control mt-2" value="<?php echo $_POST["buscafechadesde"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Fecha hasta:
                                                        <input type="date" id="buscafechahasta" name="buscafechahasta" class="form-control mt-2" value="<?php echo $_POST["buscafechahasta"]; ?>" style="border: #bababa 1px solid; color:#000000;" >
                                                </th>
                                                <th>
                                                        Color
                                                        <select id="subject-filter" id="color" name="color" class="form-control mt-2" style="border: #bababa 1px solid; color:#000000;" >
                                                                <?php if ($_POST["color"] != ''){ ?>
                                                                <option value="<?php echo $_POST["color"]; ?>"><?php echo $_POST["color"]; ?></option>
                                                                <?php } ?>
                                                                <option value="Todos">Todos</option>
                                                                <option value="Azul">Azul</option>
                                                                <option value="Rojo">Rojo</option>
                                                                <option value="Amarillo">Amarillo</option>
                                                        </select>
                                                </th>
                                        </tr>
                                </thead>
                        </table>
                </div>
                <div class="col-1">
                        <input type="submit" class="btn btn-success" value="Ver" style="margin-top: 38px;">
                </div>
        </div>


        <?php 
        /*FILTRO de busqueda////////////////////////////////////////////*/

        if ($_POST["buscar"] == '' AND $_POST["buscadepartamento"] =='Todos' AND $_POST["buscafechadesde"] =='' AND $_POST["color"] =='Todos' ){ $filtro = "";}else{
        if ($_POST["buscar"] != '' AND $_POST["buscadepartamento"] =='Todos' AND $_POST["buscafechadesde"] =='' AND $_POST["color"] =='Todos'  ){ $filtro = "WHERE nombre = '".$_POST["buscar"]."'";}
        if ($_POST["buscar"] == '' AND $_POST["buscadepartamento"] !='Todos' AND $_POST["buscafechadesde"] =='' AND $_POST["color"] =='Todos'  ){ $filtro = "WHERE departamento = '".$_POST["buscadepartamento"]."'";}
        if ($_POST["buscar"] != '' AND $_POST["buscadepartamento"] !='Todos' AND $_POST["buscafechadesde"] =='' AND $_POST["color"] =='Todos'  ){ $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND departamento = '".$_POST["buscadepartamento"]."'";}
        if ($_POST["buscar"] == '' AND $_POST["buscadepartamento"] !='Todos' AND $_POST["buscafechadesde"] !='' AND $_POST["color"] =='Todos'  ){ $filtro = "WHERE departamento = '".$_POST["buscadepartamento"]."' AND fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."' ";}
        if ($_POST["buscar"] != '' AND $_POST["buscadepartamento"] !='Todos' AND $_POST["buscafechadesde"] !='' AND $_POST["color"] =='Todos'  ){ $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND departamento = '".$_POST["buscadepartamento"]."' AND fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."' ";}
        if ($_POST["buscar"] == '' AND $_POST["buscadepartamento"] !='Todos' AND $_POST["buscafechadesde"] !='' AND $_POST["color"] !='Todos'  ){ $filtro = "WHERE departamento = '".$_POST["buscadepartamento"]."' AND fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."' AND color = '".$_POST["color"]."' ";}
        if ($_POST["buscar"] != '' AND $_POST["buscadepartamento"] !='Todos' AND $_POST["buscafechadesde"] !='' AND $_POST["color"] !='Todos'  ){ $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND departamento = '".$_POST["buscadepartamento"]."' AND fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."' AND color = '".$_POST["color"]."' ";}
        if ($_POST["buscar"] == '' AND $_POST["buscadepartamento"] =='Todos' AND $_POST["buscafechadesde"] !='' AND $_POST["color"] =='Todos'  ){ $filtro = "WHERE fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."'  ";}
        if ($_POST["buscar"] != '' AND $_POST["buscadepartamento"] =='Todos' AND $_POST["buscafechadesde"] !='' AND $_POST["color"] =='Todos'  ){ $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."'  ";}
        if ($_POST["buscar"] == '' AND $_POST["buscadepartamento"] =='Todos' AND $_POST["buscafechadesde"] !='' AND $_POST["color"] !='Todos'  ){ $filtro = "WHERE fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."' AND color = '".$_POST["color"]."' ";}
        if ($_POST["buscar"] != '' AND $_POST["buscadepartamento"] =='Todos' AND $_POST["buscafechadesde"] !='' AND $_POST["color"] !='Todos'  ){ $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."' AND color = '".$_POST["color"]."' ";}
        if ($_POST["buscar"] == '' AND $_POST["buscadepartamento"] !='Todos' AND $_POST["buscafechadesde"] =='' AND $_POST["color"] !='Todos'  ){ $filtro = "WHERE departamento = '".$_POST["buscadepartamento"]."' AND color = '".$_POST["color"]."' ";}
        if ($_POST["buscar"] != '' AND $_POST["buscadepartamento"] !='Todos' AND $_POST["buscafechadesde"] =='' AND $_POST["color"] !='Todos'  ){ $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND departamento = '".$_POST["buscadepartamento"]."' AND color = '".$_POST["color"]."' ";}
        if ($_POST["buscar"] == '' AND $_POST["buscafechadesde"] !='' AND $_POST["buscadepartamento"] =='Todos' AND $_POST["color"] =='Todos' ){ $filtro = "WHERE fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."'";}
        if ($_POST["buscar"] != '' AND $_POST["buscafechadesde"] !='' AND $_POST["buscadepartamento"] =='Todos' AND $_POST["color"] =='Todos' ){ $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND fecha BETWEEN '".$_POST["buscafechadesde"]."' AND '".$_POST["buscafechahasta"]."'";}
        if ($_POST["buscar"] == '' AND $_POST["color"] !='Todos' AND $_POST["buscafechadesde"] =='' AND $_POST["buscadepartamento"] =='Todos' ){ $filtro = "WHERE color = '".$_POST["color"]."'";}
        if ($_POST["buscar"] != '' AND $_POST["color"] !='Todos' AND $_POST["buscafechadesde"] =='' AND $_POST["buscadepartamento"] =='Todos' ){ $filtro = "WHERE nombre = '".$_POST["buscar"]."' AND color = '".$_POST["color"]."'";}
        }

        $sql=mysql_query("SELECT * FROM datos $filtro ");
        $numeroSql = mysql_num_rows($sql);

        ?>
        <p style="font-weight: bold; color:green;"><i class="mdi mdi-file-document"></i> <?php echo $numeroSql; ?> Resultados encontrados</p>
</form>


<div class="table-responsive">
        <table class="table">
                <thead>
                        <tr style="background-color: #00695c; color:#FFFFFF;">
                                <th style=" text-align: center;"> Nombre </th>
                                <th style=" text-align: center;"> Departamento </th>
                                <th style=" text-align: center;"> Color </th>
                                <th style=" text-align: center;"> Fecha </th>
                        </tr>
                </thead>
                <tbody>
                <?php while ($rowSql = mysql_fetch_assoc($sql)){ ?>
               
                        <tr>
                        <td style="text-align: center;"><?php echo $rowSql["nombre"]; ?></td>
                        <td style="text-align: center;"><?php echo $rowSql["departamento"]; ?></td>
                        <td style="text-align: center;"><?php echo $rowSql["color"]; ?></td>
                        <td style=" text-align: center;"><?php echo $rowSql["fecha"]; ?></td>
                        </tr>
               
               <?php } ?>
                </tbody>
        </table>
</div>


</div>
</div>
</div>
</div>


    </div>
</div>

</body>
</html>