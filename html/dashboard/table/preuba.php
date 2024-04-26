
// Verificar si el formulario fue enviado


   

    /*
    guardarDatos($conn, [
        'company_name' => $company_name,
        'company_rut' => $company_rut,
        'total_personal_propio' => $total_personal_propio,
        'total_personal_contratista' => $total_personal_contratista,
        'tipo_proveedor_cadena' => $tipo_proveedor_cadena,
        'cadenaValorMinero' => $cadenaValorMinero,
        'total_edad_mujeres_propias' => $total_edad_mujeres_propias,
        'total_edad_mujeres_contratistas' => $total_edad_mujeres_contratistas,
        'total_edad_hombres_propios' => $total_edad_hombres_propios,
        'total_edad_hombres_contratistas' => $total_edad_hombres_contratistas,
        // Agregar más campos según sea necesario
    ]);
    

    
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
    
    // Procesar la tabla de antigüedad
    // Procesar la tabla de antigüedad
    guardarDatosTabla($conn, 'antiguedad', [
        'menos_1_mujeres_propias' => isset($_POST['antiguedad_mujeres_propias']) ? $_POST['antiguedad_mujeres_propias'] : 0,
        'menos_1_mujeres_contratistas' => isset($_POST['antiguedad_mujeres_contratistas']) ? $_POST['antiguedad_mujeres_contratistas'] : 0,
        'menos_1_hombres_propios' => isset($_POST['antiguedad_hombres_propios']) ? $_POST['antiguedad_hombres_propios'] : 0,
        'menos_1_hombres_contratistas' => isset($_POST['antiguedad_hombres_contratistas']) ? $_POST['antiguedad_hombres_contratistas'] : 0,
        '1_5_mujeres_propias' => isset($_POST['antiguedad_mujeres_propias']) ? $_POST['antiguedad_mujeres_propias'] : 0,
        '1_5_mujeres_contratistas' => isset($_POST['antiguedad_mujeres_contratistas']) ? $_POST['antiguedad_mujeres_contratistas'] : 0,
        '1_5_hombres_propios' => isset($_POST['antiguedad_hombres_propios']) ? $_POST['antiguedad_hombres_propios'] : 0,
        '1_5_hombres_contratistas' => isset($_POST['antiguedad_hombres_contratistas']) ? $_POST['antiguedad_hombres_contratistas'] : 0,
        '6_10_mujeres_propias' => isset($_POST['antiguedad_mujeres_propias']) ? $_POST['antiguedad_mujeres_propias'] : 0,
        '6_10_mujeres_contratistas' => isset($_POST['antiguedad_mujeres_contratistas']) ? $_POST['antiguedad_mujeres_contratistas'] : 0,
        '6_10_hombres_propios' => isset($_POST['antiguedad_hombres_propios']) ? $_POST['antiguedad_hombres_propios'] : 0,
        '6_10_hombres_contratistas' => isset($_POST['antiguedad_hombres_contratistas']) ? $_POST['antiguedad_hombres_contratistas'] : 0,
        '11_20_mujeres_propias' => isset($_POST['antiguedad_mujeres_propias']) ? $_POST['antiguedad_mujeres_propias'] : 0,
        '11_20_mujeres_contratistas' => isset($_POST['antiguedad_mujeres_contratistas']) ? $_POST['antiguedad_mujeres_contratistas'] : 0,
        '11_20_hombres_propios' => isset($_POST['antiguedad_hombres_propios']) ? $_POST['antiguedad_hombres_propios'] : 0,
        '11_20_hombres_contratistas' => isset($_POST['antiguedad_hombres_contratistas']) ? $_POST['antiguedad_hombres_contratistas'] : 0,
        'mas_21_mujeres_propias' => isset($_POST['antiguedad_mujeres_propias']) ? $_POST['antiguedad_mujeres_propias'] : 0,
        'mas_21_mujeres_contratistas' => isset($_POST['antiguedad_mujeres_contratistas']) ? $_POST['antiguedad_mujeres_contratistas'] : 0,
        'mas_21_hombres_propios' => isset($_POST['antiguedad_hombres_propios']) ? $_POST['antiguedad_hombres_propios'] : 0,
        'mas_21_hombres_contratistas' => isset($_POST['antiguedad_hombres_contratistas']) ? $_POST['antiguedad_hombres_contratistas'] : 0,
        'total_mujeres_propias' => isset($_POST['total_antiguedad_mujeres_propias']) ? $_POST['total_antiguedad_mujeres_propias'] : 0,
        'total_mujeres_contratistas' => isset($_POST['total_antiguedad_mujeres_contratistas']) ? $_POST['total_antiguedad_mujeres_contratistas'] : 0,
        'total_hombres_propios' => isset($_POST['total_antiguedad_hombres_propios']) ? $_POST['total_antiguedad_hombres_propios'] : 0,
        'total_hombres_contratistas' => isset($_POST['total_antiguedad_hombres_contratistas']) ? $_POST['total_antiguedad_hombres_contratistas'] : 0
    ]);



    // Procesar la tabla de tipo de cargo
    guardarDatosTabla($conn, 'tipo_cargo', [
        'directores_propios_mujeres' => $_POST['directores_propios_mujeres'],
        'directores_contratistas_mujeres' => $_POST['directores_contratistas_mujeres'],
        'directores_propios_hombres' => $_POST['directores_propios_hombres'],
        'directores_contratistas_hombres' => $_POST['directores_contratistas_hombres'],
        'subgerentes_superintendentes_propios_mujeres' => $_POST['Subgerentes_Superintendentes_propios_mujeres'],
        'subgerentes_superintendentes_contratistas_mujeres' => $_POST['Subgerentes_Superintendentes_contratistas_mujeres'],
        'subgerentes_superintendentes_propios_hombres' => $_POST['Subgerentes_Superintendentes_propios_hombres'],
        'subgerentes_superintendentes_contratistas_hombres' => $_POST['Subgerentes_Superintendentes_contratistas_hombres'],
        'jefas_areas_propios_mujeres' => $_POST['Jefas_areas_propios_mujeres'],
        'jefas_areas_contratistas_mujeres' => $_POST['Jefas_areas_contratistas_mujeres'],
        'jefas_areas_propios_hombres' => $_POST['Jefas_areas_propios_hombres'],
        'jefas_areas_contratistas_hombres' => $_POST['Jefas_areas_contratistas_hombres'],
        'supervisoras_propios_mujeres' => $_POST['Supervisoras_propios_mujeres'],
        'supervisoras_contratistas_mujeres' => $_POST['Supervisoras_contratistas_mujeres'],
        'supervisoras_propios_hombres' => $_POST['Supervisoras_propios_hombres'],
        'supervisoras_contratistas_hombres' => $_POST['Supervisoras_contratistas_hombres'],
        'profesionales_propios_mujeres' => $_POST['Profesionales_propios_mujeres'],
        'profesionales_contratistas_mujeres' => $_POST['Profesionales_contratistas_mujeres'],
        'profesionales_propios_hombres' => $_POST['Profesionales_propios_hombres'],
        'profesionales_contratistas_hombres' => $_POST['Profesionales_contratistas_hombres'],
        'analistas_propios_mujeres' => $_POST['Analistas_propios_mujeres'],
        'analistas_contratistas_mujeres' => $_POST['Analistas_contratistas_mujeres'],
        'analistas_propios_hombres' => $_POST['Analistas_propios_hombres'],
        'analistas_contratistas_hombres' => $_POST['Analistas_contratistas_hombres'],
        'operadoras_propios_mujeres' => $_POST['Operadoras_propios_mujeres'],
        'operadoras_contratistas_mujeres' => $_POST['Operadoras_contratistas_mujeres'],
        'operadoras_propios_hombres' => $_POST['Operadoras_propios_hombres'],
        'operadoras_contratistas_hombres' => $_POST['Operadoras_contratistas_hombres'],
        'mantenedoras_propios_mujeres' => $_POST['Mantenedoras_propios_mujeres'],
        'mantenedoras_contratistas_mujeres' => $_POST['Mantenedoras_contratistas_mujeres'],
        'mantenedoras_propios_hombres' => $_POST['Mantenedoras_propios_hombres'],
        'mantenedoras_contratistas_hombres' => $_POST['Mantenedoras_contratistas_hombres'],
        'administrativo_propios_mujeres' => $_POST['Administrativo_propios_mujeres'],
        'administrativo_contratistas_mujeres' => $_POST['Administrativo_contratistas_mujeres'],
        'administrativo_propios_hombres' => $_POST['Administrativo_propios_hombres'],
        'administrativo_contratistas_hombres' => $_POST['Administrativo_contratistas_hombres'],
        'total_propios_mujeres' => $_POST['total_propios_mujeres'],
        'total_contratistas_mujeres' => $_POST['total_contratistas_mujeres'],
        'total_propios_hombres' => $_POST['total_propios_hombres'],
        'total_contratistas_hombres' => $_POST['total_contratistas_hombres']
    ]);


    // Procesar la tabla de profesión u oficio
    guardarDatosTabla($conn, 'profesion_oficio', [
        'minas_propios_mujeres' => $_POST['minas_propios_mujeres_profesion'],
        'minas_contratistas_mujeres' => $_POST['minas_contratistas_mujeres_profesion'],
        'minas_propios_hombres' => $_POST['minas_propios_hombres_profesion'],
        'minas_contratistas_hombres' => $_POST['minas_contratistas_hombres_profesion'],
        'metalurgia_quimica_propios_mujeres' => $_POST['metalurgia_quimica_propios_mujeres_profesion'],
        'metalurgia_quimica_contratistas_mujeres' => $_POST['metalurgia_quimica_contratistas_mujeres_profesion'],
        'metalurgia_quimica_propios_hombres' => $_POST['metalurgia_quimica_propios_hombres_profesion'],
        'metalurgia_quimica_contratistas_hombres' => $_POST['metalurgia_quimica_contratistas_hombres_profesion'],
        'electrica_mecanica_propios_mujeres' => $_POST['electrica_mecanica_propios_mujeres_profesion'],
        'electrica_mecanica_contratistas_mujeres' => $_POST['electrica_mecanica_contratistas_mujeres_profesion'],
        'electrica_mecanica_propios_hombres' => $_POST['electrica_mecanica_propios_hombres_profesion'],
        'electrica_mecanica_contratistas_hombres' => $_POST['electrica_mecanica_contratistas_hombres_profesion'],
        'industrial_comercial_propios_mujeres' => $_POST['industrial_comercial_propios_mujeres_profesion'],
        'industrial_comercial_contratistas_mujeres' => $_POST['industrial_comercial_contratistas_mujeres_profesion'],
        'industrial_comercial_propios_hombres' => $_POST['industrial_comercial_propios_hombres_profesion'],
        'industrial_comercial_contratistas_hombres' => $_POST['industrial_comercial_contratistas_hombres_profesion'],
        'otras_ingenierias_propios_mujeres' => $_POST['otras_ingenierias_propios_mujeres_profesion'],
        'otras_ingenierias_contratistas_mujeres' => $_POST['otras_ingenierias_contratistas_mujeres_profesion'],
        'otras_ingenierias_propios_hombres' => $_POST['otras_ingenierias_propios_hombres_profesion'],
        'otras_ingenierias_contratistas_hombres' => $_POST['otras_ingenierias_contratistas_hombres_profesion'],
        'carreras_tecnicas_propios_mujeres' => $_POST['carreras_tecnicas_propios_mujeres_profesion'],
        'carreras_tecnicas_contratistas_mujeres' => $_POST['carreras_tecnicas_contratistas_mujeres_profesion'],
        'carreras_tecnicas_propios_hombres' => $_POST['carreras_tecnicas_propios_hombres_profesion'],
        'carreras_tecnicas_contratistas_hombres' => $_POST['carreras_tecnicas_contratistas_hombres_profesion'],
        'otras_carreras_propios_mujeres' => $_POST['otras_carreras_propios_mujeres_profesion'],
        'otras_carreras_contratistas_mujeres' => $_POST['otras_carreras_contratistas_mujeres_profesion'],
        'otras_carreras_propios_hombres' => $_POST['otras_carreras_propios_hombres_profesion'],
        'otras_carreras_contratistas_hombres' => $_POST['otras_carreras_contratistas_hombres_profesion'],
        'sin_profesion_propios_mujeres' => $_POST['sin_profesion_propios_mujeres_profesion'],
        'sin_profesion_contratistas_mujeres' => $_POST['sin_profesion_contratistas_mujeres_profesion'],
        'sin_profesion_propios_hombres' => $_POST['sin_profesion_propios_hombres_profesion'],
        'sin_profesion_contratistas_hombres' => $_POST['sin_profesion_contratistas_hombres_profesion'],
        'total_propios_mujeres' => $_POST['total_propios_mujeres_profesion'],
        'total_contratistas_mujeres' => $_POST['total_contratistas_mujeres_profesion'],
        'total_propios_hombres' => $_POST['total_propios_hombres_profesion'],
        'total_contratistas_hombres' => $_POST['total_contratistas_hombres_profesion']
    ]);


    // Procesar la tabla de escolaridad
    guardarDatosTabla($conn, 'escolaridad', [
        'sin_estudios_propios_mujeres' => $_POST['sin_estudios_propios_mujeres'],
        'sin_estudios_contratistas_mujeres' => $_POST['sin_estudios_contratistas_mujeres'],
        'sin_estudios_propios_hombres' => $_POST['sin_estudios_propios_hombres'],
        'sin_estudios_contratistas_hombres' => $_POST['sin_estudios_contratistas_hombres'],
        'Media_propios_mujeres' => $_POST['Media_propios_mujeres'],
        'Media_contratistas_mujeres' => $_POST['Media_contratistas_mujeres'],
        'Media_propios_hombres' => $_POST['Media_propios_hombres'],
        'Media_contratistas_hombres' => $_POST['Media_contratistas_hombres'],
        'tecnicas_propios_mujeres' => $_POST['tecnicas_propios_mujeres'],
        'tecnicas_contratistas_mujeres' => $_POST['tecnicas_contratistas_mujeres'],
        'tecnicas_propios_hombres' => $_POST['tecnicas_propios_hombres'],
        'tecnicas_contratistas_hombres' => $_POST['tecnicas_contratistas_hombres'],
        'profesionales_propios_mujeres' => $_POST['profesionales_propios_mujeres'],
        'profesionales_contratistas_mujeres' => $_POST['profesionales_contratistas_mujeres'],
        'profesionales_propios_hombres' => $_POST['profesionales_propios_hombres'],
        'profesionales_contratistas_hombres' => $_POST['profesionales_contratistas_hombres'],
        'Post_propios_mujeres' => $_POST['Post_propios_mujeres'],
        'Post_contratistas_mujeres' => $_POST['Post_contratistas_mujeres'],
        'Post_propios_hombres' => $_POST['Post_propios_hombres'],
        'Post_contratistas_hombres' => $_POST['Post_contratistas_hombres'],
        'total_propios_mujeres' => $_POST['total_propios_mujeres_escolaridad'],
        'total_contratistas_mujeres' => $_POST['total_contratistas_mujeres_escolaridad'],
        'total_propios_hombres' => $_POST['total_propios_hombres_escolaridad'],
        'total_contratistas_hombres' => $_POST['total_contratistas_hombres_escolaridad']
    ]);


    $conn->close();*/

   /* if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        
            // Ejecutar la consulta
            $stmt->execute();
        }
        $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : '';
        $company_rut = isset($_POST['company_rut']) ? $_POST['company_rut'] : '';

        $tipo_proveedor_seleccionados = $_POST['tipo_proveedor_seleccionados'] ?? '';
        $cadena_valor_minero = $_POST['cadena_valor_minero'] ?? '';
        $total_cargo_mujeres_propias = $_POST['total_cargo_mujeres_propias'] ?? 0;
        $total_cargo_mujeres_contratistas = $_POST['total_cargo_mujeres_contratistas'] ?? 0;
        $total_cargo_hombres_propios = $_POST['total_cargo_hombres_propios'] ?? 0;
        $total_cargo_hombres_contratistas = $_POST['total_cargo_hombres_contratistas'] ?? 0;
        $total_profesion_propios_mujeres = $_POST['total_profesion_propios_mujeres'] ?? 0;
        $total_profesion_contratistas_mujeres = $_POST['total_profesion_contratistas_mujeres'] ?? 0;
        $total_profesion_propios_hombres = $_POST['total_profesion_propios_hombres'] ?? 0;
        $total_profesion_contratistas_hombres = $_POST['total_profesion_contratistas_hombres'] ?? 0;
        $total_escolaridad_propios_mujeres = $_POST['total_escolaridad_propios_mujeres'] ?? 0;
        $total_escolaridad_contratistas_mujeres = $_POST['total_escolaridad_contratistas_mujeres'] ?? 0;
        $total_escolaridad_propios_hombres = $_POST['total_escolaridad_propios_hombres'] ?? 0;
        $total_escolaridad_contratistas_hombres = $_POST['total_escolaridad_contratistas_hombres'] ?? 0;


        

            guardarDatos($conn, [
                'company_name' => $company_name,
                'company_rut' => $company_rut,
                'total_personal_propio' => $total_personal_propio,
                'total_personal_contratista' => $total_personal_contratista,
                'total_personal_propio' => $total_personal_propio,
                'total_personal_contratista' => $total_personal_contratista,
                'total_edad_mujeres_propias' => $total_edad_mujeres_propias,
                'total_edad_mujeres_contratistas' => $total_edad_mujeres_contratistas,
                'total_edad_hombres_propios' => $total_edad_hombres_propios,
                'total_edad_hombres_contratistas' => $total_edad_hombres_contratistas,
                'total_antiguedad_mujeres_propias' => $total_antiguedad_mujeres_propias,
                'total_antiguedad_mujeres_contratistas' => $total_antiguedad_mujeres_contratistas,
                'total_antiguedad_hombres_propios' => $total_antiguedad_hombres_propios,
                'total_antiguedad_hombres_contratistas' => $total_antiguedad_hombres_contratistas,
                // Campos de la tabla antiguedad
                'menos_1_mujeres_propias' => $_POST['menos_1_mujeres_propias'] ?? 0,
                'menos_1_mujeres_contratistas' => $_POST['menos_1_mujeres_contratistas'] ?? 0,
                'menos_1_hombres_propios' => $_POST['menos_1_hombres_propios'] ?? 0,
                'menos_1_hombres_contratistas' => $_POST['menos_1_hombres_contratistas'] ?? 0,
                '1_5_mujeres_propias' => $_POST['1_5_mujeres_propias'] ?? 0,
                '1_5_mujeres_contratistas' => $_POST['1_5_mujeres_contratistas'] ?? 0,
                '1_5_hombres_propios' => $_POST['1_5_hombres_propios'] ?? 0,
                '1_5_hombres_contratistas' => $_POST['1_5_hombres_contratistas'] ?? 0,
                '6_10_mujeres_propias' => $_POST['6_10_mujeres_propias'] ?? 0,
                '6_10_mujeres_contratistas' => $_POST['6_10_mujeres_contratistas'] ?? 0,
                '6_10_hombres_propios' => $_POST['6_10_hombres_propios'] ?? 0,
                '6_10_hombres_contratistas' => $_POST['6_10_hombres_contratistas'] ?? 0,
                '11_20_mujeres_propias' => $_POST['11_20_mujeres_propias'] ?? 0,
                '11_20_mujeres_contratistas' => $_POST['11_20_mujeres_contratistas'] ?? 0,
                '11_20_hombres_propios' => $_POST['11_20_hombres_propios'] ?? 0,
                '11_20_hombres_contratistas' => $_POST['11_20_hombres_contratistas'] ?? 0,
                'mas_21_mujeres_propias' => $_POST['mas_21_mujeres_propias'] ?? 0,
                'mas_21_mujeres_contratistas' => $_POST['mas_21_mujeres_contratistas'] ?? 0,
                'mas_21_hombres_propios' => $_POST['mas_21_hombres_propios'] ?? 0,
                'mas_21_hombres_contratistas' => $_POST['mas_21_hombres_contratistas'] ?? 0,
                // Campos de la tabla tipo_cargo
                'directores_propios_mujeres' => $_POST['directores_propios_mujeres'] ?? 0,
                'directores_contratistas_mujeres' => $_POST['directores_contratistas_mujeres'] ?? 0,
                'directores_propios_hombres' => $_POST['directores_propios_hombres'] ?? 0,
                'directores_contratistas_hombres' => $_POST['directores_contratistas_hombres'] ?? 0,
                'subgerentes_superintendentes_propios_mujeres' => $_POST['subgerentes_superintendentes_propios_mujeres'] ?? 0,
                'subgerentes_superintendentes_contratistas_mujeres' => $_POST['subgerentes_superintendentes_contratistas_mujeres'] ?? 0,
                'subgerentes_superintendentes_propios_hombres' => $_POST['subgerentes_superintendentes_propios_hombres'] ?? 0,
                'subgerentes_superintendentes_contratistas_hombres' => $_POST['subgerentes_superintendentes_contratistas_hombres'] ?? 0,
                'jefas_areas_propios_mujeres' => $_POST['jefas_areas_propios_mujeres'] ?? 0,
                'jefas_areas_contratistas_mujeres' => $_POST['jefas_areas_contratistas_mujeres'] ?? 0,
                'jefas_areas_propios_hombres' => $_POST['jefas_areas_propios_hombres'] ?? 0,
                'jefas_areas_contratistas_hombres' => $_POST['jefas_areas_contratistas_hombres'] ?? 0,
                'supervisoras_propios_mujeres' => $_POST['supervisoras_propios_mujeres'] ?? 0,
                'supervisoras_contratistas_mujeres' => $_POST['supervisoras_contratistas_mujeres'] ?? 0,
                'supervisoras_propios_hombres' => $_POST['supervisoras_propios_hombres'] ?? 0,
                'supervisoras_contratistas_hombres' => $_POST['supervisoras_contratistas_hombres'] ?? 0,
                'profesionales_propios_mujeres' => $_POST['profesionales_propios_mujeres'] ?? 0,
                'profesionales_contratistas_mujeres' => $_POST['profesionales_contratistas_mujeres'] ?? 0,
                'profesionales_propios_hombres' => $_POST['profesionales_propios_hombres'] ?? 0,
                'profesionales_contratistas_hombres' => $_POST['profesionales_contratistas_hombres'] ?? 0,
                'analistas_propios_mujeres' => $_POST['analistas_propios_mujeres'] ?? 0,
                'analistas_contratistas_mujeres' => $_POST['analistas_contratistas_mujeres'] ?? 0,
                'analistas_propios_hombres' => $_POST['analistas_propios_hombres'] ?? 0,
                'analistas_contratistas_hombres' => $_POST['analistas_contratistas_hombres'] ?? 0,
                'operadoras_propios_mujeres' => $_POST['operadoras_propios_mujeres'] ?? 0,
                'operadoras_contratistas_mujeres' => $_POST['operadoras_contratistas_mujeres'] ?? 0,
                'operadoras_propios_hombres' => $_POST['operadoras_propios_hombres'] ?? 0,
                'operadoras_contratistas_hombres' => $_POST['operadoras_contratistas_hombres'] ?? 0,
                'mantenedoras_propios_mujeres' => $_POST['mantenedoras_propios_mujeres'] ?? 0,
                'mantenedoras_contratistas_mujeres' => $_POST['mantenedoras_contratistas_mujeres'] ?? 0,
                'mantenedoras_propios_hombres' => $_POST['mantenedoras_propios_hombres'] ?? 0,
                'mantenedoras_contratistas_hombres' => $_POST['mantenedoras_contratistas_hombres'] ?? 0,
                'administrativo_propios_mujeres' => $_POST['administrativo_propios_mujeres'] ?? 0,
                'administrativo_contratistas_mujeres' => $_POST['administrativo_contratistas_mujeres'] ?? 0,
                'administrativo_propios_hombres' => $_POST['administrativo_propios_hombres'] ?? 0,
                'administrativo_contratistas_hombres' => $_POST['administrativo_contratistas_hombres'] ?? 0,
                'total_propios_mujeres' => $_POST['total_propios_mujeres'] ?? 0,
                'total_contratistas_mujeres' => $_POST['total_contratistas_mujeres'] ?? 0,
                'total_propios_hombres' => $_POST['total_propios_hombres'] ?? 0,
                'total_contratistas_hombres' => $_POST['total_contratistas_hombres'] ?? 0,
                // Campos de la tabla profesion_oficio
                'minas_propios_mujeres' => $_POST['minas_propios_mujeres_profesion'] ?? 0,
                'minas_contratistas_mujeres' => $_POST['minas_contratistas_mujeres_profesion'] ?? 0,
                'minas_propios_hombres' => $_POST['minas_propios_hombres_profesion'] ?? 0,
                'minas_contratistas_hombres' => $_POST['minas_contratistas_hombres_profesion'] ?? 0,
                'metalurgia_quimica_propios_mujeres' => $_POST['metalurgia_quimica_propios_mujeres_profesion'] ?? 0,
                'metalurgia_quimica_contratistas_mujeres' => $_POST['metalurgia_quimica_contratistas_mujeres_profesion'] ?? 0,
                'metalurgia_quimica_propios_hombres' => $_POST['metalurgia_quimica_propios_hombres_profesion'] ?? 0,
                'metalurgia_quimica_contratistas_hombres' => $_POST['metalurgia_quimica_contratistas_hombres_profesion'] ?? 0,
                'electrica_mecanica_propios_mujeres' => $_POST['electrica_mecanica_propios_mujeres_profesion'] ?? 0,
                'electrica_mecanica_contratistas_mujeres' => $_POST['electrica_mecanica_contratistas_mujeres_profesion'] ?? 0,
                'electrica_mecanica_propios_hombres' => $_POST['electrica_mecanica_propios_hombres_profesion'] ?? 0,
                'electrica_mecanica_contratistas_hombres' => $_POST['electrica_mecanica_contratistas_hombres_profesion'] ?? 0,
                'industrial_comercial_propios_mujeres' => $_POST['industrial_comercial_propios_mujeres_profesion'] ?? 0,
                'industrial_comercial_contratistas_mujeres' => $_POST['industrial_comercial_contratistas_mujeres_profesion'] ?? 0,
                'industrial_comercial_propios_hombres' => $_POST['industrial_comercial_propios_hombres_profesion'] ?? 0,
                'industrial_comercial_contratistas_hombres' => $_POST['industrial_comercial_contratistas_hombres_profesion'] ?? 0,
                'otras_ingenierias_propios_mujeres' => $_POST['otras_ingenierias_propios_mujeres_profesion'] ?? 0,
                'otras_ingenierias_contratistas_mujeres' => $_POST['otras_ingenierias_contratistas_mujeres_profesion'] ?? 0,
                'otras_ingenierias_propios_hombres' => $_POST['otras_ingenierias_propios_hombres_profesion'] ?? 0,
                'otras_ingenierias_contratistas_hombres' => $_POST['otras_ingenierias_contratistas_hombres_profesion'] ?? 0,
                'carreras_tecnicas_propios_mujeres' => $_POST['carreras_tecnicas_propios_mujeres_profesion'] ?? 0,
                'carreras_tecnicas_contratistas_mujeres' => $_POST['carreras_tecnicas_contratistas_mujeres_profesion'] ?? 0,
                'carreras_tecnicas_propios_hombres' => $_POST['carreras_tecnicas_propios_hombres_profesion'] ?? 0,
                'carreras_tecnicas_contratistas_hombres' => $_POST['carreras_tecnicas_contratistas_hombres_profesion'] ?? 0,
                'otras_carreras_propios_mujeres' => $_POST['otras_carreras_propios_mujeres_profesion'] ?? 0,
                'otras_carreras_contratistas_mujeres' => $_POST['otras_carreras_contratistas_mujeres_profesion'] ?? 0,
                'otras_carreras_propios_hombres' => $_POST['otras_carreras_propios_hombres_profesion'] ?? 0,
                'otras_carreras_contratistas_hombres' => $_POST['otras_carreras_contratistas_hombres_profesion'] ?? 0,
                'sin_profesion_propios_mujeres' => $_POST['sin_profesion_propios_mujeres_profesion'] ?? 0,
                'sin_profesion_contratistas_mujeres' => $_POST['sin_profesion_contratistas_mujeres_profesion'] ?? 0,
                'sin_profesion_propios_hombres' => $_POST['sin_profesion_propios_hombres_profesion'] ?? 0,
                'sin_profesion_contratistas_hombres' => $_POST['sin_profesion_contratistas_hombres_profesion'] ?? 0,
                'total_propios_mujeres_profesion' => $_POST['total_propios_mujeres_profesion'] ?? 0,
                'total_contratistas_mujeres_profesion' => $_POST['total_contratistas_mujeres_profesion'] ?? 0,
                'total_propios_hombres_profesion' => $_POST['total_propios_hombres_profesion'] ?? 0,
                'total_contratistas_hombres_profesion' => $_POST['total_contratistas_hombres_profesion'] ?? 0,
                // Campos de la tabla escolaridad
                'sin_estudios_propios_mujeres' => $_POST['sin_estudios_propios_mujeres'] ?? 0,
                'sin_estudios_contratistas_mujeres' => $_POST['sin_estudios_contratistas_mujeres'] ?? 0,
                'sin_estudios_propios_hombres' => $_POST['sin_estudios_propios_hombres'] ?? 0,
                'sin_estudios_contratistas_hombres' => $_POST['sin_estudios_contratistas_hombres'] ?? 0,
                'Media_propios_mujeres' => $_POST['Media_propios_mujeres'] ?? 0,
                'Media_contratistas_mujeres' => $_POST['Media_contratistas_mujeres'] ?? 0,
                'Media_propios_hombres' => $_POST['Media_propios_hombres'] ?? 0,
                'Media_contratistas_hombres' => $_POST['Media_contratistas_hombres'] ?? 0,
                'tecnicas_propios_mujeres' => $_POST['tecnicas_propios_mujeres'] ?? 0,
                'tecnicas_contratistas_mujeres' => $_POST['tecnicas_contratistas_mujeres'] ?? 0,
                'tecnicas_propios_hombres' => $_POST['tecnicas_propios_hombres'] ?? 0,
                'tecnicas_contratistas_hombres' => $_POST['tecnicas_contratistas_hombres'] ?? 0,
                'profesionales_propios_mujeres' => $_POST['profesionales_propios_mujeres'] ?? 0,
                'profesionales_contratistas_mujeres' => $_POST['profesionales_contratistas_mujeres'] ?? 0,
                'profesionales_propios_hombres' => $_POST['profesionales_propios_hombres'] ?? 0,
                'profesionales_contratistas_hombres' => $_POST['profesionales_contratistas_hombres'] ?? 0,
                'Post_propios_mujeres' => $_POST['Post_propios_mujeres'] ?? 0,
                'Post_contratistas_mujeres' => $_POST['Post_contratistas_mujeres'] ?? 0,
                'Post_propios_hombres' => $_POST['Post_propios_hombres'] ?? 0,
                'Post_contratistas_hombres' => $_POST['Post_contratistas_hombres'] ?? 0,
                'total_propios_mujeres_escolaridad' => $_POST['total_propios_mujeres_escolaridad'] ?? 0,
                'total_contratistas_mujeres_escolaridad' => $_POST['total_contratistas_mujeres_escolaridad'] ?? 0,
                'total_propios_hombres_escolaridad' => $_POST['total_propios_hombres_escolaridad'] ?? 0,
                'total_contratistas_hombres_escolaridad' => $_POST['total_contratistas_hombres_escolaridad'] ?? 0*/