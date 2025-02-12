<?php
session_start();
if (!isset($_SESSION['S_ID'])) {
  header('Location: ../index.php');
}
?>
<?php
if (isset($_SESSION['S_FOTO']) && !empty($_SESSION['S_FOTO'])) {
    // Verificar si la ruta es 'controller/alumnos/fotos/'
    if ($_SESSION['S_FOTO'] === 'controller/alumnos/fotos/') {
        $rutaFoto = '../img/blanco1.jpg';
    } else {
        $rutaFoto = '../' . $_SESSION['S_FOTO'];
    }
} else {
    $rutaFoto = '../img/blanco1.jpg';
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEDES SAPIENTIAE</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plantilla/plugins//fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="icon" href="../img/icono.jpeg" type="image/jpeg">

  <link rel="stylesheet" href="../plantilla/dist//css/adminlte.min.css">
  <link href="../utilitario/DataTables/datatables.min.css" type="text/css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper">
    <?php if ($_SESSION['S_ROL'] == "ADMINISTRADOR") { ?>
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown" style="text-align:justify;">
           
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="text-align:justify">
              <div id="div_cuerpo" style="text-align:justify; border: 1px solid #333333;width: 100%;font-size: 100%;overflow-x: scroll;">
              </div>


              <div class="dropdown-divider"></div>
              <a href="" class="dropdown-item dropdown-footer" onclick="listar_comunicado_dash()"><b><u>Ver Comunicados</u></b></a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <img src="../<?php echo isset($_SESSION['S_FOTO']) && !empty($_SESSION['S_FOTO']) ? $_SESSION['S_FOTO'] : '../img/blanco1.jpg'; ?>" class="img-circle elevation-1" width="15" height="18">
              <b>Usuario: <?php echo $_SESSION['S_COMPLETO'] ?></b>
              <i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="../controller/usuario/controlador_cerrar_sesion.php" class="dropdown-item">
                <i class="fas fa-power-off mr-2"></i><u><b>Cerrar Sesión</b></u>
              </a>
              <div class="dropdown-divider"></div>
            </div>
          </li>
        </ul>

      </nav>
    <?php
    }
    ?>
    <?php if ($_SESSION['S_ROL'] == "ENFERMERA" || $_SESSION['S_ROL'] == "PSICOLOGA" || $_SESSION['S_ROL'] == "AUXILIAR" || $_SESSION['S_ROL'] == "DOCENTE" || $_SESSION['S_ROL'] == "ESTUDIANTE") { ?>
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown" style="text-align:justify;">

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="text-align:justify">
              <div id="div_cuerpo" style="text-align:justify; border: 1px solid #333333;width: 100%;font-size: 100%;overflow-x: scroll;">
              </div>


              <div class="dropdown-divider"></div>
              <a href="" class="dropdown-item dropdown-footer" onclick="listar_comunicado_dash()"><b><u>Ver Comunicados</u></b></a>
            </div>
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <img src="../<?php echo isset($_SESSION['S_FOTO']) && !empty($_SESSION['S_FOTO']) ? $_SESSION['S_FOTO'] : '../img/blanco1.jpg'; ?>" class="img-circle elevation-1" width="15" height="18">

              <b>Usuario: <?php echo $_SESSION['S_COMPLETO'] ?></b>
              <i class="fas fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="../controller/usuario/controlador_cerrar_sesion.php" class="dropdown-item">
                <i class="fas fa-power-off mr-2"></i><u><b>Cerrar Sesión</b></u>
              </a>
              <div class="dropdown-divider"></div>
            </div>
          </li>
        </ul>

      </nav>
    <?php
    }
    ?>
    <!-- /.navbar -->
    <input type="text" id="txtprincipalid" value="<?php echo $_SESSION['S_ID']; ?>" hidden>
    <input type="text" id="txtprincipalfoto" value="<?php echo $_SESSION['S_FOTO']; ?>" hidden>
    <input type="text" id="txtprincipalcompleto" value="<?php echo $_SESSION['S_COMPLETO']; ?>" hidden>
    <input type="text" id="txtprincipaldni" value="<?php echo $_SESSION['S_DNI']; ?>" hidden>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link">
        <img src="../img/logo.jpeg" alt="AdminLTE Logo" width="100%" height="80">
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-1 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../<?php echo isset($_SESSION['S_FOTO']) && !empty($_SESSION['S_FOTO']) ? $_SESSION['S_FOTO'] : '../img/blanco1.jpg'; ?>" class="img-circle elevation-2" style="max-width: 100%;height: auto;">

          </div>
          <div class="info">
            <a style="text-align:center;" href="#" class="d-block"><i class="fa fa-circle text-success fa-0x"></i> ¡Hola!<br> <b style="color:white"><?php echo $_SESSION['S_NOMBRE']; ?></b></a>
            <a style="text-align:center;margin:5px;color:white;font-size:15px" href="#" class="d-block">&nbsp;&nbsp;<b style="text-align:center"><i class="fa fa-user text-success fa-0x"></i><em> ROL: <?php echo $_SESSION['S_ROL']; ?></em></b></a>

          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-1">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="header text-center" style="color:#FFFFFF;background-color:Gray;"><b>GESTIÓN ACADÉMICA</b></li>

            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <?php if ($_SESSION['S_ROL'] == "ADMINISTRADOR") { ?>
              <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Menú principal
                  </p>
                </a>
              </li>
              <br>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-calendar-check"></i>
                  <p>
                    Gestión escolar
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','periodo/view_periodo.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Periodos por año
                      </p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','año/view_año_escolar.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Años escolares
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-list-ol"></i>
                  <p>
                    Sección y grado
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','aulas/view_aulas.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Grado
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','seccion/view_seccion.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Sección
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','nivel_academico/view_nivel_academico.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Nivel académico
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Gestión de usuarios
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','alumnos/view_alumnos.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Estudiantes
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','docentes/view_docentes.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Docentes
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','personal_admin/view_personal_admin.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Personal administrativo
                      </p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-user-graduate"></i>
                  <p>
                    Academico
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','matricula/view_matricula.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Matricula
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','pago_pensiones/view_pago_pensiones.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Pago de pensiones
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','pensiones/view_pensiones.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Pensiones
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>
                    Asignaturas y examen
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','examen/view_examen.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Examen
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','docente_asignatura/view_docenteasignatura.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Docente - Asignatura
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','asignaturas/view_asignatura.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Asignaturas
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clock "></i>
                  <p>
                    Horario y asistencia
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','asistencia/view_asistencia.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Asistencia
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','asistencia/view_asistencia_reportes.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Reporte de asistencias
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','horario/view_horario.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Horario
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','aula_hora/view_aula_hora.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Aula - Hora
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>
                    Notas y tareas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','notas/view_notas.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Notas
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','tareas/view_tareas.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Tareas
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Comunicados y boletas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','comunicado/view_comunicado.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Comunicados
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','boletas/view_boletas.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Boletas
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','componentes/view_componentes.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Criterios
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-folder-plus"></i>
                  <p>
                    Atenciones de salud
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','atenciones/view_atencion_psicologia.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Psicología
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','atenciones/view_atencion_enfermeria.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Enfermería
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-coins"></i>
                  <p>
                    Ingresos y egresos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','ingresos_y_egresos/view_ingresos.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Ingresos
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','ingresos_y_egresos/view_egresos.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                      Egresos o gastos
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','ingresos_y_egresos/view_indicadores.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Indicadores
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            
              <li class="header text-center" style="color:#FFFFFF;background-color:Gray;"><b>CONFIGURACIÓN</b></li>
              <li class="nav-item">
                <a href="#" onclick="cargar_contenido('contenido_principal','usuario/view_usuario.php')" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Usuarios
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-sitemap"></i>
                  <p>
                    Roles y especialidades
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','especialidades/view_especialidades.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Especialidades
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','roles/view_roles.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Roles
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" onclick="cargar_contenido('contenido_principal','usuario/view_usuario.php')" class="nav-link">
                  <i class="nav-icon fas fa-film"></i>
                  <p>
                    Video tutorial
                  </p>
                </a>
              </li>
            <?php
            }
            ?>
            <?php if ($_SESSION['S_ROL'] == "ENFERMERA") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-folder-plus"></i>
                  <p>
                    Atenciones de salud
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','atenciones/view_atencion_enfermeria.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Enfermeria
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php
            }
            ?>

            <?php if ($_SESSION['S_ROL'] == "PSICOLOGA") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-folder-plus"></i>
                  <p>
                    Atenciones de salud
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','atenciones/view_atencion_psicologia.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Psicología
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php
            }
            ?>

            <?php if ($_SESSION['S_ROL'] == "AUXILIAR") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clock "></i>
                  <p>
                    Horario y asistencia
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','asistencia/view_asistencia.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Asistencia
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','asistencia/view_asistencia_reportes.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Reporte de asistencias
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','horario/view_horario.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Horario
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','aula_hora/view_aula_hora.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Aula - Hora
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>
                    Revisar tareas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','tareas/view_tareas.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Tareas
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php
            }
            ?>
            <?php if ($_SESSION['S_ROL'] == "DOCENTE") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>
                    Notas y tareas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','notas/view_notas_profesor.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Notas
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','tareas/view_tareas_profesor.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Tareas
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>
                    Exámenes
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','examen/view_examen_profesor.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Programar examen
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php
            }
            ?>
            <?php if ($_SESSION['S_ROL'] == "ESTUDIANTE") { ?>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clipboard"></i>
                  <p>
                    Notas y tareas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','notas/view_notas_estudiante.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Notas
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','tareas/view_tareas_estudiante.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Tareas
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-clock "></i>
                  <p>
                    Horario y asistencia
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','asistencia/view_asistencia_reporte_estudiante.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>Reporte de asistencia
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','horario/view_horario_edtudiante.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Horario
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-dollar-sign"></i>
                  <p>
                    Pagos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">

                  <li class="nav-item">
                    <a onclick="cargar_contenido('contenido_principal','pago_pensiones/view_pago_pensiones_estudiante.php')" class="nav-link">
                      <i class="nav-icon far fa-circle"></i>
                      <p>
                        Ver pago de pensiones
                      </p>
                    </a>
                  </li>

                </ul>
              </li>
            <?php
            }
            ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <input type="text" id="txtprincipalid" value="<?php echo $_SESSION['S_ID']; ?>" hidden>
    <input type="text" id="txtprincipalusu" value="<?php echo $_SESSION['S_USU']; ?>" hidden>
    <input type="text" id="txtprincipalrol" value="<?php echo $_SESSION['S_ROL']; ?>" hidden>


    <div class="content-wrapper" id="contenido_principal">


      <!-- Content Wrapper. Contains page content -->

      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><i class="fas fa-home"></i>
                <b>BIENVENIDOS AL SISTEMA</b>
              </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">MENÚ</a></li>
                <li class="breadcrumb-item active">MENÚ PRINCIPAL</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <?php if ($_SESSION['S_ROL'] == "ADMINISTRADOR") { ?>

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- /.col-md-6 -->
              <div class="col-lg-12">
                <div class="card-primary">
                  <div class="card-header">
                    <h5 class="m-0" style="font-family:cooper;text-align:center"><i class="fas fa-list-ol"></i> DATOS IMPORTANTES</b></h5>
                  </div>
                  <div class="card-body" style="background-color:white">
                    <div class="row">
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner" style="text-align: center;">
                        <b>Total de Estudiantes</b>
                            <h3 id="total_estudiantes" style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100%; font-size: 45px;">
                                <sup style="font-size: 45px"></sup>
                            </h3>

                          </div>
                          <div class="icon">
                            <i class="fas fa-users"></i>
                          </div>
                          <a href="#" onclick="cargar_contenido('contenido_principal','alumnos/view_alumnos.php')" class="small-box-footer"><b>Ver estudiantes</b>&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                        <div class="inner" style="text-align: center;">
                        <b>Total de Docentes</b>
                          <h3 id="total_docentes" style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100%; font-size: 45px;">
                                <sup style="font-size: 45px"></sup>
                            </h3>

                          </div>
                          <div class="icon">
                          <i class="fas fa-users"></i>
                          </div>
                          <a href="#" onclick="cargar_contenido('contenido_principal','docentes/view_docentes.php')" class="small-box-footer"><b>Ver docentes</b>&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                        <div class="inner" style="text-align: center;">

                            <b>Total de Administrativos</b>
                            <h3 id="total_administrativos" style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100%; font-size: 45px;">
                                <sup style="font-size: 45px"></sup>
                            </h3>
                          </div>
                          <div class="icon">
                          <i class="fas fa-users"></i>
                          </div>
                          <a href="#" onclick="cargar_contenido('contenido_principal','personal_admin/view_personal_admin.php')" class="small-box-footer"><b>Ver administrativos</b>&nbsp; <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                        <div class="inner" style="text-align: center;">
                        <b>Total de Usuarios</b>
                            <h3 id="total_usuarios" style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100%; font-size: 45px;">
                                <sup style="font-size: 45px"></sup>
                            </h3>
                          </div>
                          <div class="icon">
                          <i class="fas fa-users"></i>
                          </div>
                          <a href="#" onclick="cargar_contenido('contenido_principal','usuario/view_usuario.php')" class="small-box-footer"><b>Ver usuarios</b>&nbsp; <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                        <div class="inner" style="text-align: center;">
                        <b>Total de Ingresos Hoy día</b>
                            <h3 id="total_ingresos" style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100%; font-size: 45px;">
                                <sup style="font-size: 45px"></sup>
                            </h3>
                          </div>
                          <div class="icon">
                          <i class="fas fa-dollar-sign"></i>
                          </div>
                          <a href="#" onclick="cargar_contenido('contenido_principal','ingresos_y_egresos/view_ingresos.php')" class="small-box-footer"><b>Ver ingresos</b>&nbsp; <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                        <div class="inner" style="text-align: center;">
                        <b>Total de Gastos Hoy día</b>
                            <h3 id="total_gastos" style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100%; font-size: 45px;">
                                <sup style="font-size: 45px"></sup>
                            </h3>
                          </div>
                          <div class="icon">
                          <i class="fas fa-dollar-sign"></i>
                          </div>
                          <a href="#" onclick="cargar_contenido('contenido_principal','ingresos_y_egresos/view_egresos.php')" class="small-box-footer"><b>Ver egresos</b>&nbsp; <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-primary">
                        <div class="inner" style="text-align: center;">
                        <b>Total de Atenciones Psicológicas</b>
                            <h3 id="total_psicologia" style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100%; font-size: 45px;">
                                <sup style="font-size: 45px"></sup>
                            </h3>
                          </div>
                          <div class="icon">
                          <i class="fas fa-notes-medical"></i>
                          </div>
                          <a href="#" onclick="cargar_contenido('contenido_principal','atenciones/view_atencion_psicologia.php')" class="small-box-footer"><b>Ver atenciones psicología</b>&nbsp; <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-dark">
                          <div class="inner" style="text-align: center;">
                            <b>Total de Atenciones Enfermería</b>
                            <h3 id="total_enfermeria" style="text-align: center; display: flex; justify-content: center; align-items: center; height: 100%; font-size: 45px;">
                                <sup style="font-size: 45px"></sup>
                            </h3>
                          </div>
                          <div class="icon">
                          <i class="fas fa-notes-medical"></i>
                          </div>
                          <a href="#" onclick="cargar_contenido('contenido_principal','atenciones/view_atencion_enfermeria.php')" class="small-box-footer"><b>Ver atenciones enfermería</b>&nbsp; <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>

        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- /.col-md-6 -->
              <div class="col-lg-12">
                <div class="card-primary">
                  <div class="card-header">
                    <h5 class="m-0" style="font-family:cooper;text-align:center"><i class="fas fa-bullhorn"></i><b> COMUNICADOS</b></h5>
                  </div>
                  <div class="table-responsive" style="text-align:center">
                  <div class="card-body" style="overflow: hidden; border-radius: 20px;">
                      <table id="tabla_comunicados_listar"class="table table-striped table-bordered" style="width:100%; border-radius: 20px; overflow: hidden;">
                        <thead style="background-color:#023D77;color:white;">
                          <tr>
                            <th style="text-align:center">Nro.</th>
                            <th style="text-align:center">Tipo</th>
                            <th style="text-align:center">Grado</th>
                            <th style="text-align:center">Título</th>
                            <th style="text-align:center">Descripción</th>
                            <th style="text-align:center">Vista</th>
                            <th style="text-align:center">Estado</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
        </div>
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- /.col-md-6 -->
              <div class="col-lg-12">
                <div class="card-primary">
                  <div class="card-header">
                    <h5 class="m-0" style="font-family:cooper;text-align:center"><i class="fas fa-school"></i><b> DATOS DE LA INSTITUCIÓN EDUCATIVA</b< /h5>
                  </div>
                  <div class="table-responsive" style="text-align:center">
                  <div class="card-body" style="overflow: hidden; border-radius: 20px;">
                      <table id="tabla_empresa" class="table table-striped table-bordered" style="width:100%; border-radius: 20px; overflow: hidden;">
                          <thead style="background-color:#023D77;color:white;">
                              <tr>
                                  <th style="text-align:center">Nro.</th>
                                  <th style="text-align:center">Logo</th>
                                  <th style="text-align:center">Nombre</th>
                                  <th style="text-align:center">Email</th>
                                  <th style="text-align:center">Código Modular</th>
                                  <th style="text-align:center">Teléfono</th>
                                  <th style="text-align:center">Dirección</th>
                                  <th style="text-align:center">Acciones</th>
                              </tr>
                          </thead>
                      </table>
                  </div>
              </div>

                </div>
                <!-- /.col-md-6 -->
              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
        </div>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#fff; text-align:center; display: flex; justify-content: center; align-items: center;">
            <h5 id="lb_titulo_datos2" style="color:black; margin-bottom: 0; width: 100%; text-align:center;"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12 form-group">
                <label for="">Descripción<b style="color:red">(*)</b>:</label>
                <textarea class="form-control" id="txt_descripcion_ver" rows="3" style="resize:none" readonly></textarea>
              </div>
              <div class="col-12" align="center" style="border: 2px solid black; padding: 10px; display: inline-block; max-width: 100%; box-sizing: border-box;">
                <img id="preview4" src="#" alt="Vista previa" style="max-width: 100%; height: auto; display: block;">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>

          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#1FA0E0;">
            <h5 class="modal-title" id="exampleModalLabel" style="color:white; text-align:center"><b>EDITAR DATOS DE LA INSTITUCIÒN</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12 form-group" style="color:red">
                <h6><b>Campos Obligatorios (*)</b></h6>
              </div><br>
              <div class="col-6 form-group">
                <input type="text" id="txt_id_empresa" hidden>
                <label for="">Nombre(*):</label>
                <input type="text" class="form-control" id="txt_nombre" maxlenght="8">
              </div>
              <div class="col-6 form-group">
                <label for="">Email(*):</label>
                <input type="text" class="form-control" id="txt_email">
              </div>
              <div class="col-6 form-group">
                <label for="">Código(*):</label>
                <input type="text" class="form-control" id="txt_codigo">
              </div>
              <div class="col-6 form-group">
                <label for="">Teléfono / Celular(*):</label>
                <input type="text" class="form-control" id="txt_telefono" maxlenght="9" onkeypress="return soloNumeros(event)">
              </div>
              <div class="col-12 form-group">
                <label for="">Dirección(*):</label>
                <input type="text" class="form-control" id="txt_direccion">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>
            <button type="button" class="btn btn-success" onclick="Modificar_Empleado()"><i class="fas fa-check"></i> Modificar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal_editar_foto" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#1FA0E0;">
            <h5 class="modal-title" id="exampleModalLabel" style="color:white; text-align:center"><b>EDITAR FOTO DE LA INSTITUCIÓN: </b><label for="" id="lb_empresa"></label></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <input type="text" id="fotoactual" hidden>
                <input type="text" id="txt_idempresa_foto" hidden>
                <label for="checkboxSuccess2" style="align:justify;color:red">
                  OJO: Una vez cambiado el logo, tambien se cambiara el logo en los reportes y ticket.
                </label>
                <label for="">Subir Foto:</label>
                <input class="form-control" type="file" id="txt_foto">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>
            <button type="button" class="btn btn-success" onclick="Modificar_Foto_Empresa()"><i class="fas fa-check"></i> Modificar</button>
          </div>
        </div>
      </div>
    </div>

    
    <!-- /.content-wrapper -->
  <?php
      }
  ?>
  <?php if ($_SESSION['S_ROL'] == "ENFERMERA" || $_SESSION['S_ROL'] == "PSICOLOGA" || $_SESSION['S_ROL'] == "AUXILIAR") { ?>

    <!-- Main content -->

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card-primary"><br>
              <div class="card-header">
                <h5 class="m-0" style="font-family:cooper;text-align:center">
                  <i class="fas fa-bullhorn"></i><b> COMUNICADOS</b>
                </h5>
              </div>
              <div class="table-responsive" style="text-align:center">
                <div class="card-body">
                  <table id="tabla_comunicados_listar" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color:#0A5D86;color:#FFFFFF;">
                      <tr>
                        <th style="text-align:center">Nro.</th>
                        <th style="text-align:center">Tipo</th>
                        <th style="text-align:center">Grado</th>
                        <th style="text-align:center">Título</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Vista</th>
                        <th style="text-align:center">Estado</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <!-- Imagen centrada -->
            <img src="../img/logo.jpeg" style="display:block; margin: 20px auto;" width="auto"><br>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    </div>


    <!-- /.content -->
  </div>
  <div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#fff; text-align:center; display: flex; justify-content: center; align-items: center;">
          <h5 class="" id="lb_titulo_datos2" style="color:black; margin-bottom: 0; width: 100%; text-align:center;">
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 form-group">
              <label for="">Descripción<b style="color:red">(*)</b>:</label>
              <textarea class="form-control" id="txt_descripcion_ver" rows="3" style="resize:none" readonly></textarea>
            </div>
            <div class="col-12" align="center" style="border: 2px solid black; padding: 10px; display: inline-block; max-width: 100%; box-sizing: border-box;">
              <img id="preview4" src="#" alt="Vista previa" style="max-width: 100%; height: auto; display: block;">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
<?php
  }
