<?php
session_start();
include 'conexion.php';

$nombre = $_SESSION["USUARIO"];
$clave = $_SESSION["PASSWORD"];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = $pdo->query("SELECT * FROM Empresa WHERE usuario='$nombre' AND contraseña='$clave'");
    $resultado = $query->fetch(PDO::FETCH_BOTH);
    $idEmpresaLog = $resultado['idEmpresa'];

    $query2 = $pdo->prepare("DELETE FROM Certificacion WHERE idEmpresa ='$idEmpresaLog' AND numeroCertificacion = '$id'");
    $resultado2 = $query2->fetch(PDO::FETCH_BOTH);
    $query2->execute();
}

echo "<script> window.location='certifications_table.php?pagina=1'; </script>";
?>