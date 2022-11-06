import {verify_sesion} from '../helpers/helpers.js';
$(document).ready(function(){
    init();
});

async function init(){
    var posts = await verify_sesion('../api/Home/init/');
    var html_fin ='';
    console.log(posts);
    for(var p in posts){
        var icons = posts[p].categorias.map(
            elm => 
            `<div class="badge rounded-circle badges-main mr-1" style="background-color:${elm.back_color || '#000'}; color:${elm.color || '#fff'}"> 
                <i class="fa ${elm.icono || 'fa-chain-broken'}"></i>
            </div>`).join('');
        html_fin += `
        <div class="py-3 px-4 mb-2 bg-white shadow-sm c-pointer card-post">
            <h3 class="mt-2 mb-2 ml-2">
                <span class="custom-span pb-1">
                    ${posts[p].titulo}
                </span>
            </h3>
            <img class="img-fluid rounded" src="../public/images/posts/${posts[p].imagen}" alt="Post Image">
            <blockquote class="quote-secondary bg-light mb-2 mt-0 mx-0">
                <p class="mb-2">${posts[p].contenido}</p>
                <div style="position:relative; width:100%; top:0;">
                    <div style="position:absolute; top:0; right:0">
                        ${icons}
                    </div>
                </div>
                <small><cite>${posts[p].fecha_registro}</cite></small>
            </blockquote>
        </div>
        `
    }
    $("#container_blogs").html(html_fin);
}