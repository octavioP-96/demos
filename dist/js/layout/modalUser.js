function crearUsuario() {
    $("#id_user").val('');
    $("#modalUser").modal('show');
    $("#previewPict").attr('src', `../dist/img/colaboradores/user.png`);
    $("#formUpdateUser")[0].reset();
}

function cargarInfoUsuario( usuario ){
    $.ajax({
        url: '../api/DB_control/usuario_control.php',
        type: 'POST',
        data:{tipo:'get_user', user:usuario},
        dataType: 'json',
        success: (data) => {
            var elm = data;
            $("#previewPict").attr('src', `../dist/img/colaboradores/${(elm.foto != '') ? elm.foto : 'user.png'}`)
            $("#id_user").val(elm.id_usuario);
            $("#inpIdentificador").val(elm.num_zap);
            $("#inpNombre").val(elm.nombre);
            $("#inpApaterno").val(elm.A_paterno);
            $("#inpAmaterno").val(elm.A_materno);
            $("#inpNombreAcceso").val(elm.clave_acceso);
            $("#selectTipoUsuario").val(elm.categoria);
            $("#inpCorreo").val(elm.correo);
            $("#inpTelefono").val(elm.telefono);
            $("#modalUser").modal('show');
        }
      });
}

$("#fotoUser").on('change', (ev) => {
    const [file] = $("#fotoUser")[0].files;
    if (file) {
        $("#previewPict")[0].src = URL.createObjectURL(file)
    }
})

$("#formUpdateUser").on('submit', ( e ) => {
    e.preventDefault();
    var fData = new FormData(event.target);
    fData.append('tipo', 'actualizaUser')
    $.ajax({
        url: '../api/DB_control/usuario_control.php',
        type: 'POST',
        data: fData,
        contentType: false,
        processData:false,
        dataType: 'json',
        success: (data) => {
            if(data.estatus == 'ok'){
                Swal.fire({
                    icon:'success',
                    title:'Éxito!'
                });
            }else{
                Swal.fire({
                    icon:'info',
                    text:data.mensaje
                });
            }
            getAllUsers();
        }
      });
});