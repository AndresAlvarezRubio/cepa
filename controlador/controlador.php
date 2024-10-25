<?php
session_start();
$errores = array();

/**
 * El condicional lee que validación tiene que hacer. Ya que tenemos 2 formularios, le hemos dado a cada uno un valor llamado "origen". Así sabe a qué parte ir y nos ahorramos el tener que hacer varios archivos.
 *
 * Si todo es correcto, continúa al siguiente paso.
 * En caso de que no lo sea, vuelve al mismo formulario poniendo los errores para que lo vea el usuario
 */
if ($_REQUEST["origen"] === "form1") {
    validarCpostal($_REQUEST["cp"]);
    validarDni($_REQUEST["dni"]);
    validarEdad($_REQUEST["fNacimiento"]);
    validarTexto($_REQUEST["nombre"], "El nombre");
    validarTexto($_REQUEST["pApellido"], "El apellido");
    validarTelefono($_REQUEST["telefono"]);
    validarVacio($_REQUEST["provincia"], "La provincia");
    validarVacio($_REQUEST["uEstudio"], "El nivel de ultimo estudio");
    validarVacio($_REQUEST["fEstudio"], "La fecha del ultimo estudio");
    validarVacio($_REQUEST["direccion"], "La direccion");
    if (count($errores) > 0) {
        for ($i = 0; $i < count($errores); $i++) {
            $todosLosErrores .= $errores[$i];
        }
        header("Location: ../vista/formulario1.php?errores=$todosLosErrores");
    } else {
        $_SESSION["insertarAlumno"] = "INSERT INTO cepa2.alumno(nombre, primerApellido, segundoApellido, dni, telefono, direccion, cp, ciudad, fechaUltimoEst, idProvincia, idEstudios, fechaNacimiento) VALUES(
        '" . $_REQUEST["nombre"] . "',
        '" . $_REQUEST["pApellido"] . "',
        '" . $_REQUEST["sApellido"] . "',
        '" . $_REQUEST["dni"] . "',
        " . $_REQUEST["telefono"] . ",
        '" . $_REQUEST["direccion"] . "',
        '" . $_REQUEST["cp"] . "',
        '" . $_REQUEST["ciudad"] . "',
        '" . $_REQUEST["fEstudio"] . "',
        " . $_REQUEST["provincia"] . ",
        " . $_REQUEST["uEstudio"] . ",
        '" . $_REQUEST["fNacimiento"] . "')";

        header("Location: ../vista/formulario2.php");
    }
} else if ($_REQUEST["origen"] === "form2") {
    validarTexto($_REQUEST["nombreFamiliar"], "Persona Contacto");
    validarTelefono($_REQUEST["telefonoFamiliar"]);
    validarVacio($_REQUEST["familiar"], "El familiar ");
    if (count($errores) > 0) {
        for ($i = 0; $i < count($errores); $i++) {
            $todosLosErrores .= $errores[$i];
        }
        header("Location:../vista/formulario2.php?errores=$todosLosErrores");
    } else {
        require_once ("../modelo/conexion.php");
        $link=conectar();

        $insertarFamiliar="INSERT INTO cepa2.familiar(nombreFamiliar, telefono, idRelacion) VALUES
        ('".$_REQUEST["nombreFamiliar"]."',
        ".$_REQUEST["telefonoFamiliar"].",
        ".$_REQUEST["familiar"].")";
        $resultado=mysqli_query($link,$insertarFamiliar);

        $idFamiliar=mysqli_insert_id($link);
        $insertarAlumno=$_SESSION["insertarAlumno"];
        $resultado=mysqli_query($link,$insertarAlumno);

        $idAlumno=mysqli_insert_id($link);
        $_SESSION["idRegistro"]=$idAlumno;
        $insertarFamiliarAlumno = "UPDATE alumno SET idFamiliar=". $idFamiliar . " WHERE idAlumno=". $idAlumno;
        $resultado=mysqli_query($link,$insertarFamiliarAlumno);


        $consultarDatosAlumno=" SELECT nombre,primerApellido,telefono FROM alumno WHERE idAlumno=".$idAlumno;
        $resultado=mysqli_query($link,$consultarDatosAlumno);

        $arrayAlumno[]=mysqli_fetch_assoc($resultado);
        foreach ($arrayAlumno as $alumno) {
            $_SESSION["nombreCompleto"]=$alumno["nombre"]." ".$alumno["primerApellido"];
            $_SESSION["telefono"]=$alumno["telefono"];
        }

        header("Location:../vista/confirmacion.php");
    }
}
/**
 * @param $texto
 * @return void
 * Esta función valida que el texto que se le pasa sea solo texto sin números.
 */
