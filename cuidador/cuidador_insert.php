<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$cédula = $_POST["cédula"];
$nombre = $_POST["nombre"];
$fecha_contratación = $_POST["fecha_contratación"];
$recinto = isset($_POST["recinto"]) && $_POST["recinto"] !== "" ? $_POST["recinto"] : "NULL";
$cargo_especifico = $_POST["cargo_especifico"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `cuidador`(`cédula`,`nombre`, `fecha_contratación`, `recinto`, `cargo_especifico`) 
          VALUES ('$cédula', '$nombre', '$fecha_contratación', $recinto, '$cargo_especifico')";


// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: cuidador.php");
else:
	echo "Ha ocurrido un error al crear la persona";
endif;

mysqli_close($conn);