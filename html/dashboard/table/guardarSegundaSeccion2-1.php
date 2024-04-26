<?php


    session_start();

    $json = file_get_contents('php://input');
        error_log("JSON recibido: " . $json); // Esto imprimirá la cadena JSON cruda en el log

        $datos = json_decode($json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("Error al decodificar JSON: " . json_last_error_msg());
        }

        
    $json_error = json_last_error_msg();
    if ($json_error != 'No error') {
        error_log("Error al decodificar JSON: " . $json_error);
    }
        
    $datos = json_decode($json, true);
    
    var_dump($datos); 

    error_log("Datos recibidos: " . print_r($datos, true)); // Esto te mostrará exactamente qué datos se reciben


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
    
        // Definir la función guardarDatos antes de usarla
        function guardarDatos($conn, $datos) {
            // Construir la parte de las columnas de la consulta SQL
            $columnas = implode(', ', array_keys($datos));

            // Crear una cadena de placeholders para los valores
            $placeholders = rtrim(str_repeat('?, ', count($datos)), ', ');

            // Construir la consulta SQL completa
            $sql = "INSERT INTO estadisticadegenero ($columnas) VALUES ($placeholders)";

            // Preparar la consulta
            $stmt = $conn->prepare($sql);

            // Vincular los valores a los placeholders
            $tipos = str_repeat('s', count($datos)); // Asumiendo que todos los valores son cadenas
            $stmt->bind_param($tipos, ...array_values($datos));

            // Devolver el objeto $stmt preparado
            return $stmt;
        }
    
        // Recoger los datos del formulario
        $company_name = $_POST['company_name'] ?? '';
        $company_rut = $_POST['company_rut'] ?? '';
        // Modificar la expresión regular para aceptar un número de 7 a 8 dígitos seguido de un guion y un dígito o 'k'/'K'
        $rutPattern = '/^\d{7,8}-(\d|k|K)$/';
        if (!preg_match($rutPattern, $company_rut)) {
            die("El RUT ingresado no tiene un formato válido. Debe ser como 12345678-9 o 12345678-K.");
        }

        $total_personal_propio = $_POST['total_personal_propio'] ?? 0;
        $total_personal_contratista = $_POST['total_personal_contratista'] ?? 0;
        if (isset($_POST['tipo_proveedor']) && !empty($_POST['tipo_proveedor'])) {
            $tipo_proveedor_seleccionados = array_map(function($valor) use ($conn) {
                return $conn->real_escape_string($valor);
            }, $_POST['tipo_proveedor']);
        
            $tipo_proveedor_cadena = implode(',', $tipo_proveedor_seleccionados);
        } else {
            $tipo_proveedor_cadena = ""; // Usar cadena vacía en lugar de NULL
        }
        
        
        $procesosCadenaValor = array_map(function($valor) use ($conn) {
            return $conn->real_escape_string($valor);
        }, $_POST['procesos_cadena_valor']);
        
        $cadenaValorMinero = implode(',', $procesosCadenaValor);
        //edead de 18-30 años
        $mujeres_18_30_propios = $_POST['mujeres_18_30_propios'] ?? 0;
        $mujeres_18_30_contratistas = $_POST['mujeres_18_30_contratistas'] ?? 0;
        $hombres_18_30_propios = $_POST['hombres_18_30_propios'] ?? 0;
        $hombres_18_30_contratistas = $_POST['hombres_18_30_contratistas'] ?? 0;
        $observaciones_18_30 = $_POST['observaciones_18_30'] ?? '';

        // edad de 31-40

        $mujeres_31_40_propios = $_POST['mujeres_31_40_propios'] ?? 0;
        $mujeres_31_40_contratistas = $_POST['mujeres_31_40_contratistas'] ?? 0;
        $hombres_31_40_propios = $_POST['hombres_31_40_propios'] ?? 0;
        $hombres_31_40_contratistas = $_POST['hombres_31_40_contratistas'] ?? 0;
        $observaciones_31_40 = $_POST['observaciones_31_40'] ?? '';

        //edad de 41-50

        $mujeres_41_50_propios = $_POST['mujeres_41_50_propios'] ?? 0;
        $mujeres_41_50_contratistas = $_POST['mujeres_41_50_contratistas'] ?? 0;
        $hombres_41_50_propios = $_POST['hombres_41_50_propios'] ?? 0;
        $hombres_41_50_contratistas = $_POST['hombres_41_50_contratistas'] ?? 0;
        $observaciones_41_50 = $_POST['observaciones_41_50'] ?? '';

        //edad de 51-60

        $mujeres_51_60_propios = $_POST['mujeres_51_60_propios'] ?? 0;
        $mujeres_51_60_contratistas = $_POST['mujeres_51_60_contratistas'] ?? 0;
        $hombres_51_60_propios = $_POST['hombres_51_60_propios'] ?? 0;
        $hombres_51_60_contratistas = $_POST['hombres_51_60_contratistas'] ?? 0;
        $observaciones_51_60 = $_POST['observaciones_51_60'] ?? '';

        //mayor o igual a 61

        $mujeres_61_propios = $_POST['mujeres_61_propios'] ?? 0;
        $mujeres_61_contratistas = $_POST['mujeres_61_contratistas'] ?? 0;
        $hombres_61_propios = $_POST['hombres_61_propios'] ?? 0;
        $hombres_61_contratistas = $_POST['hombres_61_contratistas'] ?? 0;
        $observaciones_61 = $_POST['observaciones_61'] ?? '';


        //antigüedad menos 1 año
        // Utilizando el operador de fusión null para asignar valores predeterminados
        $antiguedad_menos_1_mujeres_propias = $datos['antiguedad_menos_1_mujeres_propias'] ?? '0';
        $antiguedad_menos_1_mujeres_contratistas = $datos['antiguedad_menos_1_mujeres_contratistas'] ?? 0;
        $antiguedad_menos_1_hombres_propios = $datos['antiguedad_menos_1_hombres_propios'] ?? 0;
        $antiguedad_menos_1_hombres_contratistas = $datos['antiguedad_menos_1_hombres_contratistas'] ?? 0;
        $observaciones_menos_1 = $_POST['observaciones_menos_1'] ?? '';
        


        $total_mujeres_propios = $_POST['total_mujeres_propios'] ?? 0;
        $total_mujeres_contratistas = $_POST['total_mujeres_contratistas'] ?? 0;
        $total_hombres_propios = $_POST['total_hombres_propios'] ?? 0;
        $total_hombres_contratistas = $_POST['total_hombres_contratistas'] ?? 0;
        $total_antiguedad_mujeres_propias = $_POST['total_antiguedad_mujeres_propias'] ?? 0;
        $total_antiguedad_mujeres_contratistas = $_POST['total_antiguedad_mujeres_contratistas'] ?? 0;
        $total_antiguedad_hombres_propios = $_POST['total_antiguedad_hombres_propios'] ?? 0;
        $total_antiguedad_hombres_contratistas = $_POST['total_antiguedad_hombres_contratistas'] ?? 0;
        $total_cargo_mujeres_propias = $_POST['total_cargo_mujeres_propias'] ?? 0;
        $total_cargo_mujeres_contratistas = $_POST['total_cargo_mujeres_contratistas'] ?? 0;
        $total_cargo_hombres_propios = $_POST['total_cargo_hombres_propios'] ?? 0;
        $total_cargo_hombres_contratistas = $_POST['total_cargo_hombres_contratistas'] ?? 0;
        $total_propios_mujeres_profesion = $_POST['total_propios_mujeres_profesion'] ?? 0;
        $total_contratistas_mujeres_profesion = $_POST['total_contratistas_mujeres_profesion'] ?? 0;
        $total_propios_hombres_profesion = $_POST['total_propios_hombres_profesion'] ?? 0;
        $total_contratistas_hombres_profesion = $_POST['total_contratistas_hombres_profesion'] ?? 0;
        $total_escolaridad_propios_mujeres = $_POST['total_escolaridad_propios_mujeres'] ?? 0;
        $total_escolaridad_contratistas_mujeres = $_POST['total_escolaridad_contratistas_mujeres'] ?? 0;
        $total_escolaridad_propios_hombres = $_POST['total_escolaridad_propios_hombres'] ?? 0;
        $total_escolaridad_contratistas_hombres = $_POST['total_escolaridad_contratistas_hombres'] ?? 0;
    
        // Guardar los datos en la base de datos
        $stmt = guardarDatos($conn, [
            'company_name' => $company_name,
            'company_rut' => $company_rut,
            'mujeres_18_30_propios' => $mujeres_18_30_propios,
            'mujeres_18_30_contratistas' => $mujeres_18_30_contratistas,
            'hombres_18_30_propios' => $hombres_18_30_propios,
            'hombres_18_30_contratistas' => $hombres_18_30_contratistas,
            'observaciones_18_30' => $observaciones_18_30,
            'mujeres_31_40_propios' => $mujeres_31_40_propios,
            'mujeres_31_40_contratistas' => $mujeres_31_40_contratistas,
            'hombres_31_40_propios' => $hombres_31_40_propios,
            'hombres_31_40_contratistas' => $hombres_31_40_contratistas,
            'observaciones_31_40' => $observaciones_31_40,
            'mujeres_41_50_propios' => $mujeres_41_50_propios,
            'mujeres_41_50_contratistas' => $mujeres_41_50_contratistas,
            'hombres_41_50_propios' => $hombres_41_50_propios,
            'hombres_41_50_contratistas' => $hombres_41_50_contratistas,
            'observaciones_41_50' => $observaciones_41_50,
            'mujeres_51_60_propios' => $mujeres_51_60_propios,
            'mujeres_51_60_contratistas' => $mujeres_51_60_contratistas,
            'hombres_51_60_propios' => $hombres_51_60_propios,
            'hombres_51_60_contratistas' => $hombres_51_60_contratistas,
            'observaciones_51_60' => $observaciones_51_60,
            'mujeres_61_propios' => $mujeres_61_propios,
            'mujeres_61_contratistas' => $mujeres_61_contratistas,
            'hombres_61_propios' => $hombres_61_propios,
            'hombres_61_contratistas' => $hombres_61_contratistas,
            'observaciones_61' => $observaciones_61,
            'antiguedad_menos_1_mujeres_propias' => $antiguedad_menos_1_mujeres_propias,
            'antiguedad_menos_1_mujeres_contratistas' => $antiguedad_menos_1_mujeres_contratistas,
            'antiguedad_menos_1_hombres_propios' => $antiguedad_menos_1_hombres_propios,
            'antiguedad_menos_1_hombres_contratistas' => $antiguedad_menos_1_hombres_contratistas,
            'observaciones_menos_1' => $observaciones_menos_1,

            'total_personal_propio' => $total_personal_propio,
            'total_personal_contratista' => $total_personal_contratista,
            'tipo_proveedor_seleccionados' => $tipo_proveedor_cadena,
            'cadena_valor_minero' => $cadenaValorMinero,
            'total_mujeres_propios' => $total_mujeres_propios,
            'total_mujeres_contratistas' => $total_mujeres_contratistas,
            'total_hombres_propios' => $total_hombres_propios,
            'total_hombres_contratistas' => $total_hombres_contratistas,
            'total_antiguedad_mujeres_propias' => $total_antiguedad_mujeres_propias,
            'total_antiguedad_mujeres_contratistas' => $total_antiguedad_mujeres_contratistas,
            'total_antiguedad_hombres_propios' => $total_antiguedad_hombres_propios,
            'total_antiguedad_hombres_contratistas' => $total_antiguedad_hombres_contratistas,
            'total_cargo_mujeres_propias' => $total_cargo_mujeres_propias,
            'total_cargo_mujeres_contratistas' => $total_cargo_mujeres_contratistas,
            'total_cargo_hombres_propios' => $total_cargo_hombres_propios,
            'total_cargo_hombres_contratistas' => $total_cargo_hombres_contratistas,
            'total_propios_mujeres_profesion' => $total_propios_mujeres_profesion,
            'total_contratistas_mujeres_profesion' => $total_contratistas_mujeres_profesion,
            'total_propios_hombres_profesion' => $total_propios_hombres_profesion,
            'total_contratistas_hombres_profesion' => $total_contratistas_hombres_profesion,
            'total_escolaridad_propios_mujeres' => $total_escolaridad_propios_mujeres,
            'total_escolaridad_contratistas_mujeres' => $total_escolaridad_contratistas_mujeres,
            'total_escolaridad_propios_hombres' => $total_escolaridad_propios_hombres,
            'total_escolaridad_contratistas_hombres' => $total_escolaridad_contratistas_hombres
        ]);

          // Para confirmar los datos recibidos, puedes temporalmente guardar o imprimir estos datos:
            error_log(print_r($datos, true)); // Esto escribirá en el log de errores del servidor para revisión
    
       // Ejecutar la sentencia
    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
                alert('Muchas gracias por responder.');
                window.location = '#';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error al crear el registro');
              </script>";
    }

    // Cerrar statement
    $stmt->close();

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "Método de envío incorrecto.";
}
?>
                
