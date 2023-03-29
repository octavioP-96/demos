<!DOCTYPE html>
<html lang="es">
<?php require('../layout/metas.php'); ?>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <!-- remove -->
    <?php require('../layout/header.php'); ?>
    <!-- remove -->
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <!-- remove -->
    <?php require('../layout/aside.php'); ?>
    <!-- remove -->
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Main content -->
      <section class="content mx-2">
        <div class="row pt-4">
          <!-- Posts container -->
          <div class="col-sm-12">
            <div class="card-body bg-light border">
              <h3>Información.</h3>

              <div class="row">
                <!-- maincontent -->
                <div class="col-sm-12 col-md-6" id="preview">

                </div>

                <div class="col-sm-12 col-md-6">
                  <div class="card card-body">
                    <label for="inpFiltroFecha">Buscar Fecha</label>
                    <input type="week" class="form-control" id="inpFiltroFecha" max="<?php echo date('Y-\WW') ?>" value="<?php echo date('Y-\WW') ?>">
                    <hr>
                    <table class="table table-striped table-sm" id="tableChecks">
                      <thead>
                        <th>Historico</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="d-flex justify-content-between">
                              <span class="text-mutted"><b>Fecha:</b> 22 de Junio 2022</span>
                              <span class="text-mutted"><b>Revisado:</b> <i
                                  class="fa-regular fa-square-check ml-2 text-success"></i></span>
                            </div>
                            <div class="d-flex justify-content-between">
                              <span class="text-mutted"><b>Turno:</b> Tercero</span>
                              <span class="text-mutted"><b>Operario:</b> Usuario 10 Paterno Materno</span>
                            </div>
                            <div class="d-flex justify-content-end p-2">
                              <div class="bg-light border">
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-muted"><i
                                    class="fas fa-clipboard-list mx-2"></i></a>
                                <a href="#" data-toggle="modal" data-target="#Modal" class="text-muted"><i
                                    class="fas fa-exclamation-circle mx-2"></i></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="d-flex justify-content-between">
                              <span class="text-mutted"><b>Fecha:</b> 22 de Junio 2022</span>
                              <span class="text-mutted"><b>Revisado:</b> <i
                                  class="fa-regular fa-square ml-2"></i></span>
                            </div>
                            <div class="d-flex justify-content-between">
                              <span class="text-mutted"><b>Turno:</b> Segundo</span>
                              <span class="text-mutted"><b>Operario:</b> Usuario 1 Paterno Materno</span>
                            </div>
                            <div class="d-flex justify-content-end p-2">
                              <div class="bg-light border">
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-muted"><i
                                    class="fas fa-clipboard-list mx-2"></i></a>
                                <a href="#" data-toggle="modal" data-target="#Modal" class="text-muted"><i
                                    class="fas fa-exclamation-circle mx-2"></i></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <div class="d-flex justify-content-between">
                              <span class="text-mutted"><b>Fecha:</b> 22 de Junio 2022</span>
                              <span class="text-mutted"><b>Revisado:</b> <i
                                  class="fa-regular fa-square-check ml-2 text-success"></i></span>
                            </div>
                            <div class="d-flex justify-content-between">
                              <span class="text-mutted"><b>Turno:</b> Primero</span>
                              <span class="text-mutted"><b>Operario:</b> Usuario 2 Paterno Materno</span>
                            </div>
                            <div class="d-flex justify-content-end p-2">
                              <div class="bg-light border">
                                <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-muted"><i
                                    class="fas fa-clipboard-list mx-2"></i></a>
                                <a href="#" data-toggle="modal" data-target="#Modal" class="text-muted"><i
                                    class="fas fa-exclamation-circle mx-2"></i></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div> <!-- end maincontent -->
            </div>
          </div>
          <!-- End Posts container -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
      </div>
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->
  <!-- modals -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Check-list</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col s4">
              <table>
                <tbody>
                  <tr>
                    <th>Calificadores</th>
                  </tr>
                </tbody>
              </table>
              <div style="overflow: auto; height: 40vh;">
                <table>
                  <tbody>
                    <tr>
                      <td class="small">1. Normal / Ok</td>
                    </tr>
                    <tr>
                      <td class="small">2. Se encontró anomalía y se corrigió</td>
                    </tr>
                    <tr>
                      <td class="small">3. Requiere mantenimiento</td>
                    </tr>
                    <tr>
                      <td class="small">4. N/A <small>(No Aplica)</small></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="bg-secondary rounded-pill px-3">
                <span><a href="#" id="enlaceFirmar" class="text-light">Firmar de enterado</a></span>
              </div>
            </div>
            <div class="col s8">
              <table>
                <thead>
                  <tr>
                    <th>Puntos de revision</th>
                    <th>Calif.</th>
                  </tr>
                </thead>
              </table>
              <div style="overflow: auto; height: 40vh;">
                <table>
                  <tbody>
                    <tr>
                      <td style="font-family: initial;">Condiciones del equipo (golpeado, rayado)</td>
                      <td id="1">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Protector del Operador flojo y/o dañado</td>
                      <td id="2">3</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Protector de carga dañado o flojo</td>
                      <td id="3">4</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Condición del mástil y/o torre *</td>
                      <td id="4">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Cadenas de ascenso y descenso (engrasadas)</td>
                      <td id="5">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Pistón de elevación y descenso</td>
                      <td id="6">4</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Pistón de inclinación y Retroceso</td>
                      <td id="7">3</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Pistón de movimiento lateral</td>
                      <td id="8">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Uñas u horquillas</td>
                      <td id="9">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Seguros de las horquillas</td>
                      <td id="10">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Condición de las llantas</td>
                      <td id="11">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Tuercas / birlos no están flojos (visual)</td>
                      <td id="12">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Tanque de gas</td>
                      <td id="13">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Manómetro del tanque (solo aplica a gas natural)</td>
                      <td id="14">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Seguros del tanque de gas</td>
                      <td id="15">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Tubería de gas</td>
                      <td id="16">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Fuga de Gas *</td>
                      <td id="17">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Válvula check / conexión para llenado</td>
                      <td id="18">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Fugas en el aceite de motor</td>
                      <td id="19">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Fugas en el sistema hidráulico</td>
                      <td id="20">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Nivel de Combustible (Indicar porcentaje si hay manómetro)</td>
                      <td id="21">70</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Sistema de encendido (switch)</td>
                      <td id="22">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Tablero de instrumentos</td>
                      <td id="23">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Palanca de dirección (avance retroceso) *</td>
                      <td id="24">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Funcionamiento de las palancas de control</td>
                      <td id="25">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Sistema de dirección *</td>
                      <td id="26">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Sistema de frenos *</td>
                      <td id="27">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Freno de mano</td>
                      <td id="28">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Gobernador de velocidad</td>
                      <td id="29">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Radio de comunicación</td>
                      <td id="30">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Extintor operable (manecilla amarilla en área verde)</td>
                      <td id="31">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Luces delanteras, traseras y torreta</td>
                      <td id="32">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Blue Spot</td>
                      <td id="33">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Alarma de reversa *</td>
                      <td id="34">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Banda antiestática</td>
                      <td id="35">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Bocina y/o Claxon *</td>
                      <td id="36">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Cinturón de seguridad *</td>
                      <td id="37">1</td>
                    </tr>
                    <tr>
                      <td style="font-family: initial;">Condiciones de asiento</td>
                      <td id="38">1</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Check-list</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Indicador</th>
                    <th>Observación</th>
                    <th>Detectado</th>
                  </tr>
                </thead>
                <tbody id="cuerpoObs">
                  <tr>
                    <td>Protectores</td>
                    <td><i>Observación detectada</i></td>
                    <td>25 Julio 2022</td>
                  <tr>
                    <td>Llantas</td>
                    <td><i>Llantas agrietadas</i></td>
                    <td>26 Agosto 2022</td>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <!-- <script type="module" src="../dist/js/home/home.js"></script> -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $.fn.modal.Constructor.prototype._enforceFocus = function () { };
    let datos = [];
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const monta = urlParams.get('elemento');

    $("#enlaceFirmar").on('click', () => {
      var inp = document.createElement('input');
      inp.setAttribute('type', 'password');
      inp.setAttribute('readonly', false);
      Swal.fire({
        title: 'Introduzca su contraseña para firmar.',
        html: `<input class="form-control" type="password">`,
        confirmButtonText: 'Firmar',
      })
    })
    
    $(document).ready(() => {
      const urlParams = new URLSearchParams(queryString);
    const monta = urlParams.get('elemento');
      $("#tableChecks").DataTable();
      let monta_gral = {};
      $.ajax({
        url: '../api/DB_control/montas_control.php',
        type: 'POST',
        data: { tipo: 'infoMonta', monta: monta },
        dataType: 'json',
        success: (data) => {
          monta_gral = data;
          $("#preview").html(`<div class="card card-body">
                <div class="row">
                  <div class="col-6">
                      <img class="img-fluid" src="../dist/img/default-150x150.png">
                  </div>
                  <div class="col-6 " style="overflow:auto">
                      <table>
                          <tr> <td><b>Modelo:</b></td> <td>${monta_gral.modelo}</td> </tr>
                          <tr> <td><b>Capacidad:</b></td> <td>${monta_gral.capacidad}</td> </tr>
                          <tr> <td><b>Serie:</b></td> <td>${monta_gral.modelo.toUpperCase() + Math.floor(Math.random() * (50000 - 60000) + 60000)}</td> </tr>
                          <tr> <td><b>Combustión:</b></td> <td>${monta_gral.combustion}</td> </tr>
                          <tr> <td><b>Incidencias activas:</b></td> <td>${monta_gral.incidentes}</td> </tr>
                      </table>
                  </div>
                  <div class="col-12 mt-3">
                  <form action="checklist.php" method="POST" id="MainForm">
                    <input type="date" name="fecha"   id="fechaFM" value="<?php  echo($fecha); ?>" hidden>
                    <input type="text" name="usuario" id="usuarioFM" value="<?php  echo($claveUsr); ?>" hidden>
                    <input type="text" name="turno"   id="turnoFM" value="<?php  echo($retVal); ?>" hidden>
                    <input type="text" name="monta"   id="montaFM" value="${monta}" hidden>
                  </form>
                    <button class="btn btn-sm btn-primary btn-block" onClick="IniciarChecklist()">
                      Registrar Check-list de hoy
                    </button>  
                  </div>
                </div>
              </div>`)
        }
      });

      let inpWeek = $("#inpFiltroFecha").val().split('-');
      cargarDatos(monta, inpWeek[1].replace('W', ''), inpWeek[0]);
    })

    $("#inpFiltroFecha").on('change', () => {
      let inpWeek = $("#inpFiltroFecha").val().split('-');
      cargarDatos(monta, inpWeek[1].replace('W', ''), inpWeek[0]);
    })

    function cargarDatos(id, sem, year) {
      $.ajax({
        url: '../api/DB_control/montas_control.php',
        type: "POST",
        data: { tipo: "consultaMonta", monta: id, seman: sem, anio: year },
        success: function (data) {
          var registros = JSON.parse(data);

          var html = "";
          if (registros !== null) {
            $("#tableChecks").DataTable().clear();
            for (var i = 0; i < (registros.length) - 1; i++) {
              var dispEst = registros[i].estatus;
              (dispEst === "pendiente" || dispEst === "ok") ? dispEst = dispEst : dispEst = "Enterado";
              $("#tableChecks").DataTable().row.add([`<div class="d-flex justify-content-between">
                          <span class="text-mutted"><b>Fecha:</b> ${registros[i].fecha}/span>
                          <span class="text-mutted"><b>Revisado:</b> <i
                              class="fa-regular ${dispEst == 'ok' ? 'fa-square-check text-success' : 'fa-square'} ml-2"></i></span>
                        </div>
                        <div class="d-flex justify-content-between">
                          <span class="text-mutted"><b>Turno:</b> ${registros[i].turno}</span>
                          <span class="text-mutted"><b>Operario:</b> ${registros[i].clave_usuario}</span>
                        </div>
                        <div class="d-flex justify-content-end p-2">
                          <div class="bg-light border">
                            <a href="#" data-toggle="modal" data-target="#exampleModal" class="text-muted"><i
                                class="fas fa-clipboard-list mx-2"></i></a>
                            <a href="#" data-toggle="modal" data-target="#Modal" class="text-muted"><i
                                class="fas fa-exclamation-circle mx-2"></i></a>
                          </div>
                        </div>`]).draw();
              
            }
            $("#tableChecks").DataTable().draw();
            // var detalles_semana = cunsultar_detalles_semana(sem, id);

            $('#linkReporte').html(`<a onclick="getReporte('${sem}','${year}')">Generar reporte de semana ${sem}</a>`);
            $('#LabelSemana').html(sem);
            $('#listado_checks').html(html);
          } else {
            $('#linkReporte').html('<i><b>No hay reporte por generar<b></i>');
            $('#LabelSemana').html(sem);
            $('#listado_checks').html("<li><p>No hay registros para semana " + sem + "</p></li>");
            $('#mensaje').html('<b> </b>');
          }
        },
        error: function (error) {
          console.log(error.getResponseHeader);
        }
      });
    }
    function IniciarChecklist() {
      Swal.fire({
        title: '¿Está seguro de iniciar el checklist?',
        text: "Una vez iniciado no podrá ser modificado.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iniciar'
      }).then((result) => {
        if (result.isConfirmed) {
          $("#MainForm").submit();
        }
      })
    }
  </script>
</body>

</html>