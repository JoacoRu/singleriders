window.onload = function (){
    var inputEmail    = document.querySelector('input[name="email"]');
    var inputPass     = document.querySelector('input[name="password"]');
    var form          = capturarForm('form');
    var emailRegex    = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    var numeroRegex   = /^[0-9]$/;
    var inputNombre   = document.querySelector('input[name="nombre"]');
    var inputApellido = document.querySelector('input[name="apellido"]');

    function capturarForm(form){
        var formulario = document.querySelector(form);
        return formulario;
    }

    function validacionRegistro(){
        form.addEventListener('submit', function(event){

            if(inputNombre.value === ''){
                event.preventDefault();
                alert('El nombre esta vacio');
            }else if(!numeroRegex.test(inputNombre.value)){
                alert('El nombre no debe contener numeros');
            }

            if(inputApellido.value === ''){
                event.preventDefault();
                alert('El campo apellido esta vacio');
            }else if(!numeroRegex.test(inputNombre.value)){
                alert('El campo apellido no puede contener numero');
            }

            if(inputEmail.value === ''){
                event.preventDefault();
                alert('El campo email no puede estar vacio');
            }else if(!emailRegex.test(inputEmail.value)){
                event.preventDefault();
                alert('El mail debe tener formato valido');
            }

            if(inputPass.value === ''){
                event.preventDefault();
                alert('El input password esta vacio');
            }

        });
    }
    validacionRegistro();

}