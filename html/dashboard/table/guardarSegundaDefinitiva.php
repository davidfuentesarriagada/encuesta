<?php

session_start();

// Configuración de cabecera para JSON
header('Content-Type: application/json');

// Recibir el cuerpo de la petición como string JSON
$json = file_get_contents('php://input');

// Decodificar el string JSON a un objeto PHP
$datos = json_decode($json, true);

// Validar el JSON recibido
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400); // Código de respuesta HTTP para una mala solicitud
    echo json_encode(['error' => 'Error al decodificar JSON: ' . json_last_error_msg()]);
    exit;
}

// Validaciones
$errores = [];
$rutPattern = '/^\d{7,8}-(\d|k|K)$/'; // Patrón de validación para RUT

if (empty($datos['company_name'])) {
    $errores['company_name'] = "El nombre de la empresa es obligatorio.";
}

if (empty($datos['company_rut']) || !preg_match($rutPattern, $datos['company_rut'])) {
    $errores['company_rut'] = "El RUT de la empresa no es válido o está vacío.";
}

if (!isset($datos['tipo_proveedor']) || !is_array($datos['tipo_proveedor']) || count($datos['tipo_proveedor']) > 3) {
    $errores['tipo_proveedor'] = "Debe seleccionar hasta 3 tipos de proveedor.";
}

if (!isset($datos['procesos_cadena_valor']) || !is_array($datos['procesos_cadena_valor']) || count($datos['procesos_cadena_valor']) > 3) {
    $errores['procesos_cadena_valor'] = "Debe seleccionar hasta 3 en cadena de valor.";
}



$total_personal_propio = isset($datos['total_personal_propio']) ? $datos['total_personal_propio'] : null;
$total_personal_contratista = isset($datos['total_personal_contratista']) ? $datos['total_personal_contratista'] : null; // Usamos el operador de fusión null por si acaso el campo no se envía

$mujeres1830Propios = $datos['mujeres_18_30_propios'] ?? '0';
$mujeres1830Contratistas = $datos['mujeres_18_30_contratistas'] ?? '0';
$hombres1830Propios = $datos['hombres_18_30_propios'] ?? '0';
$hombres1830Contratistas = $datos['hombres_18_30_contratistas'] ?? '0';
$observaciones1830 = $datos['observaciones_18_30'] ?? '';

//edad _31_40_
$mujeres3140Propios = $datos['mujeres_31_40_propios'] ?? '0';
$mujeres3140Contratistas = $datos['mujeres_31_40_contratistas'] ?? '0';
$hombres3140Propios = $datos['hombres_31_40_propios'] ?? '0';
$hombres3140Contratistas = $datos['hombres_31_40_contratistas'] ?? '0';
$observaciones3140 = $datos['observaciones_31_40'] ?? '';

//edad _41_50_
$mujeres4150Propios = $datos['mujeres_41_50_propios'] ?? '0';
$mujeres4150Contratistas = $datos['mujeres_41_50_contratistas'] ?? '0';
$hombres4150Propios = $datos['hombres_41_50_propios'] ?? '0';
$hombres4150Contratistas = $datos['hombres_41_50_contratistas'] ?? '0';
$observaciones4150 = $datos['observaciones_41_50'] ?? '';

//edad _51_60_
$mujeres5160Propios = $datos['mujeres_51_60_propios'] ?? '0';
$mujeres5160Contratistas = $datos['mujeres_51_60_contratistas'] ?? '0';
$hombres5160Propios = $datos['hombres_51_60_propios'] ?? '0';
$hombres5160Contratistas = $datos['hombres_51_60_contratistas'] ?? '0';
$observaciones5160 = $datos['observaciones_51_60'] ?? '';

