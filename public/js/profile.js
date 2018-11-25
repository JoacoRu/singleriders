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
        
    
        // form.onsubmit = function(){
        //     console.log(XMLHttpRequest);
        //     fetch(url, {
        //         headers: {
        //           "Content-Type": "application/json",
        //           "Accept": "application/json, text-plain, */*",
        //           "X-Requested-With": "XMLHttpRequest",
        //           'X-CSRF-TOKEN': token.value,
        //          },
        //         method: 'POST',
        //         credentials: "same-origin",
        //         body: JSON.stringify({
        //           post: post.value,
        //         })
        
        //        })
        //         .then((data) => {
        //             console.log(data);
        //             form.reset();
        //             /* window.location.href = redirect; */
        //         })
        
        //        .catch(function(error) {
        //            console.log(error);
        //          });
        // }
        
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