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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content mx-2">
      <div class="row pt-4" >
        <!-- Posts container -->
        <div class="col-sm-12">
          <div class="card-body bg-light border">
            <h3>Bienvenido.</h3>

            <div class="row">
              
              <div class="col-sm-6" style="cursor:pointer;" onclick="window.location.href='../truck/'">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <h3 class="info-box-text text-center ">Vehículos</h3>
                    <i class="fa fa-truck text-center display-2 font-weight-bold"></i>
                    <span class="info-box-text text-center text-muted">Gestionar</span>
                  </div>
                </div>
              </div>
              <div class="col-sm-6" style="cursor:pointer;" onclick="window.location.href='../users/'">
                <div class="info-box bg-light">
                  <div class="info-box-content">
                    <h3 class="info-box-text text-center ">Usuarios</h3>
                    <i class="fa fa-users text-center display-2 font-weight-bold"></i>
                    <span class="info-box-text text-center text-muted">Gestionar</span>
                  </div>
                </div>
              </div>

            </div>
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

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script type="module" src="../dist/js/home/home.js"></script> -->
</body>
</html>
