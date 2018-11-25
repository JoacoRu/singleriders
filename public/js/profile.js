window.onload = function(){
  var label = document.querySelectorAll('label[name="cantidad_mg"]');
  
  function changeColorLike(){
    label.forEach(element => {
        element.style.color = '#028ed6';
    });
  }

    function disLike(){

      fetch("http://127.0.0.1:8000/profileDislike")
  
          .then(function (response) {
              return response.json();
              
          })
  
          .then(function (data) {
            labelDislike = document.querySelectorAll('.no_gusta');
            labelDislike.forEach(element => {
              console.log(element)
                element.addEventListener('mouseenter', function(event){
                  event.prevenDefault;
                  element.style.color = 'black';
                })
                element.addEventListener('mouseleave', function(event){
                  event.prevenDefault;
                  element.style.color="red";
                })
            });
          })
  
          .catch(function (error) {
              console.log("The error was: " + error);
          })
  
    }

  changeColorLike();
  disLike()
}