window.onload = function(){
  var label = document.querySelectorAll('label[name="cantidad_mg"]');
  var body  = document.querySelector('body');
  var boton = document.querySelector("#prender");
  var audio = document.querySelector('#audio');
  var newAudio = new Audio();
  newAudio.src = "../images/mama.mp3";
  function changeColorLike(){
    label.forEach(element => {
        element.style.color = '#028ed6';
    });
  }

    function disLike(){

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
  
    }

    function turnOffBody(){
        boton.addEventListener('click', apagarBody);
        function apagarBody(){
            boton.setAttribute('class', 'btn btn-dark mr-2');
            boton.setAttribute('id', 'apagar');
            body.style.background = "rgba(0, 0, 0, 2)";
            body.style.opacity = 0.9;
            body.style.position = "absolute";
            body.style.width = "100%";
            body.style.zIndex = "10";
            newAudio.play();
            prenderBody();
            }
    }

    function prenderBody(){
        var prender = document.querySelector('#apagar');
            prender.addEventListener('click', function(){
                prender.setAttribute('class', 'btn btn-light mr-2');
                prender.setAttribute('id', 'apagar');
                body.style.background = "rgba(0, 0, 0, 0)";
                body.style.opacity = 1;
                body.style.position = "absolute";
                body.style.width = "100%";
                body.style.zIndex = "10";
                turnOffBody();
            });
        }
        turnOffBody();

  changeColorLike();
  disLike()
}