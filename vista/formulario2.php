<?php
include_once("header.php");
?>
<h1>Formulario de Alta de nuevo Alumno</h1>
<h2>Datos Persona Contacto Auxiliar del Alumno</h2>
<form action="../controlador/controlador.php" method="post">
    <div class="form">
        <h3>Contacto Familiar</h3>
        <label for="nombreFamiliar">
            <input type="text" id="nombreFamiliar" name="nombreFamiliar" placeholder="Nombre persona Contacto">
        </label>
        <label for="telefonoFamiliar">
            <input type="text" id="telefonoFamiliar" name="telefonoFamiliar" placeholder="Teléfono persona Contacto">
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
    <label for="checkbox" name="checkbox" class="checkbox">
        <input type="checkbox" id="checkbox">
        <p>Acepto las <a href="https://es.linkedin.com/in/andr%C3%A9s-%C3%A1lvarez-rubio-868289217" target="_blank">Condiciones y Políticas de Privacidad</a></p>
    </label>
    <input type="submit" name="enviarFormulario2" value="Siguiente">
    <?php
    if (!empty($_GET["errores"])) {
        echo "<p style='color: red'>" . $_GET["errores"]. "</p>";
    }
    ?>
</form>
<?php
include_once("footer.php");
?>