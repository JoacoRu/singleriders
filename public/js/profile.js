window.onload = function(){

    let token              = document.querySelector ('meta [name = "csrftoken"]');
    var form               = document.querySelector('form');
    var post               = document.querySelector('textarea[name="posteo"]').value;
    var url                = 'http://127.0.0.1:8000/profile';
    var redirect           = 'http://127.0.0.1:8000/home';
    var postView           = document.querySelector('#publicaciones');
    var datosDelFormulario = new FormData();
        datosDelFormulario.append('datos', JSON.stringify(form));

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
                console.log(data);
                let post = 
                           `<div class='col-12 p-10 pt-4 col-md-8'><div class='articulo_post'>
                                <div class='posteos_card'>
                                    <div class='datos_post'>
                                        <img style='max-width: 30px;' class='border rounded-circle' src='imagen' alt=' id='foto-perfil'>
                                        <p>${data[indice].name + ' ' + data[indice].lastname}</p>
                                    </div>
                                    <div class='contenido_post'>
                                        <p>${data[indice].post}</p>
                                    </div>

                                    <div class='post_interaccion'>
                                
                                        <div class='form_interaccion'>
                                            <form method='post'>
                                                <input type="hidden" name="_token" id="csrf-token" value="{{ @csrf }}" />
                                                <label for='me_gusta'>Me gusta</label>
                                                <input type='text' value='${data[indice].user_id}' name='user_id' hidden> 
                                                <input type='text' value='${data[indice].post_id}' name='post_id' hidden>
                                                <button type='submit' id='me_gusta' hidden> 
                                            </form>
                                        </div>
                                        <div class='form_interaccion'> 
                                            <label for='comentar'>Comentar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                postView.innerHTML += post;
            };
        })

        .catch(function (error) {
            console.log("The error was: " + error);
        })
    }

    showPost()

   
}
