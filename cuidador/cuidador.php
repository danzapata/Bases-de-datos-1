<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a MECÁNICO (CUIDADOR)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="cuidador_insert.php" method="post" class="form-group" autocomplete="off">

        <div class="mb-3">
            <label for="cédula" class="form-label">Cédula</label>
            <input type="number" class="form-control" id="cédula" name="cédula" min="0" required>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="fechacontratación" class="form-label">Fecha de contratación</label>
            <input type="date" class="form-control" id="fechacontratación" name="fechacontratación" required>
        </div>
        
        <!-- Consultar la lista de recintos y desplegarlos -->
        <div class="mb-3">
            <label for="recinto" class="form-label">Recinto</label>
            <select name="recinto" id="recinto" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../recinto/recinto_select.php");
                
                // Verificar si llegan datos
                if($resultadoRecinto):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoRecinto as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["código"]; ?>"><?= $fila["tipohábitat"]; ?> - Code <?= $fila["código"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        
        <div class="mb-3">
          <label for="tipo" class="form-label">Tipo</label>
          <select name="tipo" id="tipo" class="form-select" required>
            <option value="" selected disabled hidden>Seleccione tipo...</option>
            <option value="Cuidador">Cuidador</option>
            <option value="Veterinario">Vetenerinario</option>
          </select>
        </div>

        <div class="mb-3">
            <label for="cargoespecifico" class="form-label">Cargo especifico</label>
            <input type="text" class="form-control" id="cargoespecifico" name="cargoespecifico">
        </div>

        <div class="mb-3">
            <label for="especialidadmedica" class="form-label">Especialidad medica</label>
            <input type="text" class="form-control" id="especialidadmedica" name="especialidadmedica">
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("cuidador_select.php");

// Verificar si llegan datos
if($resultadoCuidador and $resultadoCuidador->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">Cédula</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Fecha de contratación</th>
                <th scope="col" class="text-center">Recinto</th>
                <th scope="col" class="text-center">Tipo</th>
                <th scope="col" class="text-center">Especialidad medica</th>
                <th scope="col" class="text-center">Cargo especifico</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoCuidador as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["cédula"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["fechacontratación"]; ?></td>
                <td class="text-center"><?= $fila["recinto"]; ?></td>
                <td class="text-center"><?= $fila["tipo"]; ?></td>
                <td class="text-center"><?= $fila["especialidadmedica"]; ?></td>
                <td class="text-center"><?= $fila["cargoespecifico"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="cuidador_delete.php" method="post">
                        <input hidden type="text" name="cédulaEliminar" value="<?= $fila["cédula"]; ?>">
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