?>
<?php if ($_SESSION['S_ROL'] == "DOCENTE") { ?>

  <!-- Main content -->

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->

        <div class="col-md-12">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title" style="font-size:25px"><i class="fa fa-user"></i><b> DATOS DEL DOCENTE</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div style="background-image: url('../img//fondo.jpeg'); background-size: cover; background-position: center; padding: 20px; border-radius: 5px; display: flex; flex-wrap: wrap; align-items: flex-start; position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(137, 0, 0, 0.3);">
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(137, 0, 0, 0.6); z-index: 0;"></div>
                <div style="width: 320px; height: auto; border-radius: 7px; box-shadow: 0 0 15px rgba(0,0,0,0.4); position: relative; padding: 10px; ">
                  <div style="border: 10px solid gold; box-shadow: inset 0 0 10px rgba(0,0,0,0.5); padding: 5px;">
                    <img src="../<?php echo isset($_SESSION['S_FOTO']) && !empty($_SESSION['S_FOTO']) ? $_SESSION['S_FOTO'] : '../img/blanco1.jpg'; ?>" alt="Foto del estudiante" style="width: 100%; height: auto; object-fit: cover;">
                  </div>
                  <div style="text-align: center; margin-top: 10px;">
                    <button style="width: 100%; padding: 10px 20px; font-size: 16px; color: #fff; background-color: #007bff; border: none; border-radius: 5px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-sizing: border-box;" onclick="editar_foto_docente()">
                      <i class="fas fa-upload"></i>
                      Cambiar foto
                    </button>
                  </div>

                </div>
                <div style="flex: 1; min-width: 300px; position: relative; z-index: 1;padding: 15px;">
                  <h2 style="margin: 0 0 10px 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); font-size: 36px; color: white;"><b><?php echo $_SESSION['S_COMPLETO']; ?></b></h2>
                  <p style="margin: 0 0 15px 0; font-size:25px; text-shadow: 1px 1px 2px rgba(0,0,0,0.3); color: white;"><u><b>Docente</b></u></p>
                  <hr style="color:#fff">
                  <ul style="list-style-type: none; padding: 0; margin: 0; color: white;">
                    <li style="margin-bottom: 12px; font-size: 25px;"><i class="fas fa-id-card" style="margin-right: 10px; color: #ffd700;"></i> DNI: <?php echo $_SESSION['S_DNI']; ?></li>
                    <li style="margin-bottom: 12px; font-size: 25px;"><i class="fas fa-calendar" style="margin-right: 10px; color: #ffd700;"></i> Fecha de nacimiento: <?php echo $_SESSION['S_FECHANACIMIENTO']; ?></li>
                    <li style="margin-bottom: 12px; font-size: 25px;"><i class="fas fa-phone" style="margin-right: 10px; color: #ffd700;"></i> Teléfono Celular: <?php echo $_SESSION['S_MOVIL']; ?></li>
                    <li style="margin-bottom: 12px; font-size: 25px;"><i class="fas fa-envelope" style="margin-right: 10px; color: #ffd700;"></i> Correo: <?php echo $_SESSION['S_EMAIL']; ?></li>
                    <li style="margin-bottom: 12px; font-size: 25px;"><i class="fas fa-home" style="margin-right: 10px; color: #ffd700;"></i> Dirección: <?php echo $_SESSION['S_DIRECCION']; ?></li>
                  </ul>
                  <hr>
                </div>
                <div style="flex: 0 0 280px; text-align: right; position: relative; z-index: 1;">
                  <img src="../img/icono.jpeg" alt="Logo Instituto Prueba" style="width: 100%; box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px;">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" style="font-size:25px"><i class="fa fa-book"></i><b> TAREAS PENDIENTES</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div class="table-responsive" style="text-align:center">
                <div class="card-body">
                  <table id="tabla_tarea_menu" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color:#0A5D86;color:#FFFFFF;">
                    
                      <tr>
                        <th style="text-align:center">Nro.</th>
                        <th style="text-align:center">Grado</th>
                        <th style="text-align:center">Curso - Docente</th>
                        <th style="text-align:center">Tema o Tarea</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Fecha de publicación</th>
                        <th style="text-align:center">Fecha de entrega</th>
                        <th style="text-align:center">Archivo de Tarea</th>
                        <th style="text-align:center">Estado</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title" style="font-size:25px"><i class="fa fa-book"></i><b> EXÁMENES PENDIENTES</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div class="table-responsive" style="text-align:center">
                <div class="card-body">
                  <table id="tabla_examenes_menu" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color:#0A5D86;color:#FFFFFF;">
                    
                      <tr>
                      <th style="text-align:center">Nro.</th>
                      <th style="text-align:center">Nivel Academico</th>
                      <th style="text-align:center">Grado</th>
                      <th style="text-align:center">Curso - Docente</th>
                      <th style="text-align:center">Tema de Examen</th>
                      <th style="text-align:center">Descripción / Observación</th>
                      <th style="text-align:center">Fecha de publicación</th>
                      <th style="text-align:center">Fecha de examen</th>
                      <th style="text-align:center">Estado</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>

            </div>
          </div>
        </div>





        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>

  <div class="content" hidden>
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card-primary"><br>
              <div class="card-header">
                <h5 class="m-0" style="font-family:cooper;text-align:center">
                  <i class="fas fa-bullhorn"></i><b> COMUNICADOS</b>
                </h5>
              </div>
              <div class="table-responsive" style="text-align:center">
                <div class="card-body">
                  <table id="tabla_comunicados_listar" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color:#0A5D86;color:#FFFFFF;">
                      <tr>
                        <th style="text-align:center">Nro.</th>
                        <th style="text-align:center">Tipo</th>
                        <th style="text-align:center">Grado</th>
                        <th style="text-align:center">Título</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Vista</th>
                        <th style="text-align:center">Estado</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <!-- Imagen centrada -->
            <img src="../img/logo.jpeg" style="display:block; margin: 20px auto;" width="auto"><br>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    </div>


    <!-- /.content -->
  <div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#fff; text-align:center; display: flex; justify-content: center; align-items: center;">
          <h5 class="" id="lb_titulo_datos2" style="color:black; margin-bottom: 0; width: 100%; text-align:center;">
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 form-group">
              <label for="">Descripción<b style="color:red">(*)</b>:</label>
              <textarea class="form-control" id="txt_descripcion_ver" rows="3" style="resize:none" readonly></textarea>
            </div>
            <div class="col-12" align="center" style="border: 2px solid black; padding: 10px; display: inline-block; max-width: 100%; box-sizing: border-box;">
              <img id="preview4" src="#" alt="Vista previa" style="max-width: 100%; height: auto; display: block;">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
  </div>

  <div class="modal fade" id="modal_editar_foto_docente" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#1FA0E0;">
            <h5 class="modal-title" id="exampleModalLabel" style="color:white; text-align:center"><b>EDITAR FOTO DEL DOCENTE: </b><label for="" id="lb_docente"></label></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <input type="text" id="fotoactualdocente" hidden>
                <input type="text" id="txt_iddocente_foto" hidden>
                <label for="checkboxSuccess2" style="align:justify;color:red">
                  OJO: Usted puede cambiar su foto de perfil las veces que desee.
                </label>
                <label for="">Subir Foto:</label>
                <input class="form-control" type="file" id="txt_foto_docente">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>
            <button type="button" class="btn btn-success" onclick="Modificar_Foto_Docente()"><i class="fas fa-check"></i> Modificar</button>
          </div>
        </div>
      </div>
    </div>
  <!-- /.content-wrapper -->
<?php
}

