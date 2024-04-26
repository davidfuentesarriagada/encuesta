<?php
// handle_form.php

// Configuración de la conexión a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$dbname = "encuesta";

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);


// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
    
}

$conn->set_charset("utf8mb4");


$company_rut = $_POST['company_rut'] ?? '';
$rutPattern = '/^\d{7,8}-\d{1}$/';
// Recuperar datos del formulario
$company_name = $_POST['company_name'] ?? '';

if (!preg_match($rutPattern, $company_rut)) {
    die("El RUT ingresado no tiene un formato válido. Debe ser como 12345678-9.");
}

// Verificar que se recibieron los datos esperados
if (isset($_POST['valor_minero']) && isset($_POST['categorias_productos'])) {
    $cadena_valor_minero = implode(',', $_POST['valor_minero']);
    $categorias_oferta = implode(',', $_POST['categorias_productos']);

    // Resto del código para la inserción en la base de datos...
} else {
    echo "No se recibieron los datos de las selecciones múltiples correctamente.";
    // Puedes imprimir todo el POST para revisar qué fue lo que se recibió
   
    exit; // Detiene la ejecución para que puedas ver los datos
}



$abastecimiento_sostenible = isset($_POST['sustainable_supply']) && $_POST['sustainable_supply'] === 'yes' ? 'sí' : 'no';
$eficiencia_consumo = isset($_POST['efficiency_improvement']) ? ($_POST['efficiency_improvement'] === 'yes' ? 'sí' : ($_POST['efficiency_improvement'] === 'no' ? 'no' : 'no se ha evaluado')) : 'no se ha evaluado';
$impactos_ambientales = isset($_POST['environmental_impact']) && $_POST['environmental_impact'] === 'yes' ? 'sí' : 'no';
$cumple_normativa = isset($_POST['compliance']) && $_POST['compliance'] === 'yes' ? 'sí' : 'no';
$informa_prioridades_mineras = isset($_POST['mining_info']) && $_POST['mining_info'] === 'yes' ? 'sí' : 'no';
$alternativa_durable = isset($_POST['disposable']) ? ($_POST['disposable'] === 'yes' ? 'sí' : ($_POST['disposable'] === 'no' ? 'no' : 'no se ha evaluado')) : 'no se ha evaluado';
$alternativa_eficiencia_energetica = isset($_POST['energy_consumption']) ? ($_POST['energy_consumption'] === 'yes' ? 'sí' : ($_POST['energy_consumption'] === 'no' ? 'no' : 'no se ha evaluado')) : 'no se ha evaluado';


// Detalles de impactos ambientales, normativa, etc., si están disponibles
$impactos_ambientales_detalles = $_POST['impact_details'] ?? null;
$detalles = [];
for($i = 1; $i <= 4; $i++) {
    if(isset($_POST["compliance_detail_$i"]) && !empty($_POST["compliance_detail_$i"])) {
        $detalles[] = $_POST["compliance_detail_$i"];
    }
}
$normativa_detalles = implode(', ', $detalles);

$prioridades_mineras_detalles = $_POST['mining_info_details'] ?? null;
$consumo_energia = isset($_POST['energy_consumption']) ? ($_POST['energy_consumption'] === 'yes' ? 'sí' : ($_POST['energy_consumption'] === 'no' ? 'no' : 'no se ha evaluado')) : 'no se ha evaluado';

$alternativa_eficiencia_energetica_detalles = $_POST['energy_consumption_details'] ?? null;

if ($alternativa_eficiencia_energetica === 'not-evaluated') {
    $alternativa_eficiencia_energetica = 'No se ha evaluado';
}


// Las prioridades pueden ser nulas si no se selecciona nada
$prioridad_impactos_ambientales = $_POST['priority_environmental'] ?? null;
$prioridad_impactos_sociales = $_POST['priority_social'] ?? null;

// Cadena de valor minero y categorías de oferta como texto, separado por comas
$cadena_valor_minero = implode(',', $_POST['valor_minero'] ?? []);
$categorias_oferta = implode(',', $_POST['categorias_productos'] ?? []);


// Preparar la sentencia SQL
$sql = "INSERT INTO sustainabilityform (company_name, company_rut, cadena_valor_minero, categorias_oferta, abastecimiento_sostenible, eficiencia_consumo, impactos_ambientales, impactos_ambientales_detalles, prioridad_impactos_ambientales, prioridad_impactos_sociales, cumple_normativa, normativa_detalles, informa_prioridades_mineras, prioridades_mineras_detalles, alternativa_durable, alternativa_eficiencia_energetica, alternativa_eficiencia_energetica_detalles) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Verifica que la sentencia se haya preparado correctamente
if (!$stmt) {
    die("Error al preparar la sentencia: " . $conn->error);
}


// Vincular parámetros para marcadores
$stmt->bind_param(
    "sssssssssssssssss", // Asegúrate de que haya un tipo por cada variable que estás vinculando.
    $company_name,
    $company_rut,
    $cadena_valor_minero,
    $categorias_oferta,
    $abastecimiento_sostenible,
    $eficiencia_consumo,
    $impactos_ambientales,
    $impactos_ambientales_detalles,
    $prioridad_impactos_ambientales,
    $prioridad_impactos_sociales,
    $cumple_normativa,
    $normativa_detalles,
    $informa_prioridades_mineras,
    $prioridades_mineras_detalles,
    $alternativa_durable,
    $alternativa_eficiencia_energetica,
    $alternativa_eficiencia_energetica_detalles
);





// Ejecutar la sentencia
if ($stmt->execute()) {
    echo "<script type='text/javascript'>
            alert('Gracias, por responder nuestro formulario');
            window.location = 'encuesta.html';
          </script>";
} else {
    echo "<script type='text/javascript'>
            alert('Error: " . addslashes($stmt->error) . "');
            window.location = 'segundaSeccionFormulario.php'; // O la página que desees mostrar en caso de error
          </script>";
}



// Cerrar sentencia y conexión
$stmt->close();
$conn->close();
?>

