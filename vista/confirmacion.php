<?php
session_start();
if (empty($_SESSION["nombreCompleto"])) {
    header("Location: formulario1.php?errores=No se puede confirmar, porque se deben completar todos los campos de ambos formularios.");
    exit();
}

include_once("header.php");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eres Dios</title>

    <link rel="stylesheet" href="../vista/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body>
<h1>Formulario de Alta de nuevo Alumno</h1>
<h2>Confirmación alta</h2>
<section class="container-confirmation">
    <div class="datos-alumno">
        <h3>Felicidades <?= $_SESSION["nombreCompleto"] ?>. Tu cuenta ha sido creada satisfactoriamente</h3>
        <ul>
            <li><b>Nombre:</b> <?= $_SESSION["nombreCompleto"] ?></li>
            <li><b>Teléfono:</b> <?= $_SESSION["telefono"] ?></li>
        </ul>
        <p>Su número de registro es: <span><?= $_SESSION["idRegistro"] ?></span></p>
    </div>
    <div class="boton">
        <a href="index.php">Volver a Inicio</a>
    </div>
</section>
<?php
include_once("footer.php");
?>