<?php

session_start();

// Obteniendo los valores de las variables de sesión
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


// Verificar si todas las preguntas han sido respondidas
//información de la empresa 
$company_name = $_POST['company_name'] ?? '';
$company_rut = $_POST['company_rut'] ?? '';


// Recibir los datos del formulario
// Sección I: Cultura Corporativa y Diagnóstico

$respuesta_politicas_genero = isset($_POST['respuesta_politicas_genero']) && $_POST['respuesta_politicas_genero'] == '1' ? 'Sí' : 'No';
$observaciones_politicas_genero = isset($_POST['observaciones_politicas_genero']) ? $_POST['observaciones_politicas_genero'] : '';
$respuesta_diagnostico_genero = isset($_POST['respuesta_diagnostico_genero']) && $_POST['respuesta_diagnostico_genero'] == '1' ? 'Sí' : 'No';
$observaciones_diagnostico_genero = isset($_POST['observaciones_diagnostico_genero']) ? $_POST['observaciones_diagnostico_genero'] : '';
$respuesta_metas_femeninas = isset($_POST['respuesta_metas_femeninas']) && $_POST['respuesta_metas_femeninas'] == '1' ? 'Sí' : 'No';
$observaciones_metas_femeninas = isset($_POST['observaciones_metas_femeninas']) ? $_POST['observaciones_metas_femeninas'] : '';
$respuesta_indicadores_genero = isset($_POST['respuesta_indicadores_genero']) && $_POST['respuesta_indicadores_genero'] == '1' ? 'Sí' : 'No';
$observaciones_indicadores_genero = isset($_POST['observaciones_indicadores_genero']) ? $_POST['observaciones_indicadores_genero'] : '';


// Sección II: Compromiso con las políticas de género nacionales y sectoriales
$respuesta_certificacion_norma = isset($_POST['certificacion_norma']) && $_POST['certificacion_norma'] == '1' ? 'Sí' : 'No';
$observaciones_certificacion_norma = isset($_POST['observaciones_certificacion_norma']) ? $_POST['observaciones_certificacion_norma'] : '';
$respuesta_mesa_mujer_mineria = isset($_POST['mesa_mujer_mineria']) && $_POST['mesa_mujer_mineria'] == '1' ? 'Sí' : 'No';
$observaciones_mesa_mujer_mineria = isset($_POST['observaciones_mesa_mujer_mineria']) ? $_POST['observaciones_mesa_mujer_mineria'] : '';
$respuesta_plataforma_pnud = isset($_POST['plataforma_pnud']) && $_POST['plataforma_pnud'] == '1' ? 'Sí' : 'No';
$observaciones_plataforma_pnud = isset($_POST['observaciones_plataforma_pnud']) ? $_POST['observaciones_plataforma_pnud'] : '';
$respuesta_politica_nacional_genero = isset($_POST['politica_nacional_genero']) && $_POST['politica_nacional_genero'] == '1' ? 'Sí' : 'No';
$observaciones_politica_nacional_genero = isset($_POST['observaciones_politica_nacional_genero']) ? $_POST['observaciones_politica_nacional_genero'] : '';


// Sección III: Conciliación Laboral
$respuesta_beneficio_postnatal = isset($_POST['beneficio_postnatal']) && $_POST['beneficio_postnatal'] == '1' ? 'Sí' : 'No';
$observaciones_beneficio_postnatal = isset($_POST['observaciones_beneficio_postnatal']) ? $_POST['observaciones_beneficio_postnatal'] : '';
$respuesta_adaptabilidad_laboral = isset($_POST['adaptabilidad_laboral']) && $_POST['adaptabilidad_laboral'] == '1' ? 'Sí' : 'No';
$observaciones_adaptabilidad_laboral = isset($_POST['observaciones_adaptabilidad_laboral']) ? $_POST['observaciones_adaptabilidad_laboral'] : '';
$respuesta_flexibilidad_madres = isset($_POST['flexibilidad_madres']) && $_POST['flexibilidad_madres'] == '1' ? 'Sí' : 'No';
$observaciones_flexibilidad_madres = isset($_POST['observaciones_flexibilidad_madres']) ? $_POST['observaciones_flexibilidad_madres'] : '';

