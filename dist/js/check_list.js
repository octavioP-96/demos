var currnt=1;
$(document).ready(function(){
	$('#formCheck')[0].reset();
	// $('.modal').modal({dismissible: false});
	setTimeout(function(){
		$('#overlay-block').fadeOut();
	},400);
});


$('#FinForm').on('click',function(){
    swal({
        icon:'success',
        title:'Registrado con éxito'
    }).then(()=>{
        window.location.replace('./')
    })
    return;
	$('input[type="checkbox"]').each(function(){
		var elm = $(this).prop('name');
		var selected = $(this).prop('checked');
		if (elm != '') {
			if (selected) {
				var destino = elm.split('SOL');
				$('input[name="'+destino[0]+'"]').val('2');
			}
		}
	});

	if ($('.container input[type="radio"]:checked').length == ($('.container input[type="radio"]').length /2)) {
		$('#formCheck').submit();
	}else{
		alert('Complete todos los items del check');
	}
});

$('#formCheck').on('submit',function(e){
	e.preventDefault();
	var dataForm = new FormData(this);
	$.ajax({
		url:'DB_control/respons.php',
		type:'POST',
		data: dataForm,
        contentType: false,
        processData:false,
		beforeSend: function(){
			$('#overlay-block').show();
		},
		success: function(data){
			alert(data);
			window.location.href = "montacargas.php?id="+monta;
		}
	});
});
function hereProblem(t){
	var ele = $(t).prop('id');
	$('#'+ele+'Modal').modal('show');
}

function validar(elm){
	var complete = false;
	var complete_text = true;
	var totalCheck = $('#'+elm+' input[type="radio"]').length;
	var countReal = 0;
	var i = 0;
	$('#'+elm+' input[type="radio"]').each(function(){
		if ($(this).prop("checked")) {
			if ($(this).val() == 'nok') {
				$('#'+elm+' input[type="text"]').each(function(){
				    if(!$(this).prop('disabled')){
				        if ($(this).val() == '' || $(this).val() == ' ') { complete_text = false;}
				    }
				});
			}

			countReal++;
		}
		i++;
		if (i == totalCheck) {
			if (countReal == (totalCheck / 3)) {
				if (!complete_text) {
					alert('llene los campos')
				}else{
					complete = true;
					// alert('todo ok')
					$('#'+elm).modal('close');
				}
			}else{
				alert('complete los campos');
				complete = false;
			}
		}
	});
}

$('#siguienteBTN').on('click',function(){
	$('#siguienteBTN').prop('disabled',true);
	$('#section'+currnt).fadeOut(function(){
		currnt++;
		if (currnt > 4) {currnt = 1}
			if (currnt == 4) {
				$('#FinForm').attr('disabled',false);
				
			}else{
				$('#FinForm').attr('disabled',true);
			}
		$('#section'+currnt).fadeIn();
		$('#siguienteBTN').prop('disabled',false);
	});
});
$('#anteriorBTN').on('click',function(){
	$('#anteriorBTN').prop('disabled',true);
	$('#section'+currnt).fadeOut(function(){
		currnt--;
		if (currnt < 1) {currnt = 4}
			if (currnt == 4) {
				$('#FinForm').attr('disabled',false);
				
			}else{
				$('#FinForm').attr('disabled',true);
			}
		$('#section'+currnt).fadeIn();
		$('#anteriorBTN').prop('disabled',false);
	});
});

$('.container input[type="radio"').on('click',function(){
	console.log($(this).val());
});

function setformModalOk(modal){
	$(`#${modal} input[type="text"]`).prop('disabled',true);
	$(`#${modal} input[type="checkbox"]`).prop('disabled',true);
	$(`#${modal} input[type="radio"][value="ok"]`).prop('checked',true);
}