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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"><a href="../home">Home</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content mx-2">
      <div class="row">
        <div class="col-sm-12 col-md-6">
          <!-- Main Card 1 -->
          <div class="card card-comments">
            <div class="m-2">
              <button class="btn btn-info btn-block" id="btn_add_user">Agregar nuevo</button>
            </div>
            <div class="card-body" id="container_users">
              
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <!-- Main Card 2 -->
          <div class="card">
            <div class="card-body">
              <form id="form_new_user">
                <h4 id="label_user_edit">Registra un usuario</h4>
                <div class="row">
                  <div class="col-sm-12 form-group">
                    <label>Nombres</label>
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre" id="nombre">
                  </div>
                  <div class="col-sm-12 form-group">
                    <label>Apellido Paterno</label>
                    <input type="text" class="form-control" placeholder="Apellido Paterno" name="paterno" id="paterno">
                  </div>
                  <div class="col-sm-12 form-group">
                    <label>Apellido Materno</label>
                    <input type="text" class="form-control" placeholder="Apellido Materno" name="materno" id="materno">
                  </div>
                  <div class="col-sm-12 form-group">
                    <label>Nombre de Usuario</label>
                    <input type="text" class="form-control" placeholder="Nombre de usuario" name="username" id="username">
                  </div>
                  <div class="col-sm-12 form-group">
                    <label>Correo</label>
                    <input type="text" class="form-control" placeholder="Correo" name="correo" id="correo">
                  </div>
                  <div class="col-sm-12 form-group">
                    <div id="phone_contents"></div>
                  </div>

                  <div id="area_categorias" class="row my-3">
                  </div>

                  <div class="col-sm-12 form-group">
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    <button type="button" class="btn btn-light btn-block" id="btn_discard_changes">Descartar cambios</button>
                  </div>
                </div>
              </form>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.3/bootbox.min.js" integrity="sha512-U3Q2T60uOxOgtAmm9VEtC3SKGt9ucRbvZ+U3ac/wtvNC+K21Id2dNHzRUC7Z4Rs6dzqgXKr+pCRxx5CyOsnUzg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="module" src="../dist/js/user/user-manage.js"></script>
<script>
  
</script>
</body>
</html>
