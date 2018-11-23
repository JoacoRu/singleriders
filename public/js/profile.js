window.onload = function(){

    let token              = document.querySelector ('meta [name = "csrftoken"]');
    var form               = document.querySelector('form');
    var post               = document.querySelector('textarea[name="posteo"]').value;
    var url                = 'http://127.0.0.1:8000/profile';
    var redirect           = 'http://127.0.0.1:8000/home';
    var postView           = document.querySelector('#publicaciones');
    var datosDelFormulario = new FormData();
        datosDelFormulario.append('datos', JSON.stringify(form));
    var postHtml = 

   function sendData(){ 
    fetch(url, {
        headers: {
          "Content-Type": "application/json",
          "Accept": "application/json, text-plain, */*",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": token
         },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify({
          post: post,
        })

       })
        .then((data) => {
            form.reset();
            window.location.href = redirect;
        })

       .catch(function(error) {
           console.log(error);
         });
       } 

    form.onsubmit = function(){
        sendData();
    }

    function showPost(){
        fetch("http://127.0.0.1:8000/profileAjaxGet")

        .then(function (response) {
            return response.json();
            
        })

        .then(function (data) {
            for(let indice in data){
                let post =       "<div class='col-12 p-10 pt-4 col-md-8'><article class='articulo_post'><div class='posteos_card'><div class='datos_post'><img style='max-width: 30px;' class='border rounded-circle' src='imagen' alt=' id='foto-perfil'><p> {{ Auth::user()->name. ' '. Auth::user()->lastname}}</p></div><div class='contenido_post'><p>asdasdasdasd</p><input type='text' value='asdasdasds' hidden></div><div class='post_interaccion'><label for='me_gusta'>Me gusta</label><img src='images/iconos/interaccion_posteo/me-gusta_no_seleccionado.png' alt=' name='me_gusta'><label for='comentar'>Comentar</label><img src='images/iconos/interaccion_posteo/comentario.png' alt=' name='comentar'></div></div></article></div>";
                postView.append(post);
            };
        })

        .catch(function (error) {
            console.log("The error was: " + error);
        })
    }

    showPost()

   
}
