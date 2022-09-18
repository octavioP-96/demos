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
            <h1>Blog</h1>
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
              <button class="btn btn-info btn-block">Agregar nuevo</button>
            </div>
            <div class="card-body" id="container_blogs">
              Crea tu primer entrada!
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <!-- Main Card 2 -->
          <div class="card">
            <div class="card-body">
              <form id="form_new_post">
                <h4 id="label_post_edit">Crea tu entrada</h4>
                <div class="row">
                  <div class="col-sm-12 form-group">
                    <label>Titulo</label>
                    <input type="text" class="form-control" placeholder="Título" name="titulo" id="titulo">
                  </div>

                  <span id="container_post_image"></span>
                  
                  <div class="col-sm-12 form-group">
                    <label>Contenido</label>
                    <textarea name="contenido" rows="3" class="form-control" id="contenido"></textarea>
                  </div>
                  
                  <div class="col-sm-12 form-group">
                    <label>Imagen</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="imagen" id="customFile" accept="image/*">
                      <label class="custom-file-label" for="customFile">Selecciona</label>
                    </div>
                  </div>

                  <div class="col-sm-6 form-group">
                    <label>Fecha Inicio</label>
                    <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" class="form-control">
                  </div>
                  
                  <div class="col-sm-6 form-group">
                    <label>Fecha Fin</label>
                    <input type="datetime-local" name="fecha_fin" id="fecha_fin" class="form-control">
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
<script type="module" src="../dist/js/post/post-manage.js"></script>
<script>
  
</script>
</body>
</html>
