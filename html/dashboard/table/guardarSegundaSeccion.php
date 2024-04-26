<?php


session_start();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Recuperar los valores del formulario
    $company_name = $conn->real_escape_string($_POST['company_name'] ?? '');
    $company_rut = $conn->real_escape_string($_POST['company_rut'] ?? '');
    $rutPattern = '/^\d{7,8}-\d{1}$/';

    // Validar el formato del RUT
    if (!preg_match($rutPattern, $company_rut)) {
        die("El RUT ingresado no tiene un formato válido. Debe ser como 12345678-9.");
    }

   

    $total_personal_propio = $conn->real_escape_string($_POST['total_personal_propio']);
    $total_personal_contratista = $conn->real_escape_string($_POST['total_personal_contratista']);

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

    // Calcular totales de edad
    $total_edad_mujeres_propias = array_sum([
        $_POST['mujeres_18_30_propios'],
        $_POST['mujeres_31_40_propios'],
        $_POST['mujeres_41_50_propios'],
        $_POST['mujeres_51_60_propios'],
        $_POST['mujeres_61_propios']
    ]);

    $total_edad_mujeres_contratistas = array_sum([
        $_POST['mujeres_18_30_contratistas'],
        $_POST['mujeres_31_40_contratistas'],
        $_POST['mujeres_41_50_contratistas'],
        $_POST['mujeres_51_60_contratistas'],
        $_POST['mujeres_61_contratistas']
    ]);

    $total_edad_hombres_propios = array_sum([
        $_POST['hombres_18_30_propios'],
        $_POST['hombres_31_40_propios'],
        $_POST['hombres_41_50_propios'],
        $_POST['hombres_51_60_propios'],
        $_POST['hombres_61_propios']
    ]);

    $total_edad_hombres_contratistas = array_sum([
        $_POST['hombres_18_30_contratistas'],
        $_POST['hombres_31_40_contratistas'],
        $_POST['hombres_41_50_contratistas'],
        $_POST['hombres_51_60_contratistas'],
        $_POST['hombres_61_contratistas']
    ]);

    $total_antiguedad_mujeres_propias = $_POST['total_antiguedad_mujeres_propias'] ?? 0;
    $total_antiguedad_mujeres_contratistas = $_POST['total_antiguedad_mujeres_contratistas'] ?? 0;
    $total_antiguedad_hombres_propios = $_POST['total_antiguedad_hombres_propios'] ?? 0;
    $total_antiguedad_hombres_contratistas = $_POST['total_antiguedad_hombres_contratistas'] ?? 0;

    // Calcular totales de participación por tipo de cargo
    $total_cargo_mujeres_propias = array_sum([
        $_POST['directores_propios_mujeres'],
        $_POST['Jefas_areas_propios_mujeres'],
        $_POST['Supervisoras_propios_mujeres'],
        $_POST['Profesionales_propios_mujeres'],
        $_POST['Analistas_propios_mujeres'],
        $_POST['Operadoras_propios_mujeres'],
        $_POST['Mantenedoras_propios_mujeres'],
        $_POST['Administrativo_propios_mujeres']
    ]);
    
    $total_cargo_mujeres_contratistas = array_sum([
        $_POST['directores_contratistas_mujeres'],
        $_POST['Subgerentes_Superintendentes_contratistas_mujeres'],
        $_POST['Jefas_areas_contratistas_mujeres'],
        $_POST['Supervisoras_contratistas_mujeres'],
        $_POST['Profesionales_contratistas_mujeres'],
        $_POST['Analistas_contratistas_mujeres'],
        $_POST['Operadoras_contratistas_mujeres'],
        $_POST['Mantenedoras_contratistas_mujeres'],
        $_POST['Administrativo_contratistas_mujeres']
    ]);
    
    $total_cargo_hombres_propios = array_sum([
        $_POST['directores_propios_hombres'],
        $_POST['Subgerentes_Superintendentes_propios_hombres'],
        $_POST['Jefas_areas_propios_hombres'],
        $_POST['Supervisoras_propios_hombres'],
        $_POST['Profesionales_propios_hombres'],
        $_POST['Analistas_propios_hombres'],
        $_POST['Operadoras_propios_hombres'],
        $_POST['Mantenedoras_propios_hombres'],
        $_POST['Administrativo_propios_hombres']
    ]);
    
    $total_cargo_hombres_contratistas = array_sum([
        $_POST['directores_contratistas_hombres'],
        $_POST['Subgerentes_Superintendentes_contratistas_hombres'],
        $_POST['Jefas_areas_contratistas_hombres'],
        $_POST['Supervisoras_contratistas_hombres'],
        $_POST['Profesionales_contratistas_hombres'],
        $_POST['Analistas_contratistas_hombres'],
        $_POST['Operadoras_contratistas_hombres'],
        $_POST['Mantenedoras_contratistas_hombres'],
        $_POST['Administrativo_contratistas_hombres']
    ]);
    
    
    // Calcular totales de participación por tipo de profesión u oficio
    $total_profesion_propios_mujeres = array_sum([
        $_POST['minas_propios_mujeres'],
        $_POST['metalurgia_quimica_propios_mujeres'],
        $_POST['electrica_mecanica_propios_mujeres'],
        $_POST['industrial_comercial_propios_mujeres'],
        $_POST['otras_ingenierias_propios_mujeres'],
        $_POST['carreras_tecnicas_propios_mujeres'],
        $_POST['otras_carreras_propios_mujeres'],
        $_POST['sin_profesion_propios_mujeres']
    ]);
    
    $total_profesion_contratistas_mujeres = array_sum([
        $_POST['minas_contratistas_mujeres'],
        $_POST['metalurgia_quimica_contratistas_mujeres'],
        $_POST['electrica_mecanica_contratistas_mujeres'],
        $_POST['industrial_comercial_contratistas_mujeres'],
        $_POST['otras_ingenierias_contratistas_mujeres'],
        $_POST['carreras_tecnicas_contratistas_mujeres'],
        $_POST['otras_carreras_contratistas_mujeres'],
        $_POST['sin_profesion_contratistas_mujeres']
    ]);
    
    $total_profesion_propios_hombres = array_sum([
        $_POST['minas_propios_hombres'],
        $_POST['metalurgia_quimica_propios_hombres'],
        $_POST['electrica_mecanica_propios_hombres'],
        $_POST['industrial_comercial_propios_hombres'],
        $_POST['otras_ingenierias_propios_hombres'],
        $_POST['carreras_tecnicas_propios_hombres'],
        $_POST['otras_carreras_propios_hombres'],
        $_POST['sin_profesion_propios_hombres']
    ]);
    
    $total_profesion_contratistas_hombres = array_sum([
        $_POST['minas_contratistas_hombres'],
        $_POST['metalurgia_quimica_contratistas_hombres'],
        $_POST['electrica_mecanica_contratistas_hombres'],
        $_POST['industrial_comercial_contratistas_hombres'],
        $_POST['otras_ingenierias_contratistas_hombres'],
        $_POST['carreras_tecnicas_contratistas_hombres'],
        $_POST['otras_carreras_contratistas_hombres'],
        $_POST['sin_profesion_contratistas_hombres']
    ]);
    
    
    // Calcular totales de caracterización por escolaridad
    $total_escolaridad_propios_mujeres = array_sum([
        $_POST['sin_estudios_propios_mujeres'],
        $_POST['Media_propios_mujeres'],
        $_POST['tecnicas_propios_mujeres'],
        $_POST['profesionales_propios_mujeres'],
        $_POST['Post_propios_mujeres']
    ]);
    
    $total_escolaridad_contratistas_mujeres = array_sum([
        $_POST['sin_estudios_contratistas_mujeres'],
        $_POST['Media_contratistas_mujeres'],
        $_POST['tecnicas_contratistas_mujeres'],
        $_POST['profesionales_contratistas_mujeres'],
        $_POST['Post_contratistas_mujeres']
    ]);
    
    $total_escolaridad_propios_hombres = array_sum([
        $_POST['sin_estudios_propios_hombres'],
        $_POST['Media_propios_hombres'],
        $_POST['tecnicas_propios_hombres'],
        $_POST['profesionales_propios_hombres'],
        $_POST['Post_propios_hombres']
    ]);
    
    $total_escolaridad_contratistas_hombres = array_sum([
        $_POST['sin_estudios_contratistas_hombres'],
        $_POST['Media_contratistas_hombres'],
        $_POST['tecnicas_contratistas_hombres'],
        $_POST['profesionales_contratistas_hombres'],
        $_POST['Post_contratistas_hombres']
    ]);
    
        


        var_dump($tipo_proveedor_cadena);
        // Preparar la consulta SQL
        $stmt = $conn->prepare("INSERT INTO estadisticadegenero (
            company_name, 
            company_rut, 
            total_personal_propio, 
            total_personal_contratista, 
            tipo_proveedor_seleccionados,
            cadena_valor_minero,
            total_edad_mujeres_propias, 
            total_edad_mujeres_contratistas, 
            total_edad_hombres_propios, 
            total_edad_hombres_contratistas, 
            total_antiguedad_mujeres_propias, 
            total_antiguedad_mujeres_contratistas, 
            total_antiguedad_hombres_propios, 
            total_antiguedad_hombres_contratistas, 
            total_cargo_mujeres_propias, 
            total_cargo_mujeres_contratistas, 
            total_cargo_hombres_propios, 
            total_cargo_hombres_contratistas,
            total_profesion_propios_mujeres, 
            total_profesion_contratistas_mujeres, 
            total_profesion_propios_hombres, 
            total_profesion_contratistas_hombres,
            total_escolaridad_propios_mujeres,
            total_escolaridad_contratistas_mujeres,
            total_escolaridad_propios_hombres,
            total_escolaridad_contratistas_hombres
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        
        // Vincular parámetros para marcadores
        $stmt->bind_param(
            "ssisssiiiiiiiiiiiiiiiiiiii",
            $company_name,
            $company_rut,
            $total_personal_propio,
            $total_personal_contratista,
            $tipo_proveedor_cadena,
            $cadenaValorMinero,
            $total_edad_mujeres_propias,
            $total_edad_mujeres_contratistas,
            $total_edad_hombres_propios,
            $total_edad_hombres_contratistas,
            $total_antiguedad_mujeres_propias,
            $total_antiguedad_mujeres_contratistas,
            $total_antiguedad_hombres_propios,
            $total_antiguedad_hombres_contratistas,
            $total_cargo_mujeres_propias,
            $total_cargo_mujeres_contratistas,
            $total_cargo_hombres_propios,
            $total_cargo_hombres_contratistas,
            $total_profesion_propios_mujeres,
            $total_profesion_contratistas_mujeres,
            $total_profesion_propios_hombres,
            $total_profesion_contratistas_hombres,
            $total_escolaridad_propios_mujeres,
            $total_escolaridad_contratistas_mujeres,
            $total_escolaridad_propios_hombres,
            $total_escolaridad_contratistas_hombres
        );

        // Luego de procesar y antes de redirigir
        $_SESSION['nombre_empresa'] = $_POST['company_name'];
        $_SESSION['rut_empresa'] = $_POST['company_rut'];

        
        // Ejecutar la sentencia
        if ($stmt->execute()) {
            echo "<script type='text/javascript'>
                    alert('Gracias por responder, sigamos con proximo.');
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
    
