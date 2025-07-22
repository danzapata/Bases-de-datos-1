<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Animales dentro del rango de fechas de recinto</h1>

<p class="mt-3">
    Se debe ingresar: El código de un recinto.
    Se muestran todos los animales que tienen como encargado al cuidador que preserva 
    a dicho recinto, pero siempre y cuando la fecha de ingreso de dichos animales estén por 
    fuera del intervalo de fechas de dicho recinto, es decir antes de la creacíon del recinto y despues del 
    último mantenimiento del mismo.
</p>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <!-- En esta caso, el Action va a esta mismo archivo -->
    <form action="busqueda1.php" method="post" class="form-group">

        <div class="mb-3">
            <label for="código_recinto" class="form-label">Código_recinto</label>
            <input type="number" class="form-control" id="código_recinto" name="código_recinto" min="0" required>
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>

    </form>
    
</div>

<?php
// Dado que el action apunta a este mismo archivo, hay que hacer eata verificación antes
if ($_SERVER['REQUEST_METHOD'] === 'POST'):

    // Crear conexión con la BD
    require('../config/conexion.php');

    $código_recinto = $_POST["código_recinto"];

    // Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
    $query = "SELECT a.*
              FROM animal a
              JOIN cuidador c ON a.cuidador_encargado = c.cédula
              JOIN recinto r ON c.recinto = r.código
              WHERE r.código = '$código_recinto' 
                AND (
                  a.fecha_ingreso < r.fecha_creación OR
                  a.fecha_ingreso > r.fecha_último_mantenimiento
              );";
 
    // Ejecutar la consulta
    $resultadoB1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    mysqli_close($conn);

    // Verificar si llegan datos
    if($resultadoB1 and $resultadoB1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Fauna_ID</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Peso_actual</th>
                <th scope="col" class="text-center">Fecha_ingreso</th>
                <th scope="col" class="text-center">Cuidador_registrador</th>
                <th scope="col" class="text-center">Cuidador_encargado</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoB1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["fauna_id"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["peso_actual"]; ?></td>
                <td class="text-center"><?= $fila["fecha_ingreso"]; ?></td>
                <td class="text-center"><?= $fila["cuidador_registrador"]; ?></td>
                <td class="text-center"><?= $fila["cuidador_encargado"]; ?></td>
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