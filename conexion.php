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
/*
    $hostname_conexion = "localhost";
   $username_conexion = "root";
   $password_conexion = "";
   $name = "canacin8_proyectos";
   $db = new mysqli($hostname_conexion,$username_conexion,$password_conexion,$name,3306);
   $db->set_charset('utf8');
   */
?>