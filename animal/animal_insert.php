<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$faunaid = $_POST["faunaid"];
$nombre = $_POST["nombre"];
$pesoactual = $_POST["pesoactual"];
$fechaingreso = $_POST["fechaingreso"];
$cuidadorregistrador = $_POST["cuidadorregistrador"];
$cuidadorencargado = $_POST["cuidadorencargado"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `animal`(`faunaid`,`nombre`, `pesoactual`, `fechaingreso`, `cuidadorregistrador`, `cuidadorencargado`) VALUES ('$faunaid', '$nombre', '$pesoactual', '$fechaingreso', '$cuidadorregistrador', '$cuidadorencargado')";

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