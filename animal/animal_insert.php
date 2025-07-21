<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$fauna_id = $_POST["fauna_id"];
$nombre = $_POST["nombre"];
$peso_actual = $_POST["peso_actual"];
$fecha_ingreso = $_POST["fecha_ingreso"];
$cuidador_registrador = $_POST["cuidador_registrador"];
$cuidador_encargado = $_POST["cuidador_encargado"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `animal`(`fauna_id`,`nombre`, `peso_actual`, `fecha_ingreso`, `cuidador_registrador`, `cuidador_encargado`) VALUES ('$fauna_id', '$nombre', '$peso_actual', '$fecha_ingreso', '$cuidador_registrador', '$cuidador_encargado')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: animal.php");
else:
	echo "Ha ocurrido un error al crear el animal";
endif;

mysqli_close($conn);