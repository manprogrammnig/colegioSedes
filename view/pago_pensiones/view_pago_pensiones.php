<script src="../js/console_pago_pension.js?rev=<?php echo time(); ?>"></script>
<link rel="stylesheet" href="../plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><b>MANTENIMIENTO DE PAGO DE PENSIONES</b></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="../index.php">MENU</a></li>
          <li class="breadcrumb-item active">PAGO DE PENSIONES</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- /.col-md-6 -->
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fas fa-th"></i>&nbsp;&nbsp;<b>Listado de Pago de Pensiones</b></h3>
          </div>
          <div class="table-responsive" style="text-align:left">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 form-group">
                                    <label for="">Año académico<b style="color:red">(*)</b>:</label>
                                    <select class="form-control" id="select_año_buscar" style="width:100%">
                                    </select>
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Nivel Académico<b style="color:red">(*)</b>:</label>
                                    <select class="form-control" id="select_nivel_buscar" style="width:100%">
                                    </select>
                                </div>
                                <div class="col-2 form-group">
                                    <label for="">Grado o Aula<b style="color:red">(*)</b>:</label>
                                    <select class="form-control" id="select_aula_buscar" style="width:100%">
                                    </select>
                                </div>
                                <div class="col-12 col-md-3" role="document">
                                    <label for="">&nbsp;</label><br>
                                    <button onclick="listar_pago_pension_filtro()" class="btn btn-danger mr-2" style="width:100%" onclick><i class="fas fa-search mr-1"></i>Buscar pagos</button>
                                </div>
                                <div class="col-12 col-md-3" role="document">
                                    <label for="">&nbsp;</label><br>
                                    <button onclick="listar_pago_pension()" class="btn btn-success mr-2" style="width:100%" onclick><i class="fas fa-search mr-1"></i>Listar todo</button>
                                </div>
                            </div>
                        </div>
                    </div>
          <div class="table-responsive" style="text-align:center">
            <div class="card-body">
              <table id="tabla_pago_pension" class="table table-striped table-bordered" style="width:100%">
                <thead style="background-color:#0A5D86;color:#FFFFFF;">
                  <tr>
                    <th style="text-align:center">Nro.</th>
                    <th style="text-align:center">DNI</th>
                    <th style="text-align:center">Estudiante</th>
                    <th style="text-align:center">Aula o Grado</th>
                    <th style="text-align:center">Nivel Académico</th>
                    <th style="text-align:center">Año escolar</th>
                    <th style="text-align:center">Ultimo pago</th>
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
  <!-- /.content -->

  <!-- Modal -->
  <div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#1FA0E0;">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white; text-align:center"><b>PAGO DE PENSIONES</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning alert-dismissible" style="text-align:justify">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> ¡Aviso Importante!</h5>
            Si la fecha de vencimiento y el estado están en rojo con la etiqueta <b>VENCIDO</b>, considere agregar un recargo por mora, ya que el pago se ha realizado fuera de la fecha límite. En cambio, si la fecha y el estado están en verde con la etiqueta <b>PENDIENTE</b>, no es necesario aplicar mora, ya que el pago está al día o se está realizando antes de la fecha de vencimiento.
          </div>
          <div class="row">
            <div class="col-12 form-group" style="color:red">
              <h6><b>Campos Obligatorios (*)</b></h6>
            </div>
            <div class="col-6 form-group">
              <label for="">Concepto<b style="color:red">(*)</b>:</label>
              <input type="date" id="fecha_pago" hidden>
              <input type="text" class="form-control" id="txt_id_matricula" hidden>
              <select class="form-control" id="select_concepto" style="width:100%">
                <option value="PENSION">PENSION</option>
                <option value="MATRICULA">MATRICULA</option>
                <option value="ALUMNO NUEVO">ALUMNO NUEVO</option>
                <option value="ADMISION">ADMISION</option>
              </select>
            </div>
            <div class="col-6 form-group">
              <label for="">Nivel Académico<b style="color:red">(*)</b>:</label>
              <select class="form-control" id="select_nivel" style="width:100%">
              </select>
            </div>
            <div class="col-6 form-group">
              <label for="">Pensión<b style="color:red">(*)</b>:</label>
              <select class="form-control" id="select_pension" style="width:100%">
              </select>
            </div>
            <div class="col-6 form-group">
              <label for="">Monto a Pagar<b style="color:red">(*)</b>:</label>
              <input type="text" class="form-control" id="txt_monto_pagar">
            </div>
            <div class="col-6 form-group">
                <label for="">Fecha vencimiento<b style="color:red">(*)</b>:</label>
                <input type="date" class="form-control" id="txt_fecha_ven" disabled>
            </div>
            <div class="col-6 form-group">
                <label for="">Estado<b style="color:red">(*)</b>:</label>
                <input type="text" class="form-control" id="txt_estado" disabled>
            </div>
            <div class="col-12 form-group">
              <button type="button" class="btn btn-success btn-block" onclick="Agregar_pago()">
                <i class="fas fa-plus"></i> <b>Agregar Pago</b>
              </button>
            </div>
            <div class="col-12 table-responsive" style="text-align:center">
              <table id="tabla_pago" style="width:100%" class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>Id.</th>
                    <th>Concepto</th>
                    <th>Id pen</th>
                    <th>Pensión</th>
                    <th>Subtotal</th>
                    <th>Acci&oacute;n</th>
                  </tr>
                </thead>
                <tbody id="tbody_tabla_pago">
                </tbody>
              </table>
              <div class="col-9">
              </div>
              <div class="col-3">
                <h3 for="" id="lbl_totalneto"></h3>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>
          <button type="button" class="btn btn-success" onclick="Registrar_Pago()"><i class="fas fa-save"></i> Registrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_ver_pagos" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="lb_titulo"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12" style="text-align:center">
              <div class="table-responsive" style="text-align:center">
                <div class="card-body">
                  <table id="tabla_pagos2" class="display compact" style="width:100%; text-align:center;">
                    <thead style="background-color:#0A5D86;color:#FFFFFF;">
                      <tr style="text-align:center;">
                        <th style="text-align:center;">Nro.</th>
                        <th style="text-align:center;">Concepto</th>
                        <th style="text-align:center;">Mes</th>
                        <th style="text-align:center;">Fecha de Pago</th>
                        <th style="text-align:center;">Subtotal</th>
                        <th style="text-align:center;">Acción</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th colspan="4" style="text-align:right;">Total:</th>
                        <th style="text-align:center;" id="total_sub_total">S/. 0.00</th>
                        <th></th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-right-from-bracket"></i>Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_editar2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#1FA0E0;">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white; text-align:center"><b>DATOS DE MODIFICACIÓN</b></h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-12 form-group">
        <h5 class="modal-title" id="lb_titulo4" style="color:red"></h5>

          </div>
          <div class="col-12 form-group">
            <label for="">Monto pago<b style="color:red">(*)</b>:</label>
            <input class="form-control" type="text" id="txt_monto_edita" onkeypress="return soloNumeros(event)">
            <input type="text" id="txt_id_pagopension" hidden>
          </div>
          <div class="col-12 form-group">
            <label for="">Motivo de edición<b style="color:red">(*)</b>:</label>
            <textarea name="" id="txt_observación_motivo" rows="3" class="form-control" style="resize:none;"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times ml-1"></i> Cerrar</button>
        <button type="button" class="btn btn-success" onclick="Editar_pago()"><i class="fas fa-check"></i> Modificar</button>
      </div>
    </div>
  </div>