// Sección IV: Desarrollo y capacitación
$respuesta_programas = isset($_POST['programas']) && $_POST['programas'] == '1' ? 'Sí' : 'No';
$observaciones_programas = isset($_POST['observaciones_programas']) ? $_POST['observaciones_programas'] : '';
$respuesta_capacita = isset($_POST['capacita']) && $_POST['capacita'] == '1' ? 'Sí' : 'No';
$observaciones_capacita = isset($_POST['observaciones_capacita']) ? $_POST['observaciones_capacita'] : '';


// Sección V: Equidad salarial
$respuesta_equidad_salarial = isset($_POST['equidad_salarial']) && $_POST['equidad_salarial'] == '1' ? 'Sí' : 'No';
$observaciones_equidad_salarial = isset($_POST['observaciones_equidad_salarial']) ? $_POST['observaciones_equidad_salarial'] : '';


// Sección VI: Reclutamiento y retención
$respuesta_incorpora_perspectiva = isset($_POST['incorpora_perspectiva']) && $_POST['incorpora_perspectiva'] == '1' ? 'Sí' : 'No';
$observaciones_incorpora_perspectiva = isset($_POST['observaciones_incorpora_perspectiva']) ? $_POST['observaciones_incorpora_perspectiva'] : '';
$respuesta_politicas_femeninas = isset($_POST['politicas_femeninas']) && $_POST['politicas_femeninas'] == '1' ? 'Sí' : 'No';
$observaciones_politicas_femeninas = isset($_POST['observaciones_politicas_femeninas']) ? $_POST['observaciones_politicas_femeninas'] : '';


// Sección VII: Comunicación y sensibilización
$respuesta_estrategia_comunicacion = isset($_POST['estrategia_comunicacion']) && $_POST['estrategia_comunicacion'] == '1' ? 'Sí' : 'No';
$observaciones_estrategia_comunicacion = isset($_POST['observaciones_estrategia_comunicacion']) ? $_POST['observaciones_estrategia_comunicacion'] : '';
$respuesta_difusion_trabajadores = isset($_POST['difusion_trabajadores']) && $_POST['difusion_trabajadores'] == '1' ? 'Sí' : 'No';
$observaciones_difusion_trabajadores = isset($_POST['observaciones_difusion_trabajadores']) ? $_POST['observaciones_difusion_trabajadores'] : '';


// Sección VIII: Participación y seguridad
$respuesta_acciones_participacion = isset($_POST['acciones_participacion']) && $_POST['acciones_participacion'] == '1' ? 'Sí' : 'No';
$observaciones_acciones_participacion = isset($_POST['observaciones_acciones_participacion']) ? $_POST['observaciones_acciones_participacion'] : '';
$respuesta_mecanismos_participacion = isset($_POST['mecanismos_participacion']) && $_POST['mecanismos_participacion'] == '1' ? 'Sí' : 'No';
$observaciones_mecanismos_participacion = isset($_POST['observaciones_mecanismos_participacion']) ? $_POST['observaciones_mecanismos_participacion'] : '';
$respuesta_equipo_seguridad = isset($_POST['equipo_seguridad']) && $_POST['equipo_seguridad'] == '1' ? 'Sí' : 'No';
$observaciones_equipo_seguridad = isset($_POST['observaciones_equipo_seguridad']) ? $_POST['observaciones_equipo_seguridad'] : '';


// Sección IX: Violencia de género
$respuesta_acoso_laboral = isset($_POST['acoso_laboral']) && $_POST['acoso_laboral'] == '1' ? 'Sí' : 'No';
$observaciones_acoso_laboral = isset($_POST['observaciones_acoso_laboral']) ? $_POST['observaciones_acoso_laboral'] : '';
$respuesta_instrumentos_control = isset($_POST['instrumentos_control']) && $_POST['instrumentos_control'] == '1' ? 'Sí' : 'No';
$observaciones_instrumentos_control = isset($_POST['observaciones_instrumentos_control']) ? $_POST['observaciones_instrumentos_control'] : '';
$respuesta_iniciativas_contra_violencia = isset($_POST['iniciativas_contra_violencia']) && $_POST['iniciativas_contra_violencia'] == '1' ? 'Sí' : 'No';
$observaciones_iniciativas_contra_violencia = isset($_POST['observaciones_iniciativas_contra_violencia']) ? $_POST['observaciones_iniciativas_contra_violencia'] : '';


