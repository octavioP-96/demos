import {storageAvailable, userInfo, verify_sesion} from '../helpers/helpers.js';
import {formSubmit} from '../helpers/form.js';

$(document).ready(function(){
    if(!storageAvailable('localStorage')){
        alert('El navegador no es compatible con el sitio');
        return;
    }
    var user_loged = userInfo();
    if(user_loged){
        console.log(verify_sesion());
        window.location.replace('/home');
    }
});

$("#form-login").on('submit', function(e){
    formSubmit(e, $(this).attr('id'));
})