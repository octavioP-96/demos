export function formSubmit(event, data, url, callb){
    event.preventDefault();
    var formData = new FormData($(`#${event.target.id}`)[0]);
    $(`#${event.target.id} button[type='submit']`).attr('disabled', true);
    $(`#${event.target.id} button[type='submit']`).parent().append(`<small id="button-form-span">Espere...</small>`);
    $.ajax({
        url:url,
        data: formData,
        type: 'POST',
        dataType: 'json',
		contentType: false,
		processData:false,
        beforeSend: function(){
        },
        success:function(data){
            callb(data);
        },
        error: function(e){
            console.log(e);
        }
    });
    setTimeout(() => {
        $(`#${event.target.id} button[type='submit']`).attr('disabled', false);
        $("#button-form-span").remove();
    }, 500);
}