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
                <div class="col-sm-12 col-md-4"><h3>Vehículos.</h3></div>
                <div class="col-sm-12 col-md-4">
                  <button class="btn btn-primary float-right" onclick="crearVehiculo()">
                    Registrar
                  </button>
                </div>
              </div>
              <div class="row">
                <!-- maincontent -->
                <div class="col-sm-12 col-md-6">
                  <table id="mainTable" class="table">
                    <thead>
                      <th>Vehículo</th>
                      <th>Capacidad</th>
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

  <?php require('../layout/modalTruck.html'); ?>

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
      getAllCars();
    })
    function showTruck(id) {
      $("#preview").fadeOut('fast', () => {
        var elm = datos.find(elm => elm.id == id);
        $("#preview").html(
          `
        <div class="card card-body">
          <h3>Información</h3>
          <div class="row">
            <div class="col-6">
              <p class="mb-1"><b>Modelo:</b> ${elm.modelo}</p>
              <p class="mb-1"><b>Capacidad:</b> ${elm.capacidad}</p>
              <p class="mb-1"><b>Serie:</b> ${elm.modelo.toUpperCase() + Math.floor(Math.random() * (50000 - 60000) + 60000)}</p>
            </div>
            <div class="col-6">
              <p class="mb-1"><b>Combustión:</b> ${elm.combustion}</p>
              <p class="mb-1"><b>Incidencias activas:</b> ${elm.incidentes}</p>
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
    function getAllCars(){
      $.ajax({
        url: '../api/DB_control/montas_control.php',
        type: 'POST',
        data:{tipo:'select_all'},
        dataType: 'json',
        success: (data) => {
          datos = data;
          var content = data.map(elm => `
        <tr>
          <td>
            <p class="mb-1"><b>Modelo:</b> ${elm.modelo}</p>
          </td>
          <td>
            <p class="mb-1"><b>Capacidad:</b> ${elm.capacidad}</p>
          </td>
          <td>
            <button class="btn btn-primary" onclick="showTruck(${elm.id})">
              <i class="fa fa-eye"></i>
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

  <script src="../dist/js/layout/modalTruck.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>