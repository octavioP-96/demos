<!DOCTYPE html>
<html lang="es">
<?php require('../layout/metas.php'); ?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <?php require('../layout/header.php'); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php require('../layout/aside.php'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content mx-2">
      <div class="row main-post-container" >
        <!-- Posts container -->
        <div class="col-sm-12 col-md-7">
          <div class="card-body">
            <div id="container_blogs">
              <div class="text-center"><i id="spiner_load" class="fas fa-spinner fa-spin"></i></div>
            </div>
          </div>
        </div>
        <!-- End Posts container -->
        <div class="d-none d-md-block col-md-5">
          <!-- Main Card 2 -->
          <div class="bg-light border">
            <div class="card-body">
              Start creating your amazing application!
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require('../layout/footer.php'); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script type="module" src="../dist/js/home/home.js"></script>
</body>
</html>
