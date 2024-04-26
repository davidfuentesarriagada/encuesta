<?php


    session_start();

    header('Content-Type: application/json');


    var_dump("hola"); 
    error_log("como estas?");

    $json = file_get_contents('php://input');
    error_log("JSON recibido: " . $json); // Esto imprimirá la cadena JSON cruda en el log
        
    $datos = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Error al decodificar JSON: " . json_last_error_msg());
    }

    /*$datos = json_decode($json, true);
    error_log($datos['company_name'] );
    error_log($datos['company_rut'] );
    error_log($datos['antiguedad_menos_1_mujeres_propias'] );
    error_log($datos['antiguedad_menos_1_mujeres_contratistas'] );
    error_log($datos['antiguedad_menos_1_hombres_propios'] );
    error_log($datos['antiguedad_menos_1_hombres_contratistas'] );
    error_log($datos['tipo_proveedor'] );*/

  

    

        
   /* $json_error = json_last_error_msg();
    if ($json_error != 'No error') {
        error_log("Error al decodificar JSON: " . $json_error);
    }
        
    $datos = json_decode($json, true);
    
    var_dump($datos); 
    error_log($datos.company_name); 
    

    error_log("Datos recibidos: " . print_r($datos, true)); // Esto te mostrará exactamente qué datos se reciben*/


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        
            // Validation
            $rutPattern = '/^\d{7,8}-(\d|k|K)$/';
            $errores = [];

            if (empty($datos['company_name'])) {
                $errores['company_name'] = "El nombre de la empresa es obligatorio.";
            }

            if (empty($datos['company_rut']) || !preg_match($rutPattern, $datos['company_rut'])) {
                $errores['company_rut'] = "El RUT de la empresa no es válido o está vacío.";
            }

            // Check if tipo_proveedor is an array and has no more than 3 elements
            if (!is_array($datos['tipo_proveedor']) || count($datos['tipo_proveedor']) > 3) {
                $errores['tipo_proveedor'] = "Debe seleccionar hasta 3 tipos de proveedor.";
            }

            // More validations can be added here...

            // If there are any validation errors, stop execution and return errors
            if (!empty($errores)) {
                echo json_encode(['errores' => $errores]);
                exit;
            }

            // Database connection data
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "encuesta";

            // Create connection
            $conn = new mysqli($host, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare the SQL statement for insertion
            $stmt = $conn->prepare("INSERT INTO estadisticadegenero (company_name, company_rut, antiguedad_menos_1_mujeres_propias, antiguedad_menos_1_mujeres_contratistas, antiguedad_menos_1_hombres_propios, antiguedad_menos_1_hombres_contratistas, tipo_proveedor) VALUES (?, ?, ?, ?, ?, ?, ?)");

            // JSON encode the tipo_proveedor array for storage
            $tipo_proveedor_json = json_encode($datos['tipo_proveedor']);

            // Bind the parameters
            $stmt->bind_param("sssssss", $datos['company_name'], $datos['company_rut'], $datos['antiguedad_menos_1_mujeres_propias'], $datos['antiguedad_menos_1_mujeres_contratistas'], $datos['antiguedad_menos_1_hombres_propios'], $datos['antiguedad_menos_1_hombres_contratistas'], $tipo_proveedor_json);

            // Execute the statement and handle any errors
            if ($stmt->execute()) {
                echo json_encode(['resultado' => 'Datos guardados con éxito.']);
            } else {
                echo json_encode(['error' => 'Error al guardar los datos: ' . $stmt->error]);
            }

            // Close the statement and connection
            $stmt->close();
            $conn->close();
        }
    }
?>