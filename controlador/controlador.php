<?php
session_start();

if (
    validarCpostal($_REQUEST["cp"])
    && validarDni($_REQUEST["dni"])
    && validarEdad($_REQUEST["fNacimiento"])
    && validarTexto($_REQUEST["nombre"])
    && validarTexto($_REQUEST["pApellido"])
    && validarTelefono($_REQUEST["telefono"])
    && !empty($_REQUEST["provincia"])
    && !empty($_REQUEST["uEstudio"])
    && !empty($_REQUEST["fEstudio"])
    && !empty($_REQUEST["direccion"])
) {
$_SESSION["cp"]=$_REQUEST["cp"];
$_SESSION["dni"]=$_REQUEST["dni"];
$_SESSION["fNacimiento"]=$_REQUEST["fNacimiento"];
$_SESSION["nombre"]=$_REQUEST["nombre"];
$_SESSION["pApellido"]=$_REQUEST["pApellido"];
$_SESSION["telefono"]=$_REQUEST["telefono"];
$_SESSION["provincia"]=$_REQUEST["provincia"];
$_SESSION["uEstudio"]=$_REQUEST["uEstudio"];
$_SESSION["fEstudio"]=$_REQUEST["fEstudio"];
$_SESSION["direccion"]=$_REQUEST["direccion"];
    header("Location: ../vista/formulario2.php");
} else {
    header("Location: ../vista/formulario1.php?errores=Daltan Fatos");
}

function validarTexto($texto) {         return true;}
function validarTelefono($telefono) {   return true;}
function validarEdad($edad) {           return true;}
function validarDni($dni) {             return true;}
function validarCpostal($cp) {          return true;}

