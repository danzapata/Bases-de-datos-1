<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Animales más pesados y sin cuidador encargado</h1>

<p class="mt-3">
    El primer botón muestra los datos de los tres animales de mayor 
    peso y que no tienen cuidador encargado. 
    Ademas, se  muestra para cada uno de estos tres animales 
    los datos correspondientes de su cuidador registrador.
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT 
    a.*, 
    a.nombre AS nombre_animal,
    c.*
FROM 
    animal a
JOIN 
	cuidador c ON a.cuidador_registrador = c.cédula 
WHERE 
    a.cuidador_encargado IS NULL
ORDER BY 
    a.peso_actual DESC
LIMIT 3;";


// Ejecutar la consulta
$resultadoC1 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC1 and $resultadoC1->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Fauna_id</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Peso_actual</th>
                <th scope="col" class="text-center">Fecha_ingreso</th>
                <th scope="col" class="text-center">Encargado</th>

                <th scope="col" class="text-center">C.C.registrador</th>
                <th scope="col" class="text-center">Nombre_registrador</th>
                <th scope="col" class="text-center">Fecha_contratación</th>
                <th scope="col" class="text-center">Recinto</th>
                <th scope="col" class="text-center">Cargo_especifico</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC1 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["fauna_id"]; ?></td>
                <td class="text-center"><?= $fila["nombre_animal"]; ?></td>
                <td class="text-center"><?= $fila["peso_actual"]; ?></td>
                <td class="text-center"><?= $fila["fecha_ingreso"]; ?></td>
                <td class="text-center"><?= $fila["cuidador_encargado"]; ?></td>

                <td class="text-center"><?= $fila["cuidador_registrador"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["fecha_contratación"]; ?></td>
                <td class="text-center"><?= $fila["recinto"]; ?></td>
                <td class="text-center"><?= $fila["cargo_especifico"]; ?></td>
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

include "../includes/footer.php";
?>