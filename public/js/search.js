window.onload = function () {
        
        var search = document.querySelector('.search');
        var input  = document.querySelector('input[name="search"]');
        
        
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

        validarBusqueda()
}


