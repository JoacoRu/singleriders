   window.onload = function(){

        // var token = document.querySelector('input[name="_token"]').value;
        var token              = document.querySelector('input[name="_token"]');
        var form               = document.querySelector('form[name="form"]');
        var post               = document.getElementById('posteo');
        var url                = '/profilePost';
        var redirect           = 'http://127.0.0.1:8000/profile';
        var postView           = document.querySelector('#publicaciones');
        var urlLike            = 'http://127.0.0.1:8000/profileLike';
        /* var datosDelFormulario = new FormData();
            datosDelFormulario.append('datos', JSON.stringify(form)); */
        
    
        form.onsubmit = function(){
            console.log(XMLHttpRequest);
            fetch(url, {
                headers: {
                  "Content-Type": "application/json",
                  "Accept": "application/json, text-plain, */*",
                  "X-Requested-With": "XMLHttpRequest",
                  'X-CSRF-TOKEN': token.value,
                 },
                method: 'POST',
                credentials: "same-origin",
                body: JSON.stringify({
                  post: post.value,
                })
        
               })
                .then((data) => {
                    console.log(data);
                    form.reset();
                    /* window.location.href = redirect; */
                })
        
               .catch(function(error) {
                   console.log(error);
                 });
        }
        
 /*        function prueba (){
          var promesa = new Promise((resolve)=>{
            fetch("https://jsonplaceholder.typicode.com/todos")
            .then(function (response) {
                return response.json();
              })
              .then((data)=>{
                contar= data
                console.log("algo",contar)
                resolve(data)})
          })
          return promesa
        }
       
        prueba().then(function(result) {
          input= result
        }); */
        
        
        function showPost(){
            
          fetch("http://127.0.0.1:8000/profileAjaxGet")
    
            .then(function (response) {
              console.log(response);
                return response.json();
                
              })
              
              .then(function (data) {
                let token = document.querySelector('meta[name="csrf-token"]').content;
                console.log(data);
                for(let indice in data){
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
                                                <form method='post' action='/profileLike' name="interaccion">
                                                
                                                    <input type='hidden' value='${token}' name='_token'>
                                                    <label for='me_gusta'>Me gusta</label>
                                                    <input type='hidden' value='${data[indice].user_id}' name='user_id'> 
                                                    <input type='hidden' value='${data[indice].post_id}' name='post_id'>
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
                }
               
            })
    
            .catch(function (error) {
                console.log("The error was: " + error);
            })
        }
        
        function sendLikes(){
    
            fetch(urlLike, {
                headers: {
                  "Content-Type": "application/json",
                  "Accept": "application/json, text-plain, */*",
                  "X-Requested-With": "XMLHttpRequest",
                  'X-CSRF-TOKEN': token
                 },
                method: 'post',
                credentials: "same-origin",
                body: JSON.stringify({
                  post: asd,
                })
        
               })
                .then((data) => {
                    
                    window.location.href = redirect;
                })
        
               .catch(function(error) {
                   console.log(error);
                 }); 
        }
    
        
       
    }