?>

<?php if ($_SESSION['S_ROL'] == "ESTUDIANTE") { ?>

  <!-- Main content -->

  

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col-md-6 -->


        <div class="col-md-12">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title" style="font-size:25px"><i class="fa fa-user"></i><b> DATOS DEL ESTUDIANTE</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div style="background-image: url('../img/fondo.jpeg'); background-size: cover; background-position: center; padding: 20px; border-radius: 5px; display: flex; flex-wrap: wrap; align-items: flex-start; position: relative; overflow: hidden; box-shadow: 0 4px 15px rgba(137, 0, 0, 0.3);">
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(137, 0, 0, 0.6); z-index: 0;"></div>

                <!-- Contenedor de la imagen y el botón -->
                <div style="width: 320px; height: auto; border-radius: 7px; box-shadow: 0 0 15px rgba(0,0,0,0.4); position: relative; padding: 10px; ">
                  <div style="border: 10px solid gold; box-shadow: inset 0 0 10px rgba(0,0,0,0.5); padding: 5px;">
                  <img src="<?php echo $rutaFoto; ?>" alt="Foto del estudiante" style="width: 100%; height: auto; object-fit: cover;">
                  </div>
                  <div style="text-align: center; margin-top: 10px;">
                    <button style="width: 100%; padding: 10px 20px; font-size: 16px; color: #fff; background-color: #007bff; border: none; border-radius: 5px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; box-sizing: border-box;" onclick="editar_foto_Estudiante()">
                      <i class="fas fa-upload"></i>
                      Cambiar foto
                    </button>
                  </div>

                </div>
                
                <!-- Contenido principal -->
                <div style="flex: 1; min-width: 300px; position: relative; z-index: 1; padding: 15px;">
                  <h2 style="margin: 0 0 10px 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); font-size: 36px; color: white;"><b><?php echo $_SESSION['S_COMPLETO']; ?></b></h2>
                  <p style="margin: 0 0 15px 0; font-size:25px; text-shadow: 1px 1px 2px rgba(0,0,0,0.3); color: white;"><u><b>Estudiante</b></u></p>
                  <hr style="color:#fff">
                  <ul style="list-style-type: none; padding: 0; margin: 0; color: white;">
    <li style="margin-bottom: 12px; font-size: 25px;">
        <i class="fas fa-id-card" style="margin-right: 10px; color: #ffd700;"></i>
        <strong>DNI:</strong> <?php echo $_SESSION['S_DNI']; ?>
    </li>
    <li style="margin-bottom: 12px; font-size: 25px;">
        <i class="fas fa-calendar" style="margin-right: 10px; color: #ffd700;"></i>
        <strong>Fecha de nacimiento:</strong> <?php echo $_SESSION['S_FECHANACIMIENTO']; ?>
    </li>
    <li style="margin-bottom: 12px; font-size: 25px;">
        <i class="fas fa-phone" style="margin-right: 10px; color: #ffd700;"></i>
        <strong>Teléfono Celular:</strong> <?php echo $_SESSION['S_MOVIL']; ?>
    </li>
    <li style="margin-bottom: 12px; font-size: 25px;">
        <i class="fas fa-envelope" style="margin-right: 10px; color: #ffd700;"></i>
        <strong>Correo:</strong> <?php echo $_SESSION['S_EMAIL']; ?>
    </li>
    <li style="margin-bottom: 12px; font-size: 25px;">
        <i class="fas fa-home" style="margin-right: 10px; color: #ffd700;"></i>
        <strong>Dirección:</strong> <?php echo $_SESSION['S_DIRECCION']; ?>
    </li>
</ul>

                  <hr>
                </div>

                <!-- Logo -->
                <div style="flex: 0 0 280px; text-align: right; position: relative; z-index: 1;">
                  <img src="../img/icono.jpeg" alt="Logo Instituto Prueba" style="width: 100%; box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px;">
                </div>
              </div>

            </div>

          </div>
        </div>

        <div class="col-md-12">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title" style="font-size:25px"><i class="fa fa-id-card"></i><b> DATOS DE MATRICULA</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div class="table-responsive" style="overflow-x: hidden;"> <!-- Evita desbordamiento horizontal -->
                <div class="row">
                  <div class="col-md-3 form-group">
                    <label for="">Año académico (matriculado):</label>
                    <input type="text" class="form-control" id="txt_añoaca" style="font-weight: bold;" disabled>
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Nivel académico:</label>
                    <input type="text" class="form-control" id="txt_nivelaca" style="font-weight: bold;" disabled>
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Grado:</label>
                    <input type="text" class="form-control" id="txt_grado" style="font-weight: bold;" disabled>
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Sección:</label>
                    <input type="text" class="form-control" id="txt_seccion" style="font-weight: bold;" disabled>
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Tipo de alumno:</label>
                    <input type="text" class="form-control" id="txttipo_alum" style="font-weight: bold;" disabled>
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Procedencia:</label>
                    <input type="text" class="form-control" id="txt_proceden" style="font-weight: bold;" disabled>
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Último Pago de Pensión:</label>
                    <input type="text" class="form-control" id="txt_ultimo_pago" style="color: green; font-weight: bold;" disabled>
                  </div>
                  <div class="col-md-3 form-group">
                    <label for="">Mes siguiente de pago:</label>
                    <input type="text" class="form-control" id="txt_mes_siguiente" style="color: red; font-weight: bold;" disabled>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title" style="font-size:25px"><i class="fa fa-book"></i><b> TAREAS PENDIENTES</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div class="table-responsive" style="text-align:center">
                <div class="card-body">
                  <table id="tabla_tarea_menu_estudiante" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color:#0A5D86;color:#FFFFFF;">
                      <tr>
                        <th style="text-align:center">Curso - Docente</th>
                        <th style="text-align:center">Tema o Tarea</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Fecha de entrega</th>
                        <th style="text-align:center">Estado</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" style="font-size:25px"><i class="fa fa-book"></i><b> EXÁMENES PENDIENTES</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">
              <div class="table-responsive" style="text-align:center">
                <div class="card-body">
                  <table id="tabla_examenes_menu_estudiante" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color:#0A5D86;color:#FFFFFF;">
                      <tr>
                        <th style="text-align:center">Curso - Docente</th>
                        <th style="text-align:center">Tema</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Fecha</th>
                        <th style="text-align:center">Estado</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>

  <div class="content" hidden>
      <div class="container-fluid">
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <div class="card-primary"><br>
              <div class="card-header">
                <h5 class="m-0" style="font-family:cooper;text-align:center">
                  <i class="fas fa-bullhorn"></i><b> COMUNICADOS</b>
                </h5>
              </div>
              <div class="table-responsive" style="text-align:center">
                <div class="card-body">
                  <table id="tabla_comunicados_listar" class="table table-striped table-bordered" style="width:100%">
                    <thead style="background-color:#0A5D86;color:#FFFFFF;">
                      <tr>
                        <th style="text-align:center">Nro.</th>
                        <th style="text-align:center">Tipo</th>
                        <th style="text-align:center">Grado</th>
                        <th style="text-align:center">Título</th>
                        <th style="text-align:center">Descripción</th>
                        <th style="text-align:center">Vista</th>
                        <th style="text-align:center">Estado</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <!-- Imagen centrada -->
            <img src="../img/logo.jpeg" style="display:block; margin: 20px auto;" width="auto"><br>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
    </div>


    <!-- /.content -->
  <div class="modal fade" id="modal_ver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#fff; text-align:center; display: flex; justify-content: center; align-items: center;">
          <h5 class="" id="lb_titulo_datos2" style="color:black; margin-bottom: 0; width: 100%; text-align:center;">
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 10px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 form-group">
              <label for="">Descripción<b style="color:red">(*)</b>:</label>
              <textarea class="form-control" id="txt_descripcion_ver" rows="3" style="resize:none" readonly></textarea>
            </div>
            <div class="col-12" align="center" style="border: 2px solid black; padding: 10px; display: inline-block; max-width: 100%; box-sizing: border-box;">
              <img id="preview4" src="#" alt="Vista previa" style="max-width: 100%; height: auto; display: block;">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content -->
  </div>

  <div class="modal fade" id="modal_editar_foto_estudiante" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#1FA0E0;">
            <h5 class="modal-title" id="exampleModalLabel" style="color:white; text-align:center"><b>EDITAR FOTO DEL ESTUDIANTE: </b><label for="" id="lb_estudiante"></label></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <input type="text" id="fotoactualestudiante" hidden>
                <input type="text" id="txt_idestudiante_foto" hidden>
                <label for="checkboxSuccess2" style="align:justify;color:red">
                  OJO: Usted puede cambiar su foto de perfil las veces que desee.
                </label>
                <label for="">Subir Foto:</label>
                <input class="form-control" type="file" id="txt_foto_estudiante">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>
            <button type="button" class="btn btn-success" onclick="Modificar_Foto_Estudiante()"><i class="fas fa-check"></i> Modificar</button>
          </div>
        </div>
      </div>
    </div>
  <!-- /.content-wrapper -->
<?php
}

