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
                <div class="col-sm-12 col-md-8" id="preview">

                </div>

                <div class="col-sm-12 col-md-6">

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
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const usr = urlParams.get('elemento');
      let monta_gral = {};
      $.ajax({
        url: '../api/DB_control/usuario_control.php',
        type: 'POST',
        data:{tipo:'get_user', user:usr},
        dataType: 'json',
        success: (data) => {
          elm = data;
          var fecha = new Date();
          $("#preview").html(
            `
        <div class="card card-body">
              
          <div class="row">
            <div class="col-3">
                <img class="img-fluid" src="../dist/img/colaboradores/${elm.foto || 'user.png'}">
            </div>
            <div class="col-9 " style="overflow:auto">
                <table class="w-100">
                    <tr> <td><b>Nombre:</b></td> <td>${elm.nombre} ${elm.A_materno} ${elm.A_paterno}</td> </tr>
                    <tr> <td><b>Clave acceso:</b></td> <td>${elm.clave_acceso}</td> </tr>
                    <tr> <td><b>N° control:</b></td> <td> ${elm.num_zap}</td> </tr>
                    <tr> <td><b>Fecha de registro:</b></td> <td>${fecha.toISOString().substring(0, 16).replace('T', ' ')}</td> </tr>

                    <!-- <tr> <td><b>N° de licencia:</b></td> <td>${Math.floor(Math.random() * (50000 - 60000) + 60000)}</td> </tr> -->
                </table>
            </div>
            <div class="col text-right ">
              <button class="btn btn-flat" onclick="cargarInfoUsuario(${usr})"><i class="fa fa-cogs text-dark" aria-hidden="true"></i></button>
              <a href="${elm.correo != '' ? 'mailto:'+elm.correo : '#'}"><i class="fa fa-envelope text-dark" aria-hidden="true"></i></a>
            </div>
          </div>

        </div>
        `
          )
        }
      });

    })
  </script>
  <script src="../dist/js/layout/modalUser.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>