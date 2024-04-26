<?php
// db_config.php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "encuesta";

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$query = "SELECT * FROM SustainabilityForm";
$result = $conn->query($query);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

// Retornar los resultados en formato JSON
header('Content-Type: application/json');
echo json_encode(array('data' => $data));

$conn->close();
?>
