<?php
/*
 * Este archivo contiene todo lo necesario para que esta aplicación se conecta a la BBDD "personas" y pueda realizarse consultas, inserciones, eliminaciones y actualización
 *
 * 1. Definir parámetros de conexión
 * */

//Parámetros de conexión a la BBDD
$servidor = "localhost";
$usuario = "root";
$password = "";
$puerto = "3306";
$bbdd = "cepa2";
function conectar() {

    global $servidor,$usuario,$password,$puerto,$bbdd;
    $conexion = mysqli_connect($servidor.":".$puerto,$usuario,$password);

    if(mysqli_error($conexion)) {

        //echo "Error al conectar";

    } else {

        //echo "Conexión realizada correctamente<br>";
    }
    if (!mysqli_select_db($conexion,$bbdd)) {

        //echo "Error al conectar con la BBDD";
        exit();

    } else {

        //echo "Conexión con la BBDD realizada correctamente ";
    }
    return $conexion;
}
//$conexion = conectar();