//edad _61_
$mujeres61Propios = $datos['mujeres_61_propios'] ?? '0';
$mujeres61Contratistas = $datos['mujeres_61_contratistas'] ?? '0';
$hombres61Propios = $datos['hombres_61_propios'] ?? '0';
$hombres61Contratistas = $datos['hombres_61_contratistas'] ?? '0';
$observaciones61 = $datos['observaciones_61'] ?? '';

//totales
$mujeresTotalPropios = $datos['total_mujeres_propios'] ?? '0';
$mujeresTotalContratistas = $datos['total_mujeres_contratistas'] ?? '0';
$hombresTotalPropios = $datos['total_hombres_propios'] ?? '0';
$hombresTotalContratistas = $datos['total_hombres_contratistas'] ?? '0';

//observaciones antiguedad
$observacionesMenos1 = $datos['observaciones_menos_1'] ?? '';
$observacionesMenos15 = $datos['observaciones_menos_1_5'] ?? '';
$observacionesMenos610 = $datos['observaciones_menos_6_10'] ?? '';
$observacionesMenos1120 = $datos['observaciones_menos_11_20'] ?? '';
$observacionesMenos21 = $datos['observaciones_menos_21'] ?? '';

//totales antiguedad
$mujeresTotalAntiguedadPropios = $datos['total_antiguedad_mujeres_propias'] ?? '0';
$mujeresTotalAntiguedadContratistas = $datos['total_antiguedad_mujeres_contratistas'] ?? '0';
$hombresTotalAntiguedadPropios = $datos['total_antiguedad_hombres_propios'] ?? '0';
$hombresTotalAntiguedadContratistas = $datos['total_antiguedad_hombres_contratistas'] ?? '0';


//observaciones cargos
$observacionesDirectores = $datos['observaciones_directores'] ?? '';
$observacionesSubgerentesSuperintendentes = $datos['observaciones_Subgerentes_Superintendentes'] ?? '';
$observacionesJefasAreas = $datos['observaciones_Jefas_areas'] ?? '';
$observacionesSupervisoras = $datos['observaciones_Supervisoras'] ?? '';
$observacionesProfesionales = $datos['observaciones_Profesionales'] ?? '';
$observacionesAnalistas = $datos['observaciones_Analistas'] ?? '';
$observacionesOperadoras = $datos['observaciones_Operadoras'] ?? '';
$observacionesMantenedoras = $datos['observaciones_Mantenedoras'] ?? '';
$observacionesAdministrativo = $datos['observaciones_Administrativo'] ?? '';

//totales cargo
$mujeresTotalCargoPropios = $datos['total_cargo_mujeres_propias'] ?? '0';
$mujeresTotalCargoContratistas = $datos['total_cargo_mujeres_contratistas'] ?? '0';
$hombresTotalCargoPropios  = $datos['total_cargo_hombres_propios'] ?? '0';
$hombresTotalCargoContratistas = $datos['total_cargo_hombres_contratistas'] ?? '0';

//observaciones profesion 
$observacionesMinas = $datos['observaciones_minas'] ?? '';
$observacionesMetalurgiaQuimica = $datos['observaciones_metalurgia_quimica'] ?? '';
$observacionesElectricaMecanica = $datos['observaciones_electrica_mecanica'] ?? '';
$observacionesIndustrialComercial = $datos['observaciones_industrial_comercial'] ?? '';
$observacionesOtrasIngenierias = $datos['observaciones_otras_ingenierias'] ?? '';
$observacionesCarrerasTecnicas = $datos['observaciones_carreras_tecnicas'] ?? '';
$observacionesOtrasCarreras = $datos['observaciones_otras_carreras'] ?? '';
$observacionesSinProfesion = $datos['observaciones_sin_profesion'] ?? '';


//totales cargo
$mujeresTotalProfesionPropios = $datos['total_propios_mujeres_profesion'] ?? '0';
$mujeresTotalProfesionContratistas = $datos['total_contratistas_mujeres_profesion'] ?? '0';
$hombresTotalProfesionPropios  = $datos['total_propios_hombres_profesion'] ?? '0';
$hombresTotalProfesionContratistas = $datos['total_contratistas_hombres_profesion'] ?? '0';

