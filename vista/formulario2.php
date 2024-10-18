<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulario</title>
    <link rel="stylesheet" href="../vista/css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body>
<h1>Formulario de Alta de nuevo Alumno</h1>
<form action="../controlador/controlador.php" method="post">
    <div class="form">
        <h2>Contacto Familiar</h2>
        <label for="nombreFamiliar">
            <input type="text" id="nombreFamiliar" name="nombreFamiliar" placeholder="">
        </label>
        <label for="telefonoFamiliar">
            <input type="text" id="telefonoFamiliar" name="telefonoFamiliar">
        </label>
        <label for="familiar">
            <select name="familiar" id="familiar">
                <option value="">Introduce un familiar</option>
                <?php
                include_once("../modelo/conexion.php");
                $link = conectar();
                $consulta = "SELECT * FROM parentesco";
                $resultado = mysqli_query($link, $consulta);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $fila["idRelacion"] . "'>" . $fila["nombreRelacion"] . "</option>";
                }
                ?>
            </select>
        </label>
    </div>
    <input type="hidden" name="origen" value="form2">
    <input type="submit" name="enviarFormulario2" value="Siguiente">
    <?php
    if (!empty($_GET["errores"])) {
        echo "<p style='color: red'>" . $_GET["errores"]. "</p>";
    }
    ?>
</form>
</body>
</html>