</div>

  <style>
    .hidden {
      display: none;
    }
  </style>

  <script>
    $(document).ready(function() {
      listar_pago_pension();
      $('.js-example-basic-single').select2();
      Cargar_Select_Nivelaca();
      Cargar_Select_pensiones();
      Cargar_Select_Nivelaca2();
      Cargar_Año();
    });


    $("#select_nivel").change(function() {
      var id = $("#select_nivel").val();
      Cargar_Select_pensiones(id);
    });

    $("#select_pension").change(function() {
      var id = $("#select_pension").val();
      Traerpension(id);
    });
    $("#select_nivel_buscar").change(function() {
      var id = $("#select_nivel_buscar").val();
      Cargar_Select_Aula(id);
    });
    $('#modal_registro').on('shown.bs.modal', function() {
      $('#txt_matricula').trigger('focus')
    })
    var n = new Date();
var y = n.getFullYear();
var m = n.getMonth() + 1;  // Los meses empiezan desde 0, por eso se suma 1
var d = n.getDate();

// Si el día o el mes es menor a 10, se le agrega un '0' al inicio
if (d < 10) {
    d = '0' + d;
}
if (m < 10) {
    m = '0' + m;
}

// Establece el valor del campo de fecha con el formato YYYY-MM-DD
document.getElementById('fecha_pago').value = y + "-" + m + "-" + d;
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var camposAdicionales = [
        'txt_procedencia',
        'txt_provincia',
        'txt_departamento',
        'txt_usu',
        'txt_contra',
        'txt_correo'
      ];

      camposAdicionales.forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
          element.parentElement.style.display = 'none';
        }
      });
    });

    function Validar_Informacion() {
      var isChecked = document.getElementById('checkboxSuccess1').checked;

      // Habilitar o deshabilitar campos de pago
      document.getElementById('txt_admision').disabled = !isChecked;
      document.getElementById('txt_alum_nuevo').disabled = !isChecked;

      // Mostrar u ocultar campos adicionales
      var camposAdicionales = [
        'txt_procedencia',
        'txt_provincia',
        'txt_departamento',
        'txt_usu',
        'txt_contra',
        'txt_correo'
      ];

      camposAdicionales.forEach(function(id) {
        var element = document.getElementById(id);
        if (element) {
          element.parentElement.style.display = isChecked ? 'block' : 'none';
        }
      });
    }



  </script>