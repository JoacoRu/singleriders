window.onload = function () {
        
        var search = document.querySelector('.search');
        var input  = document.querySelector('input[name="search"]');
        var body   = document.querySelector('body');
        var boton  = document.querySelector("#prender");
        
        function validarBusqueda(){
            search.onsubmit = function(event) {
                    
                    console.log(input.value == 0) ;
                    if(input.value == 0){
                        event.preventDefault(); 
                         input.style.border = '1px solid red';
                         input.setAttribute('placeholder', "Escribí algo :'(");
                     }
            };
        }

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
                    body.style.background = "rgba(0, 0, 0, 0)";
                    body.style.position = "absolute";
                    body.style.width = "100%";
                    body.style.zIndex = "10";
                    turnOffBody();
                });
            }
            turnOffBody();

        validarBusqueda()
}


