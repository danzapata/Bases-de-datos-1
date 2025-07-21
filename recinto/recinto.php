<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a CONTRATO (RECINTO)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="recinto_insert.php" method="post" class="form-group" autocomplete="off">

        <div class="mb-3">
            <label for="código" class="form-label">Código</label>
            <input type="number" class="form-control" id="código" name="código" min="0" required>
        </div>

        <div class="mb-3">
            <label for="tipo_hábitat" class="form-label">Tipo_hábitat</label>
            <input type="text" class="form-control" id="tipo_hábitat" name="tipo_hábitat" required>
        </div>

        <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad</label>
            <input type="number" class="form-control" id="capacidad" name="capacidad" min="0" required>
        </div>

        <div class="mb-3">
            <label for="fecha_creación" class="form-label">Fecha_creación</label>
            <input type="date" class="form-control" id="fecha_creación" name="fecha_creación" required>
        </div>

        <div class="mb-3">
            <label for="fecha_último_mantenimiento" class="form-label">Fecha_último_mantenimiento</label>
            <input type="date" class="form-control" id="fecha_último_mantenimiento" name="fecha_último_mantenimiento" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("recinto_select.php");

// Verificar si llegan datos
if($resultadoRecinto and $resultadoRecinto->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Tipo_hábitat</th>
                <th scope="col" class="text-center">Capacidad</th>
                <th scope="col" class="text-center">Fecha_creación</th>
                <th scope="col" class="text-center">Fecha_último_mantenimiento</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoRecinto as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["código"]; ?></td>
                <td class="text-center"><?= $fila["tipo_hábitat"]; ?></td>
                <td class="text-center"><?= $fila["capacidad"]; ?></td>
                <td class="text-center"><?= $fila["fecha_creación"]; ?></td>
                <td class="text-center"><?= $fila["fecha_último_mantenimiento"]; ?></td>

                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="recinto_delete.php" method="post">
                        <input hidden type="text" name="códigoEliminar" value="<?= $fila["código"]; ?>">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>

            </tr>

            <?php
            // Cerrar los estructuras de control
            endforeach;
            ?>

        </tbody>

    </table>
</div>

<?php
endif;

include "../includes/footer.php";
?>