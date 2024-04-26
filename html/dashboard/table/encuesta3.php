<?php
session_start(); // Asegúrate de iniciar la sesión al principio del archivo
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario de Registro</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" type="image/png" href="https://www.sicep.cl/favicon.ico">
<link href="style.css" rel="stylesheet">

</head>

<body style="background-color: #F2F3F4;">
  <div class="img-cabecera mt-5 mb-5" style="text-align: center;">
    <img src="https://www.pruebadyc.cl/AIA.png" style="width: 150px; height: auto;">
    <img src="https://www.pruebadyc.cl/cochilco.png" style="width: 150px; height: auto;">
    <img src="https://www.pruebadyc.cl/Marca-AIA.png" style="width: 150px; height: auto;">
    
  </div>

  <!-- Contenedor del formulario -->
  <h1 class="mb-5">Formulario de Evaluación - Cadena de Valor Minero</h1>
  <form id="personal-form" method="post" accept-charset="UTF-8" action="guardarTerceraSeccion.php" onsubmit="return validarFormulario()">
    <div id="registration-form">
      <ul id="step-indicator">
        
        <li>Estadística de Género</li>
        <li class="active">Políticas de género vinculadas al sector minero que han adoptado los proveedores</li>
      </ul>

      <input type="hidden" name="company_name" value="<?php echo $_SESSION['nombre_empresa']; ?>">
      <input type="hidden" name="company_rut" value="<?php echo $_SESSION['rut_empresa']; ?>">


      <!-- Sección de la cuenta -->
      <div id="image-form" class="form-section active">
        <h2>Políticas de género vinculadas al sector minero que han adoptado los proveedores</h2><br>
          <!-- pregunta1 -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>I. Cultura Corporativa y Diagnóstico</th>
                  <th>Respuesta</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <div class="alert alert-primary" role="alert">
                <small id="sustainable-help" class="form-text text-muted">Responder  si o no, si su respuesta es “no” comente en observaciones de ser posible , el porqué.</small>
              </div>
              <tbody>
                <tr>
                  <td>La empresa cuenta con políticas/objetivos/metas en materia de género, diversidad e inclusión.</td>
                  <td>
                    Sí <input type="radio" name="respuesta_politicas_genero" value="1" onclick="mostrarObservacion('observaciones_politicas_genero', false)">
                    No <input type="radio" name="respuesta_politicas_genero" value="0" onclick="mostrarObservacion('observaciones_politicas_genero', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_politicas_genero" id="observaciones_politicas_genero" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa ha realizado un diagnóstico organizacional con enfoque de género.</td>
                  <td>
                    Sí <input type="radio" name="respuesta_diagnostico_genero" value="1" onclick="mostrarObservacion('observaciones_diagnostico_genero', false)">
                    No <input type="radio" name="respuesta_diagnostico_genero" value="0" onclick="mostrarObservacion('observaciones_diagnostico_genero', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_diagnostico_genero" id="observaciones_diagnostico_genero" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa ha establecido metas de participación laboral femenina respecto de la dotación total al 2030.</td>
                  <td>
                    Sí <input type="radio" name="respuesta_metas_femeninas" value="1" onclick="mostrarObservacion('observaciones_metas_femeninas', false)">
                    No <input type="radio" name="respuesta_metas_femeninas" value="0" onclick="mostrarObservacion('observaciones_metas_femeninas', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_metas_femeninas" id="observaciones_metas_femeninas" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa incorporó indicadores de género para la medición de su gestión.</td>
                  <td>
                    Sí <input type="radio" name="respuesta_indicadores_genero" value="1" onclick="mostrarObservacion('observaciones_indicadores_genero', false)">
                    No <input type="radio" name="respuesta_indicadores_genero" value="0" onclick="mostrarObservacion('observaciones_indicadores_genero', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_indicadores_genero" id="observaciones_indicadores_genero" placeholder="Explique por qué" disabled></td>
                </tr>
              </tbody>
            </table>
          </div><br>
          <br>
          <br>
          
         

          <!-- pregunta 2 -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>II. Compromiso con las políticas de género nacionales y sectoriales</th>
                  <th>Respuesta</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <div class="alert alert-primary" role="alert">
                <small id="sustainable-help" class="form-text text-muted">Responder  si o no, si su respuesta es “no” comente en observaciones de ser posible , el porqué.</small>
              </div>
              <tbody>
                <tr>
                  <td>La empresa se encuentra certificada con la norma NCh 3262.</td>
                  <td>
                    Sí <input type="radio" name="respuesta_certificacion_norma" value="1" onclick="mostrarObservacion('observaciones_certificacion_norma', false)">
                    No <input type="radio" name="respuesta_certificacion_norma" value="0" onclick="mostrarObservacion('observaciones_certificacion_norma', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_certificacion_norma" id="observaciones_certificacion_norma" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa participa en la mesa Mujer y Minería.</td>
                  <td>
                    Sí <input type="radio" name="respuesta_mesa_mujer_mineria" value="1" onclick="mostrarObservacion('observaciones_mesa_mujer_mineria', false)">
                    No <input type="radio" name="respuesta_mesa_mujer_mineria" value="0" onclick="mostrarObservacion('observaciones_mesa_mujer_mineria', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_mesa_mujer_mineria" id="observaciones_mesa_mujer_mineria" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa utiliza la plataforma INDIC@IGUALDAD del Programa de las Naciones Unidas para el Desarrollo (PNUD).
                  </td>
                  <td>
                    Sí <input type="radio" name="respuesta_plataforma_pnud" value="1" onclick="mostrarObservacion('observaciones_plataforma_pnud', false)">
                    No <input type="radio" name="respuesta_plataforma_pnud" value="0" onclick="mostrarObservacion('observaciones_plataforma_pnud', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_plataforma_pnud" id="observaciones_plataforma_pnud" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa ha incorporado la perspectiva de género y diversidad en la Política Nacional Seguridad y Salud en el Trabajo.</td>
                  <td>
                    Sí <input type="radio" name="respuesta_politica_nacional_genero" value="1" onclick="mostrarObservacion('observaciones_politica_nacional_genero', false)">
                    No <input type="radio" name="respuesta_politica_nacional_genero" value="0" onclick="mostrarObservacion('observaciones_politica_nacional_genero', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_politica_nacional_genero" id="observaciones_politica_nacional_genero" placeholder="Explique por qué" disabled></td>
                </tr>
              </tbody>
            </table>
          </div><br>
          <br>
          <br>
          
          <script>
          function mostrarObservacion(idObservacion, mostrar) {
            var campoObservacion = document.getElementById(idObservacion);
            campoObservacion.disabled = !mostrar;
            if (!mostrar) {
              campoObservacion.value = ""; // Limpiar el campo si se cambia a "Sí"
            }
          }
          </script><br>
          <br>
          <br>
          
          <!-- pregunta 3 -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>III. Conciliación Laboral</th>
                  <th>Respuesta</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <div class="alert alert-primary" role="alert">
                <small id="sustainable-help" class="form-text text-muted">Responder  si o no, si su respuesta es “no” comente en observaciones de ser posible , el porqué.</small>
              </div>
              <tbody>
                <tr>
                  <td>La empresa cuenta con algún beneficio de extensión de postnatal para madre y/o padre.</td>
                  <td>
                    Sí <input type="radio" name="beneficio_postnatal" value="1" onclick="mostrarObservacion('observaciones_beneficio_postnatal', false)">
                    No <input type="radio" name="beneficio_postnatal" value="0" onclick="mostrarObservacion('observaciones_beneficio_postnatal', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_beneficio_postnatal" id="observaciones_beneficio_postnatal" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa cuenta con adaptabilidad laboral, teletrabajo y/o flexibilidad en el espacio y el tiempo.</td>
                  <td>
                    Sí <input type="radio" name="adaptabilidad_laboral" value="1" onclick="mostrarObservacion('observaciones_adaptabilidad_laboral', false)">
                    No <input type="radio" name="adaptabilidad_laboral" value="0" onclick="mostrarObservacion('observaciones_adaptabilidad_laboral', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_adaptabilidad_laboral" id="observaciones_adaptabilidad_laboral" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa cuenta con flexibilidad para madres embarazadas y en etapa de amamantamiento.</td>
                  <td>
                    Sí <input type="radio" name="flexibilidad_madres" value="1" onclick="mostrarObservacion('observaciones_flexibilidad_madres', false)">
                    No <input type="radio" name="flexibilidad_madres" value="0" onclick="mostrarObservacion('observaciones_flexibilidad_madres', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_flexibilidad_madres" id="observaciones_flexibilidad_madres" placeholder="Explique por qué" disabled></td>
                </tr>
              </tbody>
            </table>
          </div>
          
      
          <br>
          <br>
          <br>

          <!-- pregunta 4 -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>IV. Desarrollo y capacitación</th>
                  <th>Respuesta</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <div class="alert alert-primary" role="alert">
                <small id="sustainable-help" class="form-text text-muted">Responder  si o no, si su respuesta es “no” comente en observaciones de ser posible , el porqué.</small>
              </div>
              <tbody>
                <tr>
                  <td>La empresa cuenta con programas de formación técnica para mujeres aprendices y/o desarrollo profesional de mujeres.</td>
                  <td>
                    Sí <input type="radio" name="programas" value="1" onclick="mostrarObservacion('observaciones_programas', false)">
                    No <input type="radio" name="programas" value="0" onclick="mostrarObservacion('observaciones_programas', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_programas" id="observaciones_programas" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa capacita a cargos de jefatura respecto de la integración adecuada de las mujeres.</td>
                  <td>
                    Sí <input type="radio" name="capacita" value="1" onclick="mostrarObservacion('observaciones_capacita', false)">
                    No <input type="radio" name="capacita" value="0" onclick="mostrarObservacion('observaciones_capacita', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_capacita" id="observaciones_capacita" placeholder="Explique por qué" disabled></td>
                </tr>
              </tbody>
            </table>
          </div>
          
          
          <br>
          <br>
          <br>


          <!-- pregunta 5 -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>V. Equidad salarial</th>
                  <th>Respuesta</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <div class="alert alert-primary" role="alert">
                <small id="sustainable-help" class="form-text text-muted">Responder  si o no, si su respuesta es “no” comente en observaciones de ser posible , el porqué.</small>
              </div>
              <tbody>
                <tr>
                  <td>La empresa cuenta con políticas de equidad salarial por responsabilidades y/o normas de remuneración y compensación basados en criterios de igualdad.</td>
                  <td>
                    Sí <input type="radio" name="equidad_salarial" value="1" onclick="mostrarObservacion('observaciones_equidad_salarial', false)">
                    No <input type="radio" name="equidad_salarial" value="0" onclick="mostrarObservacion('observaciones_equidad_salarial', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_equidad_salarial" id="observaciones_equidad_salarial" placeholder="Explique por qué" disabled></td>
                </tr>
              </tbody>
            </table>
          </div>
          
            
          <br>
          <br>
          <br>


          <!-- pregunta 6 -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>VI. Reclutamiento y retención</th>
                  <th>Respuesta</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <div class="alert alert-primary" role="alert">
                <small id="sustainable-help" class="form-text text-muted">Responder  si o no, si su respuesta es “no” comente en observaciones de ser posible , el porqué.</small>
              </div>
              <tbody>
                <tr>
                  <td>La empresa incorpora perspectiva de género en procesos de reclutamiento y selección.</td>
                  <td>
                    Sí <input type="radio" name="incorpora_perspectiva" value="1" onclick="mostrarObservacion('observaciones_incorpora_perspectiva', false)">
                    No <input type="radio" name="incorpora_perspectiva" value="0" onclick="mostrarObservacion('observaciones_incorpora_perspectiva', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_incorpora_perspectiva" id="observaciones_incorpora_perspectiva" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>Existen políticas de retención de talento femenino de la empresa.</td>
                  <td>
                    Sí <input type="radio" name="politicas_femeninas" value="1" onclick="mostrarObservacion('observaciones_politicas_femeninas', false)">
                    No <input type="radio" name="politicas_femeninas" value="0" onclick="mostrarObservacion('observaciones_politicas_femeninas', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_politicas_femeninas" id="observaciones_politicas_femeninas" placeholder="Explique por qué" disabled></td>
                </tr>
              </tbody>
            </table>
          </div>
          
          
          <br>
          <br>
          <br>

          <!-- pregunta 7 -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>VII. Comunicación y sensibilización</th>
                  <th>Respuesta</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <div class="alert alert-primary" role="alert">
                <small id="sustainable-help" class="form-text text-muted">Responder  si o no, si su respuesta es “no” comente en observaciones de ser posible , el porqué.</small>
              </div>
              <tbody>
                <tr>
                  <td>La empresa cuenta con una estrategia de comunicación interna y externa sin sesgos de género.</td>
                  <td>
                    Sí <input type="radio" name="estrategia_comunicacion" value="1" onclick="mostrarObservacion('observaciones_estrategia_comunicacion', false)">
                    No <input type="radio" name="estrategia_comunicacion" value="0" onclick="mostrarObservacion('observaciones_estrategia_comunicacion', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_estrategia_comunicacion" id="observaciones_estrategia_comunicacion" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>Hay medios de difusión que aseguren que los trabajadores están al tanto de las políticas de diversidad e inclusión dentro de la organización.</td>
                  <td>
                    Sí <input type="radio" name="difusion_trabajadores" value="1" onclick="mostrarObservacion('observaciones_difusion_trabajadores', false)">
                    No <input type="radio" name="difusion_trabajadores" value="0" onclick="mostrarObservacion('observaciones_difusion_trabajadores', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_difusion_trabajadores" id="observaciones_difusion_trabajadores" placeholder="Explique por qué" disabled></td>
                </tr>
              </tbody>
            </table>
          </div>

          <br>
          <br>
          <br>

          <!-- pregunta 8 -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>VIII. Participación y seguridad</th>
                  <th>Respuesta</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <div class="alert alert-primary" role="alert">
                <small id="sustainable-help" class="form-text text-muted">Responder  si o no, si su respuesta es “no” comente en observaciones de ser posible , el porqué.</small>
              </div>
              <tbody>
                <tr>
                  <td>La empresa cuenta con acciones que contribuyan a la participación femenina de comunidades locales.</td>
                  <td>
                    Sí <input type="radio" name="acciones_participacion" value="1" onclick="mostrarObservacion('observaciones_acciones_participacion', false)">
                    No <input type="radio" name="acciones_participacion" value="0" onclick="mostrarObservacion('observaciones_acciones_participacion', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_acciones_participacion" id="observaciones_acciones_participacion" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa cuenta con mecanismos de participación de las y los trabajadores.</td>
                  <td>
                    Sí <input type="radio" name="mecanismos_participacion" value="1" onclick="mostrarObservacion('observaciones_mecanismos_participacion', false)">
                    No <input type="radio" name="mecanismos_participacion" value="0" onclick="mostrarObservacion('observaciones_mecanismos_participacion', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_mecanismos_participacion" id="observaciones_mecanismos_participacion" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>Los equipos de seguridad y elementos de protección personal (EPP) están adaptados para garantizar que se ajusten ergonómicamente para el uso de las mujeres.</td>
                  <td>
                    Sí <input type="radio" name="equipo_seguridad" value="1" onclick="mostrarObservacion('observaciones_equipo_seguridad', false)">
                    No <input type="radio" name="equipo_seguridad" value="0" onclick="mostrarObservacion('observaciones_equipo_seguridad', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_equipo_seguridad" id="observaciones_equipo_seguridad" placeholder="Explique por qué" disabled></td>
                </tr>
              </tbody>
            </table>
          </div>
          
          <br>
          <br>
          <br>

          <!-- pregunta 9 -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>IX. Violencia de género</th>
                  <th>Respuesta</th>
                  <th>Observaciones</th>
                </tr>
              </thead>
              <div class="alert alert-primary" role="alert">
                <small id="sustainable-help" class="form-text text-muted">Responder  si o no, si su respuesta es “no” comente en observaciones de ser posible , el porqué.</small>
              </div>
              <tbody>
                <tr>
                  <td>La empresa cuenta con mecanismos o canales de denuncias de acoso laboral y/o sexual.</td>
                  <td>
                    Sí <input type="radio" name="acoso_laboral" value="1" onclick="mostrarObservacion('observaciones_acoso_laboral', false)">
                    No <input type="radio" name="acoso_laboral" value="0" onclick="mostrarObservacion('observaciones_acoso_laboral', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_acoso_laboral" id="observaciones_acoso_laboral" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa cuenta con instrumentos de control, sanción, recursos y vías de reparación.</td>
                  <td>
                    Sí <input type="radio" name="instrumentos_control" value="1" onclick="mostrarObservacion('observaciones_instrumentos_control', false)">
                    No <input type="radio" name="instrumentos_control" value="0" onclick="mostrarObservacion('observaciones_instrumentos_control', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_instrumentos_control" id="observaciones_instrumentos_control" placeholder="Explique por qué" disabled></td>
                </tr>
                <tr>
                  <td>La empresa cuenta con iniciativas contra la violencia doméstica.</td>
                  <td>
                    Sí <input type="radio" name="iniciativas_contra_violencia" value="1" onclick="mostrarObservacion('observaciones_iniciativas_contra_violencia', false)">
                    No <input type="radio" name="iniciativas_contra_violencia" value="0" onclick="mostrarObservacion('observaciones_iniciativas_contra_violencia', true)">
                  </td>
                  <td><input type="text" class="form-control" name="observaciones_iniciativas_contra_violencia" id="observaciones_iniciativas_contra_violencia" placeholder="Explique por qué" disabled></td>
                </tr>
              </tbody>
            </table>
          </div>
          <script>
            function mostrarObservacion(idObservacion, mostrar) {
              var campoObservacion = document.getElementById(idObservacion);
              campoObservacion.disabled = !mostrar;
              if (!mostrar) {
                campoObservacion.value = ""; // Limpiar el campo si se cambia a "Sí"
              }
            }
          </script>
          <br>
          <br>
          <br>
          


          <button type="button" class="btn btn-primary" onclick="window.location.href='encuesta2.html'">Anterior</button>

          <button type="submit" class="btn btn-primary" onclick="validarFormulario()">Enviar</button>
          
          
         
        
      </div>

  </form>


  <!-- Añade aquí tus scripts o enlaces a archivos de JavaScript -->
  <script>
    function validarFormulario() {
      var preguntasSiNo = document.querySelectorAll('input[type="radio"]');
      var todasContestadas = true;
  
      // Agrupamos los botones de radio por nombre
      var grupos = {};
      preguntasSiNo.forEach(function(radio) {
          if (!grupos[radio.name]) {
              grupos[radio.name] = [];
          }
          grupos[radio.name].push(radio);
      });
  
      // Verificamos que al menos uno de los botones de cada grupo esté seleccionado
      Object.keys(grupos).forEach(function(nombreGrupo) {
          if (!grupos[nombreGrupo].some(radio => radio.checked)) {
              todasContestadas = false;
          }
      });
  
      if (!todasContestadas) {
          alert("Por favor, conteste todas las preguntas con 'Sí' o 'No'.");
          return false;
      }
  
      return true;
  }
  
  

  

  </script>

 
    
      
      
      
      
    
    
    
    

    
    
    
    

  <!-- Bootstrap JS y sus dependencias (Popper y Tether) -->
  <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</body><br>
<br>
<br>
</html>

