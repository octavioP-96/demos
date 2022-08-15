$(document).ready(function(){
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