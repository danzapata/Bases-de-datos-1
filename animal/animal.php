<?php
include "../includes/header.php";
?>

<!-- TÍTULO. Cambiarlo, pero dejar especificada la analogía -->
<h1 class="mt-3">Entidad análoga a REPARACIÓN (ANIMAL)</h1>

<!-- FORMULARIO. Cambiar los campos de acuerdo a su trabajo -->
<div class="formulario p-4 m-3 border rounded-3">

    <form action="animal_insert.php" method="post" class="form-group" autocomplete="off">

        <div class="mb-3">
            <label for="faunaid" class="form-label">FaunaID</label>
            <input type="number" class="form-control" id="faunaid" name="faunaid" min="0" required>
        </div>
       
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="pesoactual" class="form-label">Peso actual</label>
            <input type="number" class="form-control" id="pesoactual" name="pesoactual" min="0" required>
        </div>

        <div class="mb-3">
            <label for="fechaingreso" class="form-label">Fecha de ingreso</label>
            <input type="date" class="form-control" id="fechaingreso" name="fechaingreso" required>
        </div>
        
        <!-- Consultar la lista de cuidadores y desplegarlos -->
        <div class="mb-3">
            <label for="cuidadorregistrador" class="form-label">Cuidador registrador</label>
            <select name="cuidadorregistrador" id="cuidadorregistrador" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../cuidador/cuidador_select.php");
                
                // Verificar si llegan datos
                if($resultadoCuidador):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCuidador as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["cédula"]; ?>"><?= $fila["nombre"]; ?> - C.C. <?= $fila["cédula"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>
        
        <!-- Consultar la lista de cuidadores y desplegarlos -->
        <div class="mb-3">
            <label for="cuidadorencargado" class="form-label">Cuidador encargado</label>
            <select name="cuidadorencargado" id="cuidadorencargado" class="form-select">
                
                <!-- Option por defecto -->
                <option value="" selected disabled hidden></option>

                <?php
                // Importar el código del otro archivo
                require("../cuidador/cuidador_select.php");
                
                // Verificar si llegan datos
                if($resultadoCuidador):
                    
                    // Iterar sobre los registros que llegaron
                    foreach ($resultadoCuidador as $fila):
                ?>

                <!-- Opción que se genera -->
                <option value="<?= $fila["cédula"]; ?>"><?= $fila["nombre"]; ?> - C.C. <?= $fila["cédula"]; ?></option>

                <?php
                        // Cerrar los estructuras de control
                    endforeach;
                endif;
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Agregar</button>

    </form>
    
</div>

<?php
// Importar el código del otro archivo
require("animal_select.php");
            
// Verificar si llegan datos
if($resultadoAnimal and $resultadoAnimal->num_rows > 0):
?>

<!-- MOSTRAR LA TABLA. Cambiar las cabeceras -->
<div class="tabla mt-5 mx-3 rounded-3 overflow-hidden">

    <table class="table table-striped table-bordered">

        <!-- Títulos de la tabla, cambiarlos -->
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">FaunaID</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">Peso actual</th>
                <th scope="col" class="text-center">Fecha de ingreso</th>
                <th scope="col" class="text-center">Cuidador registrador</th>
                <th scope="col" class="text-center">Cuidador encargado</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>

            <?php
            // Iterar sobre los registros que llegaron
            foreach ($resultadoAnimal as $fila):
            ?>

            <!-- Fila que se generará -->
            <tr>
                <!-- Cada una de las columnas, con su valor correspondiente -->
                <td class="text-center"><?= $fila["faunaid"]; ?></td>
                <td class="text-center"><?= $fila["nombre"]; ?></td>
                <td class="text-center"><?= $fila["pesoactual"]; ?></td>
                <td class="text-center"><?= $fila["fechaingreso"]; ?></td>
                <td class="text-center"><?= $fila["cuidadorregistrador"]; ?></td>
                <td class="text-center"><?= $fila["cuidadorencargado"]; ?></td>
                
                <!-- Botón de eliminar. Debe de incluir la CP de la entidad para identificarla -->
                <td class="text-center">
                    <form action="animal_delete.php" method="post">
                        <input hidden type="text" name="faunaidEliminar" value="<?= $fila["faunaid"]; ?>">
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