import {storageAvailable, userInfo} from '../helpers/helpers.js';
import {formSubmit} from '../helpers/form.js';

$(document).ready(function(){
    if(!storageAvailable('localStorage')){
        alert('El navegador no es compatible con el sitio');
        return;
    }

    if(userInfo()){
        window.location.replace('/home');
    }
});

$("#form-login").on('submit', function(e){
    formSubmit(e, $(this).attr('id'));
})