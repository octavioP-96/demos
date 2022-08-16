export function formSubmit(event, formId){
    event.preventDefault();
    var formData = new FormData($(`#${formId}`)[0]);
    $(`#${formId} button[type='submit']`).attr('disabled', true);
    $(`#${formId} button[type='submit']`).parent().append(`<small id="button-form-span">Espere...</small>`);
    $.ajax({
        url:'api/Usuario/validar_login/',
        data: formData,
        type: 'POST',
		contentType: false,
		processData:false,
        beforeSend: function(){
            console.log('hi');
        },
        success:function(data){
            console.log(data);
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