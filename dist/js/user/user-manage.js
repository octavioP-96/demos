import {formSubmit} from '../helpers/form.js';

/* btn_add_user
form_new_user
label_user_edit */

$(document).ready(init);

function init(){
    cargar_usuarios();
}

$("#btn_discard_changes").on('click', () => {
    $("#form_new_user")[0].reset();
    $("#area_categorias").html('');
});

$("#form_new_user").on('submit', function(e){
    formSubmit(e, $(this).attr('id'), '../api/Usuario/registrar/', function(data){
        if(data.estatus == 'ok'){
            bootbox.alert({
                title:'Éxito',
                message : data.mensaje,
                backdrop: true
            });
            $("#form_new_user")[0].reset();
            $("#area_categorias").html('');
        }else{
            bootbox.alert({
                title:'Atención',
                message : data.info,
                backdrop: true
            });
        }
        cargar_usuarios();
    });
});
let ev;
function cargar_usuarios(){
    $.ajax({
        type:'GET',
        url:'../api/Usuario/listar/?page=1',
        dataType:'JSON',
        beforeSend: ( ) => {
            $("#container_users").html(`<div class="text-center"><i id="spiner_load" class="fas fa-spinner fa-spin"></i></div>`);
        },
        success: ( resp ) => {
            var html_fin = '';
            for(var p in resp){
                html_fin += `
                <div class="card-comment py-3 px-4 mb-2 bg-white shadow-sm c-pointer card-user" data-ref="${resp[p].id_usuario}">
                    <img class="img-circle img-sm" src="../public/images/posts/c4ca4238a0b923820dcc509a6f75849b.jpg" alt="User Image">
                    <div class="comment-text">
                        <span class="username">
                            ${resp[p].paterno} ${resp[p].materno} ${resp[p].nombre}
                            <span class="text-muted float-right">${resp[p].fecha_creado}</span>
                        </span>
                        ${resp[p].correo} <br> ${resp[p].telefono}
                    </div>
                </div>
                `
            }
            $("#container_users").html(html_fin);
            $(".card-user").on('click', ( e ) => {
                var ref = e.target.closest('[data-ref]').getAttribute('data-ref');
                getUserData(ref);
            });
        },
        complete: ( ) => {
            $("#spiner_load").remove();
            
        }
    });
}

function getUserData( user ){
    $("#label_user_edit").html('Edita la información del usuario');
    $("#inp_for_edit").remove();
    $.ajax({
        type:'GET',
        url:'../api/Usuario/consultar_by_id/' + user,
        dataType:'JSON',
        beforeSend: ( ) => {
            // $("#container_users").html(`<div class="text-center"><i id="spiner_load" class="fas fa-spinner fa-spin"></i></div>`);
            $("#edit_categorias").remove();
            $("#area_categorias").html('');
        },
        success: ( data ) => {
            $("#area_categorias").html('');

            $("#nombre").val(data.nombre);
            $("#paterno").val(data.paterno);
            $("#materno").val(data.materno);
            $("#username").val(data.username);
            $("#correo").val(data.correo);

            $("#form_new_user").append(`<input type="hidden" id="inp_for_edit" name="for_edit" value="${user}">`)
            for(var c in data.categorias){
                $("#area_categorias").append(`
                <div class="col">
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="category_${data.categorias[c].id_categoria}" id="check${c}" ${data.categorias[c].id_usuario !== null ? 'checked' : ''}>
                        <label class="form-check-label" for="check${c}">
                            <div class="badge" style="background-color:${data.categorias[c].back_color}; color:${data.categorias[c].color}"> ${data.categorias[c].nombre}</div>
                        </label>
                    </div>
                </div>
                `)
            }
        }
    });
}

$("#btn_add_user").on('click', ( ) => {
    $("#form_new_user")[0].reset();
    $("#area_categorias").html('');
    $("#inp_for_edit").remove();
    $("#container_post_image").html('');
});