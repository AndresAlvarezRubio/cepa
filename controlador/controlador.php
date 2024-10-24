<?php
session_start();
$errores = array();


if ($_REQUEST["origen"] === "form1") {
    validarCpostal($_REQUEST["cp"]);
    validarDni($_REQUEST["dni"]);
    validarEdad($_REQUEST["fNacimiento"]);
    validarTexto($_REQUEST["nombre"], "nombre");
    validarTexto($_REQUEST["pApellido"], "apellido");
    validarTelefono($_REQUEST["telefono"]);
    validarVacio($_REQUEST["provincia"], "La provincia");
    validarVacio($_REQUEST["uEstudio"], "La uEstudio");
    validarVacio($_REQUEST["fEstudio"], "La fEstudio");
    validarVacio($_REQUEST["direccion"], "La direccion");
    if (count($errores) > 0) {
        for ($i = 0; $i < count($errores); $i++) {
            $todosLosErrores .= $errores[$i];
        }
        header("Location: ../vista/formulario1.php?errores=$todosLosErrores");
    } else {
        header("Location: ../vista/formulario2.php");
    }
}
if ($_REQUEST["origen"] === "form2") {
    if (validarTexto($_REQUEST["nombreFamiliar"], "Persona Contacto") && validarTelefono($_REQUEST["telefonoFamiliar"]) && !empty($_REQUEST["familiar"])) {
        header("Location:../vista/confirmacion.php");
    } else {
        header("Location:../vista/formulario2.php?errores=$todosLosErrores");

    }
}
function validarTexto($texto, $variable)
{
    global $errores;
    if (!is_string($texto) || empty($texto) || preg_match("/[0-9]/", $texto)) {
        $errores[] = "<p style='color: red'>El " . $variable . " no es correcto o esta vacio</p>";
        return false;
    } else {
        return true;
    }
}

function validarTelefono($telefono)
{
    global $errores;
    if (!is_numeric($telefono) || empty($telefono) || !preg_match("/^[6789]\d{8}$/", $telefono)) {
        $errores[] = "<p style='color: red'>El formato del telefono no es correcto o esta vacio</p>";
        return false;
    } else {
        return true;
    }
}

function validarEdad($fecha)
{
    $fechaT=date_create($fecha);
    $fechaHoy = date_create();
    return true;
}

function validarDni($dni)
{
    return true;
}

function validarCpostal($cp)
{
    global $errores;
    if (empty($cp) || strlen($cp) != 5 || preg_match("/^[0-9]\d{5}$/", $cp)) {
        $errores[] = "<p style='color: red'> El codigo postal no puede estar vacio y solo debe contener 5 numeros</p>";
        return false;
    } else {
        return true;
    }
}

function validarVacio($dato, $variable)
{
    global $errores;
    if (empty($dato)) {
        $errores[] = "<p style='color: red'>El " . $variable . " no es correcto o esta vacio</p>";
        return false;
    } else {
        return true;
    }
}