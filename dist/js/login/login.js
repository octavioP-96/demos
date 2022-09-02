import {storageAvailable, userInfo, verify_sesion, setUserInfo} from '../helpers/helpers.js';
import {formSubmit} from '../helpers/form.js';

$(document).ready(function(){
    if(!storageAvailable('localStorage')){
        alert('El navegador no es compatible con el sitio');
        return;
    }
    var user_loged = userInfo();
    if(user_loged){
        // verificar que el token sea valido
        console.log(verify_sesion());
        // window.location.replace('./home');
    }
});

$("#form-login").on('submit', function(e){
    formSubmit(e, $(this).attr('id'), 'api/Usuario/validar_login/', function(data){
        if(data.estatus == 'ok'){
            bootbox.alert({
                message : 'Bienvenido',
                backdrop: true
            });
            setUserInfo(data.data);
            window.location.replace('./home');
        }else{
            bootbox.alert({
                title:'Atención',
                message : data.info,
                backdrop: true
            });
        }
    });
})