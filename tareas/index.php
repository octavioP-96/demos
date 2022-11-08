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
            <h1>Tareas</h1>
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
      <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Usuarios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Tareas</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <!-- Main Card 1 -->
                  <div class="card card-comments">
                    <div class="m-2">
                        <h5 class="mx-2">Seleccione para asignar tareas</h5>
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
                            <label>Teléfono</label>
                            <input type="tel" class="form-control" placeholder="Teléfono" name="telefono" id="telefono">
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
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc euismod pellentesque diam.
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>

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
<script type="module" src="../dist/js/tareas/tareas-manage.js"></script>
<script>
  
</script>
</body>
</html>
