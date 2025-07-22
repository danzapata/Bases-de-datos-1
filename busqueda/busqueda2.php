<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Búsqueda de Recinto por Animal</h1>

<p class="mt-3">
    Se debe ingresar: El código de un animal.
    Se muestran todos los datos del recinto supervisado por el cuidador 
    que registró a dicho animal. 
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda2.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="fauna_id" class="form-label">Fauna_id</label>
            <input type="number" class="form-control" id="fauna_id" name="fauna_id" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $fauna_id = $_POST["fauna_id"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT recinto.*
              FROM recinto
              WHERE recinto.código = (
                  SELECT cuidador.recinto
                  FROM cuidador 
                  WHERE cuidador.cédula = (
                      SELECT cuidador_registrador 
                      FROM animal
                      WHERE animal.fauna_id = '$fauna_id'
                  )
              )";

    // Ejecutar la consulta
    $resultadoB2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB2 and $resultadoB2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Capacidad</th>
                <th scope="col" class="text-center">Tipo_hábitat</th>
                <th scope="col" class="text-center">Fecha_creación</th>
                <th scope="col" class="text-center">fecha_último_mantenimiento</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["código"]; ?></td>
                <td class="text-center"><?= $fila["capacidad"]; ?></td>
                <td class="text-center"><?= $fila["tipo_hábitat"]; ?></td>
                <td class="text-center"><?= $fila["fecha_creación"]; ?></td>
                <td class="text-center"><?= $fila["fecha_último_mantenimiento"]; ?></td>
            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<!-- Mensaje de error si no hay resultados -->
<?php
else:
?>

<div class="alert alert-danger text-center mt-5">
    No se encontraron resultados para esta consulta
</div>

<?php
    endif;
endif;

include "../includes/footer.php";
?>