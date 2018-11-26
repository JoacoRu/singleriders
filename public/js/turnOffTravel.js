window.onload = function(){
    var body = document.querySelector('body');

    var boton = document.querySelector("#prender");
    console.log(boton);
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
            prenderBody();
            }
    }

    function prenderBody(){
        var prender = document.querySelector('#apagar');
            prender.addEventListener('click', function(){
                prender.setAttribute('class', 'btn btn-light mr-2');
                prender.setAttribute('id', 'apagar');               
                body.style.position = "absolute";
                body.style.width = "100%";
                body.style.zIndex = "10";
                body.style.backgroundImage =" url(../images/crea/beach.jpg)";
                body.style.backgroundAttachment = "fixed";
                body.style.backgroundRepeat = "no-repeat";
                body.style.backgroundSize = "cover";
                body.style.backgroundPosition = "center";

                
                turnOffBody();
            });
        }
        turnOffBody();
}