function validarTexto($texto, $variable)
{
    global $errores;
    if (!is_string($texto) || empty($texto) || preg_match("/[0-9]/", $texto)) {
        $errores[] = "<p class='error'>" . $variable . " no es correcto o esta vacio</p>";
    }
}

/**
 * @param $telefono
 * @return void
 * Esta función valida que el número que se le pasa empiece por 6, 7, 8 o 9 y que a continuación le sigan 8 números. Además, de que solo pueda contener números y no esté vacío
 */
function validarTelefono($telefono)
{
    global $errores;
    if (!is_numeric($telefono) || empty($telefono) || !preg_match("/^[6789]\d{8}$/", $telefono)) {
        $errores[] = "<p class='error'>El formato del telefono no es correcto o esta vacio</p>";
    }
}

/**
 * @param $fecha
 * @return void
 * Esta función valida que la fecha puesta en el input de edad sea mayor de 18 años comparándola con la fecha actual
 */
function validarEdad($fecha)
{

    global $errores;

    $fechaN = new DateTime($fecha);//fecha del input
    $fechaActual = new DateTime();//fecha actual

    $diferencia = $fechaActual->diff($fechaN);//fecha actual menos fecha input

    $edad = $diferencia->y;//sacamos los años de la diferencia de las fechas

    if ($edad < 18) {
        $errores[] = "<p class='error'>El alumno debe ser mayor de edad</p>";
    }
}

/**
 * @param $dni
 * @return void
 * Esta función valida que los números del DNI equivalgan a la letra que tienen. Y además, tenga un formato válido
 */
function validarDni($dni)
{
    global $errores;

    if (preg_match("/^[0-9]{8}[A-Za-z]$/", $dni)) {

        //Separación letra y números
        $numero = substr($dni, 0, 8);
        $letra = strtoupper(substr($dni, -1));

        //Letras admitidas
        $letrasValidas = "TRWAGMYFPDXBNJZSQVHLCKE";

        //Calcular letra correspondiente al DNI
        $indice = $numero % 23;
        $letraCorrecta = $letrasValidas[$indice];

        //Validación de letra
        if ($letraCorrecta != $letra) {
            $errores[] = "<p class='error'>El DNI: $dni . Es invalido</p>";
        }
    } else {
        $errores[] = "<p class='error'>El DNI tiene formato incorrecto</p>";
    }
}

/**
 * @param $cp
 * @return void
 * Esta función valida que el código postal tenga un formato válido y esté vacío
 */
function validarCpostal($cp)
{
    global $errores;
    if (empty($cp) || strlen($cp) != 5 || preg_match("/^[0-9]\d{5}$/", $cp)) {
        $errores[] = "<p class='error'> El codigo postal no puede estar vacio y solo debe contener 5 numeros</p>";
    }
}

/**
 * @param $dato
 * @return void
 * Esta función valida que los input que se le pasen no estén vacíos
 */
function validarVacio($dato, $variable)
{
    global $errores;
    if (empty($dato)) {
        $errores[] = "<p class='error'>" . $variable . " no es correcto o esta vacio</p>";
    }
}