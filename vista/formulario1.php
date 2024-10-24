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
    <script src="js/formulario1.js"></script>
</head>
<body>
<h1>Formulario de Alta de nuevo Alumno</h1>
<h2>Datos Personales del Alumno</h2>
<form action="../controlador/controlador.php" method="post">
    <div class="form half-form">
        <h3>Datos personales</h3>
        <label for="nombre">
            <input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre">
        </label>
        <label for="pApellido">
            <input type="text" name="pApellido" id="pApellido" placeholder="Introduce tu primer Apellido">
        </label>
        <label for="sApellido">
            <input type="text" name="sApellido" id="sApellido" placeholder="Introduce tu segundo Apellido">
        </label>
        <label for="dni">
            <input type="text" name="dni" id="dni" placeholder="Introduce tu dni ">
        </label>
        <label for="telefono">
            <input type="text" name="telefono" id="telefono" placeholder="Introduce tu telefono">
        </label>
        <label for="fNacimiento">
            <input type="date" name="fNacimiento" id="fNacimiento">
        </label>
    </div>
    <div class="form half-form">
        <h3>Datos complementarios</h3>
        <label for="direccion">
            <input type="text" name="direccion" id="direccion" placeholder="Introduce tu Dirección">
        </label>
        <label for="cp">
            <input type="text" name="cp" id="cp" placeholder="Introduce tu código postal">
        </label>
        <p id="holaquetal"></p>
        <label for="provincia">
            <select name="provincia" id="provincia">
                <option value="">Introduce tu Provincia</option>
                <?php
                include_once("../modelo/conexion.php");
                $link = conectar();
                $consulta = "SELECT * FROM provincia";
                $resultado = mysqli_query($link, $consulta);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $fila["idProvincia"] . "'>" . $fila["nombreProvincia"] . "</option>";
                }
                ?>
            </select>
        </label>
        <label for="ciudad">
            <input type="text" name="ciudad" id="ciudad" placeholder="Introduce tu Ciudad">
        </label>
    </div>
    <div class="form ">
        <h3>Datos de Estudios</h3>
        <label for="uEstudio">
            <select name="uEstudio" id="uEstudio">
                <option value="">Introduce tu Nivel de Estudio</option>
                <?php
                $consulta = "SELECT * FROM nivelestudios";
                $resultado = mysqli_query($link, $consulta);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $fila["idEstudios"] . "'>" . $fila["nombreNivel"] . "</option>";
                }
                ?>
            </select>
        </label>
        <label for="fEstudio">
            <input type="date" name="fEstudio" id="fEstudio">
        </label>
    </div>
    <input type="hidden" name="origen" value="form1">
    <input type="submit" name="enviarFormulario1" value="Siguiente">
    <?php
    if (!empty($_GET["errores"])) {
        echo "<p style='color: red'>" . $_GET["errores"]. "</p>";
    }
    ?>
</form>
</body>
</html>