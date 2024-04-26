<?php
// Datos de conexión a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$dbname = "encuesta";

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el RUT enviado desde el formulario
$company_rut = $_POST['rut'] ?? '';

// Consulta para verificar si el RUT ya existe
$query = "SELECT * FROM estadisticadegenero WHERE company_rut = '$company_rut'";
$resultado = $conn->query($query);

if ($resultado->num_rows > 0) {
    // El RUT ya existe
    echo "existe";
} else {
    // El RUT no existe
    echo "no existe";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