//observaciones escolaridad
$observacionesSinEstudios = $datos['observaciones_sin_estudios'] ?? '';
$observacionesEstudiosMedia = $datos['observaciones_Estudios_Media'] ?? '';
$observacionesPersonasCarrerasTecnicas = $datos['observaciones_Personas_Carreras_tecnicas'] ?? '';
$observacionesPersonasCarrerasProfesionales = $datos['observaciones_Personas_Carreras_profesionales'] ?? '';
$observacionesPostGrado = $datos['observaciones_PostGrado'] ?? '';


//totales escolaridad
$mujeresTotalEscolaridadPropios = $datos['total_escolaridad_propios_mujeres'] ?? '0';
$mujeresTotalEscolaridadContratistas = $datos['total_escolaridad_contratistas_mujeres'] ?? '0';
$hombresTotalEscolaridadPropios  = $datos['total_escolaridad_propios_hombres'] ?? '0';
$hombresTotalEscolaridadContratistas = $datos['total_escolaridad_contratistas_hombres'] ?? '0';


// Más validaciones según sea necesario...

// Si hay errores, devolverlos y no continuar
if (!empty($errores)) {
    http_response_code(400); // Código de respuesta HTTP para una mala solicitud
    echo json_encode(['errores' => $errores]);
    exit;
}

// Conexión a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$dbname = "encuesta";

$conn = new mysqli($host, $username, $password, $dbname);



if ($conn->connect_error) {
    http_response_code(500); // Código de respuesta HTTP para error de servidor
    echo json_encode(['error' => 'Error de conexión a la base de datos: ' . $conn->connect_error]);
    exit;
}

$conn->set_charset("utf8mb4");

// Preparar la sentencia SQL

