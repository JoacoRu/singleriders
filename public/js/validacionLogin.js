window.onload = function(){
    var inputEmail    = document.querySelector('input[name="email"]');
    var inputPass     = document.querySelector('input[name="password"]');
    var emailRegex    = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    var form          = capturarForm('form');

    function capturarForm(form){
        var formulario = document.querySelector(form);
        return formulario;
    }

    function validacionLogin(){
        form.addEventListener('submit', function(event){
            event.preventDefault;
            if(inputEmail.value === ''){
              var respuestaMail = alert('El mail esta vacio');
            }else if(!emailRegex.test(inputEmail.value)){
                alert('El mail debe tener formato valido');
            }
            if(inputPass.value == ''){
              var respuestaPass = alert('El pass esta vacio');
            }
        });
    }

    validacionLogin();
}