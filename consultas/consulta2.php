<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Cuidadores encargados no registradores</h1>

<p class="mt-3">
    El segundo botón muestra los datos de los cuidadores que estan preservando un recinto,y que estan acargo 
     de al menos dos (≥ 2 animales) animales y que nunca han sido registradores.
</p>

<?php
// Crear conexión con la BD
require('../config/conexion.php');

// Query SQL a la BD -> Crearla acá (No está completada, cambiarla a su contexto y a su analogía)
$query = "SELECT 
    c.cédula,
    c.nombre,
    c.fecha_contratación,
    c.recinto,
    c.cargo_especifico,
    COUNT(a_enc.fauna_id) AS animales_encargado
FROM cuidador c
JOIN animal a_enc 
  ON c.cédula = a_enc.cuidador_encargado
WHERE 
    c.recinto IS NOT NULL
    AND
    c.cédula NOT IN (
      SELECT DISTINCT a_reg.cuidador_registrador
      FROM animal a_reg
      WHERE a_reg.cuidador_registrador IS NOT NULL
    )
GROUP BY 
    c.cédula,
    c.nombre,
    c.fecha_contratación,
    c.recinto,
    c.cargo_especifico
HAVING 
    COUNT(a_enc.fauna_id) >= 2;";

// Ejecutar la consulta
$resultadoC2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

mysqli_close($conn);
?>

<?php
// Verificar si llegan datos
if($resultadoC2 and $resultadoC2->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Cédula</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Fecha_contratación</th>
                <th scope="col" class="text-center">Recinto</th>
                <th scope="col" class="text-center">Cargo_especifico</th>
                

            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoC2 as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["cédula"]; ?></td>
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