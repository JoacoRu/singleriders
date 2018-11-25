   
  var form = document.querySelectorAll('form[name="interaccion"]');
  
  function bringsLikes(){
      fetch('http://127.0.0.1:8000/profile')
      
      .then(function(response) {
        return response.json();
        console.log(response);
      })

      .then(function(myJson) {
        console.log(myJson);
      });
  }

  bringsLikes();

