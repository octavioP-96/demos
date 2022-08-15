export function formSubmit(event, formId){
    event.preventDefault();
    var formData = new FormData($(`#${formId}`)[0]);
    $(`#${formId} button[type='submit']`).attr('disabled', true);
    $(`#${formId} button[type='submit']`).parent().append(`<small id="button-form-span">Espere...</small>`);

    setTimeout(() => {
        $(`#${formId} button[type='submit']`).attr('disabled', false);
        $("#button-form-span").remove();
    }, 500);
}