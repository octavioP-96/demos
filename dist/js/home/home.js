import {verify_sesion} from '../helpers/helpers.js';
$(document).ready(function(){
    console.log(verify_sesion('../api/Usuario/validar_sesion/'));
    init();
});

function init(){
    $.ajax({
        url:'../api',
        success:function(data){
            console.log(data);
        },
        error: function(e){
            console.log(e);
        }
    })
}