?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    <em>Versión 1.0.0</em>
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2024 - <a href="https://sedessapientiaeabancay.edu.pe/" target="_blank"><em>COLEGIO DI0CESANO SEDES SAPIENTIAE (Click)</em></a></strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->



<script>
  function cargar_contenido(id, vista) {
    $("#" + id).load(vista);
  }
  var idioma_espanol = {
    select: {
      rows: "%d fila seleccionada"
    },
    "sProcessing": "Procesando...",
    "sLengthMenu": "Mostrar _MENU_ registros",
    "sZeroRecords": "No se encontraron resultados",
    "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
    "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
    "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix": "",
    "sSearch": "Buscar:",
    "sUrl": "",
    "sInfoThousands": ",",
    "sLoadingRecords": "<b>No se encontraron datos</b>",
    "oPaginate": {
      "sFirst": "Primero",
      "sLast": "Último",
      "sNext": "Siguiente",
      "sPrevious": "Atras"
    },
    "oAria": {
      "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  }

  function sololetras(e) {
    key = e.keyCode || e.which;

    teclado = String.fromCharCode(key).toLowerCase();

    letras = "qwertyuiopasdfghjklñzxcvbnmáéíóúÁÉÍÓÚ ";

    especiales = "8-37-38-46-164";

    teclado_especial = false;

    for (var i in especiales) {
      if (key == especiales[i]) {
        teclado_especial = true;
        break;
      }
    }

    if (letras.indexOf(teclado) == -1 && !teclado_especial) {
      return false;
    }
  }


  function soloNumeros(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 8) {
      return true;
    }
    // Patron de entrada, en este caso solo acepta numeros
    patron = /[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
  }



  ///////VALIDAR EMAIL
  function validar_email(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
  }
  
</script>
<!-- jQuery -->
<script src="../plantilla/plugins//jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plantilla/plugins//bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../plantilla/dist/js/adminlte.min.js"></script>



<script src="../js/console_comunicados.js?rev=<?php echo time(); ?>"></script>
<script src="../js/console_matriculas.js?rev=<?php echo time(); ?>"></script>
<script src="../js/console_usuario.js?rev=<?php echo time(); ?>"></script>
<script src="../js/console_tareas_profesor.js?rev=<?php echo time(); ?>"></script>
<script src="../js/console_tareas_estudiantes.js?rev=<?php echo time(); ?>"></script>
<script src="../js/console_empresa.js?rev=<?php echo time(); ?>"></script>
<script src="../js/console_examen_profesor.js?rev=<?php echo time(); ?>"></script>
<script src="../utilitario/DataTables/datatables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="../js/console_usuario.js?rev=<?php echo time(); ?>"></script>


</body>
</html>
<!-- Incluye tu JavaScript personalizado -->
<script>
  $(document).ready(function() {
    Traer_Datos();
    listar_empresa();
    listar_comunicado_dash();
    listar_tareas_menu();
    listar_tareas_menu_estudiante();
    listar_examenes_menu();
    listar_examenes_menu_estudiante();
    Total_estudiantes();
    Total_docentes();
    Total_administrativos();
    Total_usuarios();
    Total_ingresos();
    Total_egresos();
    Total_atención_psicologica();
    Total_atención_enefermeria();
    // Maneja los eventos para los botones "Siguiente" y "Anterior"
    $('#btn_modal_siguiente').click(function() {
      mostrarSiguienteModal();
    });

    $('#btn_modal_anterior').click(function() {
      mostrarAnteriorModal();
    });

    // Evento para cerrar el modal y quitar el actual de la lista de activos
    $('#modal_ver').on('hidden.bs.modal', function() {
      // Remover el modal actual de la lista de activos
      if (comunicadosActivos.length > 0) {
        comunicadosActivos.splice(currentModalIndex, 1);
        if (comunicadosActivos.length > 0) {
          currentModalIndex = currentModalIndex % comunicadosActivos.length;
          mostrarSiguienteModal();
        }
      }
    });
  });
</script>