// Crear la consulta SQL para insertar los datos
$sql = "INSERT INTO encuesta_genero (
    company_name, company_rut,
    respuesta_politicas_genero, observaciones_politicas_genero, 
    respuesta_diagnostico_genero, observaciones_diagnostico_genero,
    respuesta_metas_femeninas, observaciones_metas_femeninas,
    respuesta_indicadores_genero, observaciones_indicadores_genero,
    respuesta_certificacion_norma, observaciones_certificacion_norma,
    respuesta_mesa_mujer_mineria, observaciones_mesa_mujer_mineria,
    respuesta_plataforma_pnud, observaciones_plataforma_pnud,
    respuesta_politica_nacional_genero, observaciones_politica_nacional_genero,
    respuesta_beneficio_postnatal, observaciones_beneficio_postnatal,
    respuesta_adaptabilidad_laboral, observaciones_adaptabilidad_laboral,
    respuesta_flexibilidad_madres, observaciones_flexibilidad_madres,
    respuesta_programas, observaciones_programas,
    respuesta_capacita, observaciones_capacita,
    respuesta_equidad_salarial, observaciones_equidad_salarial,
    respuesta_incorpora_perspectiva, observaciones_incorpora_perspectiva,
    respuesta_politicas_femeninas, observaciones_politicas_femeninas,
    respuesta_estrategia_comunicacion, observaciones_estrategia_comunicacion,
    respuesta_difusion_trabajadores, observaciones_difusion_trabajadores,
    respuesta_acciones_participacion, observaciones_acciones_participacion,
    respuesta_mecanismos_participacion, observaciones_mecanismos_participacion,
    respuesta_equipo_seguridad, observaciones_equipo_seguridad,
    respuesta_acoso_laboral, observaciones_acoso_laboral,
    respuesta_instrumentos_control, observaciones_instrumentos_control,
    respuesta_iniciativas_contra_violencia, observaciones_iniciativas_contra_violencia
    ) VALUES (
     '$company_name', '$company_rut',
    '$respuesta_politicas_genero', '$observaciones_politicas_genero', 
    '$respuesta_diagnostico_genero', '$observaciones_diagnostico_genero',
    '$respuesta_metas_femeninas', '$observaciones_metas_femeninas',
    '$respuesta_indicadores_genero', '$observaciones_indicadores_genero',
    '$respuesta_certificacion_norma', '$observaciones_certificacion_norma',
    '$respuesta_mesa_mujer_mineria', '$observaciones_mesa_mujer_mineria',
    '$respuesta_plataforma_pnud', '$observaciones_plataforma_pnud',
    '$respuesta_politica_nacional_genero', '$observaciones_politica_nacional_genero',
    '$respuesta_beneficio_postnatal', '$observaciones_beneficio_postnatal',
    '$respuesta_adaptabilidad_laboral', '$observaciones_adaptabilidad_laboral',
    '$respuesta_flexibilidad_madres', '$observaciones_flexibilidad_madres',
    '$respuesta_programas', '$observaciones_programas',
    '$respuesta_capacita', '$observaciones_capacita',
    '$respuesta_equidad_salarial', '$observaciones_equidad_salarial',
    '$respuesta_incorpora_perspectiva', '$observaciones_incorpora_perspectiva',
    '$respuesta_politicas_femeninas', '$observaciones_politicas_femeninas',
    '$respuesta_estrategia_comunicacion', '$observaciones_estrategia_comunicacion',
    '$respuesta_difusion_trabajadores', '$observaciones_difusion_trabajadores',
    '$respuesta_acciones_participacion', '$observaciones_acciones_participacion',
    '$respuesta_mecanismos_participacion', '$observaciones_mecanismos_participacion',
    '$respuesta_equipo_seguridad', '$observaciones_equipo_seguridad',
    '$respuesta_acoso_laboral', '$observaciones_acoso_laboral',
    '$respuesta_instrumentos_control', '$observaciones_instrumentos_control',
    '$respuesta_iniciativas_contra_violencia', '$observaciones_iniciativas_contra_violencia'
    )";


// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Muchas gracias por responder nuestro Formulario."); window.location.href = "encuesta_genero.html";</script>';
} else {
    echo '<script>alert("Error al guardar los datos: ' . $sql . '"); window.location.href = "encuesta_genero.html";</script>';
}