$stmt = $conn->prepare("INSERT INTO estadisticadegenero (company_name, 
                                                          company_rut, 
                                                          total_personal_propio, 
                                                          total_personal_contratista, 
                                                          tipo_proveedor, 
                                                          procesos_cadena_valor, 
                                                          mujeres_18_30_propios, 
                                                          mujeres_18_30_contratistas, 
                                                          hombres_18_30_propios, 
                                                          hombres_18_30_contratistas, 
                                                          observaciones_18_30,
                                                          mujeres_31_40_propios, 
                                                          mujeres_31_40_contratistas, 
                                                          hombres_31_40_propios, 
                                                          hombres_31_40_contratistas, 
                                                          observaciones_31_40,
                                                          mujeres_41_50_propios, 
                                                          mujeres_41_50_contratistas, 
                                                          hombres_41_50_propios, 
                                                          hombres_41_50_contratistas, 
                                                          observaciones_41_50,
                                                          mujeres_51_60_propios, 
                                                          mujeres_51_60_contratistas, 
                                                          hombres_51_60_propios, 
                                                          hombres_51_60_contratistas, 
                                                          observaciones_51_60,
                                                          mujeres_61_propios, 
                                                          mujeres_61_contratistas, 
                                                          hombres_61_propios, 
                                                          hombres_61_contratistas, 
                                                          observaciones_61,
                                                          total_mujeres_propios, 
                                                          total_mujeres_contratistas, 
                                                          total_hombres_propios, 
                                                          total_hombres_contratistas,    
                                                          antiguedad_menos_1_mujeres_propias,
                                                          antiguedad_menos_1_mujeres_contratistas, 
                                                          antiguedad_menos_1_hombres_propios, 
                                                          antiguedad_menos_1_hombres_contratistas,
                                                          observaciones_menos_1 ,
                                                          antiguedad_menos_1_5_mujeres_propias,
                                                          antiguedad_menos_1_5_mujeres_contratistas, 
                                                          antiguedad_menos_1_5_hombres_propios, 
                                                          antiguedad_menos_1_5_hombres_contratistas,
                                                          observaciones_menos_1_5,
                                                          antiguedad_menos_6_10_mujeres_propias,
                                                          antiguedad_menos_6_10_mujeres_contratistas, 
                                                          antiguedad_menos_6_10_hombres_propios, 
                                                          antiguedad_menos_6_10_hombres_contratistas,
                                                          observaciones_menos_6_10,
                                                          antiguedad_menos_11_20_mujeres_propias,
                                                          antiguedad_menos_11_20_mujeres_contratistas, 
                                                          antiguedad_menos_11_20_hombres_propios, 
                                                          antiguedad_menos_11_20_hombres_contratistas,
                                                          observaciones_menos_11_20,
                                                          antiguedad_menos_21_mujeres_propias,
                                                          antiguedad_menos_21_mujeres_contratistas, 
                                                          antiguedad_menos_21_hombres_propios, 
                                                          antiguedad_menos_21_hombres_contratistas,
                                                          observaciones_menos_21,
                                                          total_antiguedad_mujeres_propias, 
                                                          total_antiguedad_mujeres_contratistas, 
                                                          total_antiguedad_hombres_propios, 
                                                          total_antiguedad_hombres_contratistas,
                                                          directores_propios_mujeres,
                                                          directores_contratistas_mujeres, 
                                                          directores_propios_hombres, 
                                                          directores_contratistas_hombres,
                                                          observaciones_directores,
                                                          Subgerentes_Superintendentes_propios_mujeres,
                                                          Subgerentes_Superintendentes_contratistas_mujeres, 
                                                          Subgerentes_Superintendentes_propios_hombres, 
                                                          Subgerentes_Superintendentes_contratistas_hombres,
                                                          observaciones_Subgerentes_Superintendentes,
                                                          Jefas_areas_propios_mujeres,
                                                          Jefas_areas_contratistas_mujeres, 
                                                          Jefas_areas_propios_hombres, 
                                                          Jefas_areas_contratistas_hombres,
                                                          observaciones_Jefas_areas,
                                                          Supervisoras_propios_mujeres,
                                                          Supervisoras_contratistas_mujeres, 
                                                          Supervisoras_propios_hombres, 
                                                          Supervisoras_contratistas_hombres,
                                                          observaciones_Supervisoras,
                                                          Profesionales_propios_mujeres,
                                                          Profesionales_contratistas_mujeres, 
                                                          Profesionales_propios_hombres, 
                                                          Profesionales_contratistas_hombres,
                                                          observaciones_Profesionales,
                                                          Analistas_propios_mujeres,
                                                          Analistas_contratistas_mujeres, 
                                                          Analistas_propios_hombres, 
                                                          Analistas_contratistas_hombres,
                                                          observaciones_Analistas,
                                                          Operadoras_propios_mujeres,
                                                          Operadoras_contratistas_mujeres, 
                                                          Operadoras_propios_hombres, 
                                                          Operadoras_contratistas_hombres,
                                                          observaciones_Operadoras,
                                                          Mantenedoras_propios_mujeres,
                                                          Mantenedoras_contratistas_mujeres, 
                                                          Mantenedoras_propios_hombres, 
                                                          Mantenedoras_contratistas_hombres,
                                                          observaciones_Mantenedoras,
                                                          Administrativo_propios_mujeres,
                                                          Administrativo_contratistas_mujeres, 
                                                          Administrativo_propios_hombres, 
                                                          Administrativo_contratistas_hombres,
                                                          observaciones_Administrativo,
                                                          total_cargo_mujeres_propias, 
                                                          total_cargo_mujeres_contratistas, 
                                                          total_cargo_hombres_propios, 
                                                          total_cargo_hombres_contratistas,
                                                          Ing_minas_propios_mujeres_profesion,
                                                          Ing_minas_contratistas_mujeres_profesion, 
                                                          Ing_minas_propios_hombres_profesion, 
                                                          Ing_minas_contratistas_hombres_profesion,
                                                          observaciones_minas,
                                                          Ing_metalurgia_quimica_propios_mujeres_profesion,
                                                          Ing_metalurgia_quimica_contratistas_mujeres_profesion, 
                                                          Ing_metalurgia_quimica_propios_hombres_profesion, 
                                                          Ing_metalurgia_quimica_contratistas_hombres_profesion,
                                                          observaciones_metalurgia_quimica,
                                                          Ing_electrica_mecanica_propios_mujeres_profesion,
                                                          Ing_electrica_mecanica_contratistas_mujeres_profesion, 
                                                          Ing_electrica_mecanica_propios_hombres_profesion, 
                                                          Ing_electrica_mecanica_contratistas_hombres_profesion,
                                                          observaciones_electrica_mecanica,
                                                          Ing_industrial_comercial_propios_mujeres_profesion,
                                                          Ing_industrial_comercial_contratistas_mujeres_profesion, 
                                                          Ing_industrial_comercial_propios_hombres_profesion, 
                                                          Ing_industrial_comercial_contratistas_hombres_profesion,
                                                          observaciones_industrial_comercial,
                                                          otras_ingenierias_propios_mujeres_profesion,
                                                          otras_ingenierias_contratistas_mujeres_profesion, 
                                                          otras_ingenierias_propios_hombres_profesion, 
                                                          otras_ingenierias_contratistas_hombres_profesion,
                                                          observaciones_otras_ingenierias,
                                                          carreras_tecnicas_propios_mujeres_profesion,
                                                          carreras_tecnicas_contratistas_mujeres_profesion, 
                                                          carreras_tecnicas_propios_hombres_profesion, 
                                                          carreras_tecnicas_contratistas_hombres_profesion,
                                                          observaciones_carreras_tecnicas,
                                                          otras_carreras_propios_mujeres_profesion,
                                                          otras_carreras_contratistas_mujeres_profesion, 
                                                          otras_carreras_propios_hombres_profesion, 
                                                          otras_carreras_contratistas_hombres_profesion,
                                                          observaciones_otras_carreras,
                                                          sin_profesion_propios_mujeres_profesion,
                                                          sin_profesion_contratistas_mujeres_profesion, 
                                                          sin_profesion_propios_hombres_profesion, 
                                                          sin_profesion_contratistas_hombres_profesion,
                                                          observaciones_sin_profesion,
                                                          total_propios_mujeres_profesion, 
                                                          total_contratistas_mujeres_profesion, 
                                                          total_propios_hombres_profesion, 
                                                          total_contratistas_hombres_profesion,
                                                          sin_estudios_propios_mujeres,
                                                          sin_estudios_contratistas_mujeres, 
                                                          sin_estudios_propios_hombres, 
                                                          sin_estudios_contratistas_hombres,
                                                          observaciones_sin_estudios,
                                                          Estudios_Media_propios_mujeres,
                                                          Estudios_Media_contratistas_mujeres, 
                                                          Estudios_Media_propios_hombres, 
                                                          Estudios_Media_contratistas_hombres,
                                                          observaciones_Estudios_Media,
                                                          Personas_Carreras_tecnicas_propios_mujeres,
                                                          Personas_Carreras_tecnicas_contratistas_mujeres, 
                                                          Personas_Carreras_tecnicas_propios_hombres, 
                                                          Personas_Carreras_tecnicas_contratistas_hombres,
                                                          observaciones_Personas_Carreras_tecnicas,
                                                          Personas_Carreras_profesionales_propios_mujeres,
                                                          Personas_Carreras_profesionales_contratistas_mujeres, 
                                                          Personas_Carreras_profesionales_propios_hombres, 
                                                          Personas_Carreras_profesionales_contratistas_hombres,
                                                          observaciones_Personas_Carreras_profesionales,
                                                          Personas_PostGrado_maestrias_doctorados_MBA_propios_mujeres,
                                                          Personas_PostGrado_maestrias_doctorados_MBA_contratistas_mujeres, 
                                                          Personas_PostGrado_maestrias_doctorados_MBA_propios_hombres, 
                                                          Personas_PostGrado_maestrias_doctorados_MBA_contratistas_hombres,
                                                          observaciones_PostGrado,
                                                          total_escolaridad_propios_mujeres, 
                                                          total_escolaridad_contratistas_mujeres, 
                                                          total_escolaridad_propios_hombres, 
                                                          total_escolaridad_contratistas_hombres   ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


// Codificar el array tipo_proveedor como cadena JSON para el almacenamiento
$tipo_proveedor_json = json_encode($datos['tipo_proveedor']);
$procesos_cadena_valor_json = json_encode($datos['procesos_cadena_valor']);


// Vincular los parámetros a la sentencia
$stmt->bind_param(
    "ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss", // 177 's' correspondientes a 15 campos de string
    $datos['company_name'],
    $datos['company_rut'],
    $total_personal_propio,
    $total_personal_contratista,
    $tipo_proveedor_json, 
    $procesos_cadena_valor_json,
    $mujeres1830Propios,
    $mujeres1830Contratistas,
    $hombres1830Propios,
    $hombres1830Contratistas,
    $observaciones1830,
    $mujeres3140Propios,
    $mujeres3140Contratistas,
    $hombres3140Propios,
    $hombres3140Contratistas,
    $observaciones3140,
    $mujeres4150Propios,
    $mujeres4150Contratistas,
    $hombres4150Propios,
    $hombres4150Contratistas,
    $observaciones4150,
    $mujeres5160Propios,
    $mujeres5160Contratistas,
    $hombres5160Propios,
    $hombres5160Contratistas,
    $observaciones5160,
    $mujeres61Propios,
    $mujeres61Contratistas,
    $hombres61Propios,
    $hombres61Contratistas,
    $observaciones61,
    $mujeresTotalPropios,
    $mujeresTotalContratistas,
    $hombresTotalPropios,
    $hombresTotalContratistas,
    $datos['antiguedad_menos_1_mujeres_propias'],
    $datos['antiguedad_menos_1_mujeres_contratistas'],
    $datos['antiguedad_menos_1_hombres_propios'],
    $datos['antiguedad_menos_1_hombres_contratistas'],
    $observacionesMenos1,
    $datos['antiguedad_menos_1_5_mujeres_propias'],
    $datos['antiguedad_menos_1_5_mujeres_contratistas'],
    $datos['antiguedad_menos_1_5_hombres_propios'],
    $datos['antiguedad_menos_1_5_hombres_contratistas'],
    $observacionesMenos15,
    $datos['antiguedad_menos_6_10_mujeres_propias'],
    $datos['antiguedad_menos_6_10_mujeres_contratistas'],
    $datos['antiguedad_menos_6_10_hombres_propios'],
    $datos['antiguedad_menos_6_10_hombres_contratistas'],
    $observacionesMenos610,
    $datos['antiguedad_menos_11_20_mujeres_propias'],
    $datos['antiguedad_menos_11_20_mujeres_contratistas'],
    $datos['antiguedad_menos_11_20_hombres_propios'],
    $datos['antiguedad_menos_11_20_hombres_contratistas'],
    $observacionesMenos1120,
    $datos['antiguedad_menos_21_mujeres_propias'],
    $datos['antiguedad_menos_21_mujeres_contratistas'],
    $datos['antiguedad_menos_21_hombres_propios'],
    $datos['antiguedad_menos_21_hombres_contratistas'],
    $observacionesMenos21,
    $mujeresTotalAntiguedadPropios,
    $mujeresTotalAntiguedadContratistas,
    $hombresTotalAntiguedadPropios,
    $hombresTotalAntiguedadContratistas,
    $datos['directores_propios_mujeres'],
    $datos['directores_contratistas_mujeres'],
    $datos['directores_propios_hombres'],
    $datos['directores_contratistas_hombres'],
    $observacionesDirectores,
    $datos['Subgerentes_Superintendentes_propios_mujeres'],
    $datos['Subgerentes_Superintendentes_contratistas_mujeres'],
    $datos['Subgerentes_Superintendentes_propios_hombres'],
    $datos['Subgerentes_Superintendentes_contratistas_hombres'],
    $observacionesSubgerentesSuperintendentes,
    $datos['Jefas_areas_propios_mujeres'],
    $datos['Jefas_areas_contratistas_mujeres'],
    $datos['Jefas_areas_propios_hombres'],
    $datos['Jefas_areas_contratistas_hombres'],
    $observacionesJefasAreas,
    $datos['Supervisoras_propios_mujeres'],
    $datos['Supervisoras_contratistas_mujeres'],
    $datos['Supervisoras_propios_hombres'],
    $datos['Supervisoras_contratistas_hombres'],
    $observacionesSupervisoras,
    $datos['Profesionales_propios_mujeres'],
    $datos['Profesionales_contratistas_mujeres'],
    $datos['Profesionales_propios_hombres'],
    $datos['Profesionales_contratistas_hombres'],
    $observacionesProfesionales,
    $datos['Analistas_propios_mujeres'],
    $datos['Analistas_contratistas_mujeres'],
    $datos['Analistas_propios_hombres'],
    $datos['Analistas_contratistas_hombres'],
    $observacionesAnalistas,
    $datos['Operadoras_propios_mujeres'],
    $datos['Operadoras_contratistas_mujeres'],
    $datos['Operadoras_propios_hombres'],
    $datos['Operadoras_contratistas_hombres'],
    $observacionesOperadoras,
    $datos['Mantenedoras_propios_mujeres'],
    $datos['Mantenedoras_contratistas_mujeres'],
    $datos['Mantenedoras_propios_hombres'],
    $datos['Mantenedoras_contratistas_hombres'],
    $observacionesMantenedoras,
    $datos['Administrativo_propios_mujeres'],
    $datos['Administrativo_contratistas_mujeres'],
    $datos['Administrativo_propios_hombres'],
    $datos['Administrativo_contratistas_hombres'],
    $observacionesAdministrativo,
    $mujeresTotalCargoPropios,
    $mujeresTotalCargoContratistas,
    $hombresTotalCargoPropios,
    $hombresTotalCargoContratistas,
    $datos['Ing_minas_propios_mujeres_profesion'],
    $datos['Ing_minas_contratistas_mujeres_profesion'],
    $datos['Ing_minas_propios_hombres_profesion'],
    $datos['Ing_minas_contratistas_hombres_profesion'],
    $observacionesMinas,
    $datos['Ing_metalurgia_quimica_propios_mujeres_profesion'],
    $datos['Ing_metalurgia_quimica_contratistas_mujeres_profesion'],
    $datos['Ing_metalurgia_quimica_propios_hombres_profesion'],
    $datos['Ing_metalurgia_quimica_contratistas_hombres_profesion'],
    $observacionesMetalurgiaQuimica,
    $datos['Ing_electrica_mecanica_propios_mujeres_profesion'],
    $datos['Ing_electrica_mecanica_contratistas_mujeres_profesion'],
    $datos['Ing_electrica_mecanica_propios_hombres_profesion'],
    $datos['Ing_electrica_mecanica_contratistas_hombres_profesion'],
    $observacionesElectricaMecanica,
    $datos['Ing_industrial_comercial_propios_mujeres_profesion'],
    $datos['Ing_industrial_comercial_contratistas_mujeres_profesion'],
    $datos['Ing_industrial_comercial_propios_hombres_profesion'],
    $datos['Ing_industrial_comercial_contratistas_hombres_profesion'],
    $observacionesIndustrialComercial,
    $datos['otras_ingenierias_propios_mujeres_profesion'],
    $datos['otras_ingenierias_contratistas_mujeres_profesion'],
    $datos['otras_ingenierias_propios_hombres_profesion'],
    $datos['otras_ingenierias_contratistas_hombres_profesion'],
    $observacionesOtrasIngenierias,
    $datos['carreras_tecnicas_propios_mujeres_profesion'],
    $datos['carreras_tecnicas_contratistas_mujeres_profesion'],
    $datos['carreras_tecnicas_propios_hombres_profesion'],
    $datos['carreras_tecnicas_contratistas_hombres_profesion'],
    $observacionesCarrerasTecnicas,
    $datos['otras_carreras_propios_mujeres_profesion'],
    $datos['otras_carreras_contratistas_mujeres_profesion'],
    $datos['otras_carreras_propios_hombres_profesion'],
    $datos['otras_carreras_contratistas_hombres_profesion'],
    $observacionesOtrasCarreras,
    $datos['sin_profesion_propios_mujeres_profesion'],
    $datos['sin_profesion_contratistas_mujeres_profesion'],
    $datos['sin_profesion_propios_hombres_profesion'],
    $datos['sin_profesion_contratistas_hombres_profesion'],
    $observacionesSinProfesion,
    $mujeresTotalProfesionPropios,
    $mujeresTotalProfesionContratistas,
    $hombresTotalProfesionPropios,
    $hombresTotalProfesionContratistas,
    $datos['sin_estudios_propios_mujeres'],
    $datos['sin_estudios_contratistas_mujeres'],
    $datos['sin_estudios_propios_hombres'],
    $datos['sin_estudios_contratistas_hombres'],
    $observacionesSinEstudios,
    $datos['Estudios_Media_propios_mujeres'],
    $datos['Estudios_Media_contratistas_mujeres'],
    $datos['Estudios_Media_propios_hombres'],
    $datos['Estudios_Media_contratistas_hombres'],
    $observacionesEstudiosMedia,
    $datos['Personas_Carreras_tecnicas_propios_mujeres'],
    $datos['Personas_Carreras_tecnicas_contratistas_mujeres'],
    $datos['Personas_Carreras_tecnicas_propios_hombres'],
    $datos['Personas_Carreras_tecnicas_contratistas_hombres'],
    $observacionesPersonasCarrerasTecnicas,
    $datos['Personas_Carreras_profesionales_propios_mujeres'],
    $datos['Personas_Carreras_profesionales_contratistas_mujeres'],
    $datos['Personas_Carreras_profesionales_propios_hombres'],
    $datos['Personas_Carreras_profesionales_contratistas_hombres'],
    $observacionesPersonasCarrerasProfesionales,
    $datos['Personas_PostGrado_maestrias_doctorados_MBA_propios_mujeres'],
    $datos['Personas_PostGrado_maestrias_doctorados_MBA_contratistas_mujeres'],
    $datos['Personas_PostGrado_maestrias_doctorados_MBA_propios_hombres'],
    $datos['Personas_PostGrado_maestrias_doctorados_MBA_contratistas_hombres'],
    $observacionesPostGrado,
    $mujeresTotalEscolaridadPropios,
    $mujeresTotalEscolaridadContratistas,
    $hombresTotalEscolaridadPropios,
    $hombresTotalEscolaridadContratistas
    
);



// Ejecutar la sentencia y responder acorde
if ($stmt->execute()) {
    echo json_encode(['resultado' => 'Datos guardados con éxito.']);
} else {
    http_response_code(500); // Código de respuesta HTTP para error de servidor
    echo json_encode(['error' => 'Error al guardar los datos: ' . $stmt->error]);
}

// Cerrar la sentencia y la conexión
$stmt->close();
$conn->close();

?>
