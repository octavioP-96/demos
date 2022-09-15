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