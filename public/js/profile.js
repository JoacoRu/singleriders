window.onload = function(){
    let token = document.querySelector ('meta [name = "csrftoken”]'). GetAttribute ('content');
    var form  = document.querySelector('form');
    var post  = document.querySelector('textarea[name="posteo"]').value;
    var url = 'http://127.0.0.1:8000/profile';
    var redirect = 'http://127.0.0.1:8000/home';
    var objetPost;
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
        fetch("https://jsonplaceholder.typicode.com/users")

        .then(function (response) {
            return response.json();
        })

        .then(function (data) {
           
        })

        .catch(function (error) {
            console.log("The error was: " + error);
        })
    }

    showPost()

    console.log(objectPost);
    for( algo in objetPost){
    }

}
