<?php
 
// Crear conexión con la BD
require('../config/conexion.php');

// Sacar los datos del formulario. Cada input se identifica con su "name"
$código = $_POST["código"];
$tipohábitat = $_POST["tipohábitat"];
$capacidad = $_POST["capacidad"];
$fechacreación = $_POST["fechacreación"];
$fechaúltimomantenimiento = $_POST["fechaúltimomantenimiento"];

// Query SQL a la BD. Si tienen que hacer comprobaciones, hacerlas acá (Generar una query diferente para casos especiales)
$query = "INSERT INTO `recinto`(`código`,`tipohábitat`, `capacidad`, `fechacreación`, `fechaúltimomantenimiento`) VALUES ('$código', '$tipohábitat', '$capacidad', '$fechacreación', '$fechaúltimomantenimiento')";

// Ejecutar consulta
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

// Redirigir al usuario a la misma pagina
if($result):
    // Si fue exitosa, redirigirse de nuevo a la página de la entidad
	header("Location: recinto.php");
else:
	echo "Ha ocurrido un error al crear el recinto";
endif;

mysqli_close($conn);