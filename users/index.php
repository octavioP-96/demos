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
              <div class="row">
                <div class="col-sm-12 col-md-4"><h3>Usuarios.</h3></div>
                <div class="col-sm-12 col-md-4">
                  <button class="btn btn-primary float-right" onclick="crearUsuario()">
                    Crear usuario
                  </button>
                </div>
              </div>
              <div class="row">
                <!-- maincontent -->
                <div class="col-sm-12 col-md-6">
                  <table id="mainTable" class="table">
                    <thead>
                      <th>Nombre</th>
                      <th>Clave acceso</th>
                      <th>N° de control</th>
                      <th></th>
                    </thead>
                    <tbody id="vehiculosTable">

                    </tbody>
                  </table>
                </div>

                <div class="col-sm-12 col-md-6">
                  <div id="preview">

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

  <?php require('../layout/modalUser.html'); ?>

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <!-- <script type="module" src="../dist/js/home/home.js"></script> -->
  <script>
    let datos = [];
    $(document).ready(() => {
      getAllUsers();
    })
    function showTruck(id) {
      $("#preview").fadeOut('fast', () => {
        var elm = datos.find(elm => elm.id_usuario == id);
        var fecha = new Date();
        $("#preview").html(
          `
        <div class="card card-body mt-5 mx-3">
          <h3>Información</h3>
          <div class="row">
            <div class="col-6">
              <p class="mb-1"><b>Nombre:</b> ${elm.nombre} ${elm.A_materno} ${elm.A_paterno}</p>
              <p class="mb-1"><b>Clave acceso:</b> ${elm.clave_acceso}</p>
              <p class="mb-1"><b>N° control:</b> ${elm.num_zap}</p>
            </div>
            <div class="col-6">
              <p class="mb-1"><b>Fecha de registro:</b> ${fecha.toISOString().substring(0, 16).replace('T', ' ')}</p>
            </div>
          </div>

          <div class="row">
            <div class="col text-right text-end">
              <a href="detalles.php?elemento=${id}">Ver..</a>
            </div>
          </div>
        </div>
        `
        )
      });
      $("#preview").fadeIn('fast');
    }
    function getAllUsers() {
      $.ajax({
        url: '../api/DB_control/usuario_control.php',
        type: 'POST',
        data:{tipo:'all_user'},
        dataType: 'json',
        success: (data) => {
          datos = data;
          var content = data.map(elm => `
        <tr>
          <td>
            ${elm.nombre} ${elm.A_materno} ${elm.A_paterno}
          </td>
          <td>
            ${elm.clave_acceso}
          </td>
          <td>
            ${elm.num_zap}
          </td>
          <td>
            <button  class="btn btn-primary" onclick="showTruck(${elm.id_usuario})">
              <i class="fa fa-eye"></i>
            </button>
            <button onclick="cargarInfoUsuario(${elm.id_usuario})" class="btn btn-info" >
              <i class="fa fa-pencil"></i>
            </button>
          </td>
        </tr>
        `)
          $("#vehiculosTable").html(content.join(''));
          $("#mainTable").DataTable();
        }
      });
    }
  </script>

  <script src="../dist/js/layout/modalUser.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>