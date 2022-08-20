export function formSubmit(event, formId){
    event.preventDefault();
    var formData = new FormData($(`#${formId}`)[0]);
    $(`#${formId} button[type='submit']`).attr('disabled', true);
    $(`#${formId} button[type='submit']`).parent().append(`<small id="button-form-span">Espere...</small>`);
    $.ajax({
        url:'api/Usuario/validar_login/',
        data: formData,
        type: 'POST',
        dataType: 'json',
		contentType: false,
		processData:false,
        beforeSend: function(){
        },
        success:function(data){
            if(data.estatus == 'ok'){

            }else{
                // alert(data.info);
                bootbox.alert({
                    title:'Atención',
                    message : data.info,
                    backdrop: true
                });
            }
        },
        error: function(e){
            console.log(e);
        }
    });
    setTimeout(() => {
        $(`#${formId} button[type='submit']`).attr('disabled', false);
        $("#button-form-span").remove();
    }, 500);
}