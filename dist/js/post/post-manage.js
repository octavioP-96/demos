import {formSubmit} from '../helpers/form.js';

$(document).ready(init);

function init(){
    cargar_post();
}

$("#customFile").on('change', (event) => {
    $("#container_post_image").html(`
        <img id="image_preview" class="img-fluid" >
    `);

    $("#image_preview").attr('src', URL.createObjectURL(event.target.files[0]))
});

$("#btn_discard_changes").on('click', () => {
    $("#form_new_post")[0].reset();
    $("#container_post_image").html('');
});

$("#form_new_post").on('submit', function(e){
    formSubmit(e, $(this).attr('id'), '../api/Post/registrar/', function(data){
        if(data.estatus == 'ok'){
            bootbox.alert({
                title:'Éxito',
                message : data.mensaje,
                backdrop: true
            });
            $("#form_new_post")[0].reset();
            $("#container_post_image").html('');
            $("#area_categorias").html('');
        }else{
            bootbox.alert({
                title:'Atención',
                message : data.info,
                backdrop: true
            });
        }
        cargar_post();
    });
});
let ev;
function cargar_post(){
    $.ajax({
        type:'GET',
        url:'../api/Post/listar/?page=1',
        dataType:'JSON',
        beforeSend: ( ) => {
            $("#container_blogs").html(`<div class="text-center"><i id="spiner_load" class="fas fa-spinner fa-spin"></i></div>`);
        },
        success: ( resp ) => {
            var html_fin = '';
            for(var p in resp){
                html_fin += `
                <div class="card-comment py-3 px-4 mb-2 bg-white shadow-sm c-pointer card-post" data-ref="${resp[p].id_post}">
                    <img class="img-circle img-sm" src="../public/images/posts/${resp[p].imagen}" alt="Post Image">
                    <div class="comment-text">
                        <span class="username">
                            ${resp[p].titulo}
                            <span class="text-muted float-right">${resp[p].fecha_registro}</span>
                        </span>
                        ${resp[p].contenido}
                    </div>
                </div>
                `
            }
            $("#container_blogs").html(html_fin);
            $(".card-post").on('click', ( e ) => {
                var ref = e.target.closest('[data-ref]').getAttribute('data-ref');
                getPostData(ref);
            });
        },
        complete: ( ) => {
            $("#spiner_load").remove();
            
        }
    });
}

function getPostData( post ){
    $("#label_post_edit").html('Edita tu entrada');
    $("#inp_for_edit").remove();
    $.ajax({
        type:'GET',
        url:'../api/Post/consultar_by_id/' + post,
        dataType:'JSON',
        beforeSend: ( ) => {
            // $("#container_blogs").html(`<div class="text-center"><i id="spiner_load" class="fas fa-spinner fa-spin"></i></div>`);
            $("#edit_categorias").remove();
            $("#area_categorias").html('');
        },
        success: ( data ) => {
            $('#titulo').val(data.titulo);
            $('#container_post_image').val();
            $('#contenido').val(data.contenido);
            $('#fecha_inicio').val(data.fecha_inicio.replace(' ', 'T').substring(0, 16));
            $('#fecha_fin').val(data.fecha_fin.replace(' ', 'T').substring(0, 16));
            $("#container_post_image").html(` <img id="image_preview" class="img-fluid" src="../public/images/posts/${data.imagen}">`);
            $("#area_categorias").html('');
            $("#form_new_post").append(`<input type="hidden" id="inp_for_edit" name="for_edit" value="${post}">`)
            for(var c in data.categorias){
                $("#area_categorias").append(`
                <div class="col">
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="category_${data.categorias[c].id_categoria}" id="check${c}" ${data.categorias[c].id_post !== null ? 'checked' : ''}>
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

$("#btn_add_post").on('click', ( ) => {
    $("#form_new_post")[0].reset();
    $("#area_categorias").html('');
    $("#inp_for_edit").remove();
    $("#container_post_image").html('');
});