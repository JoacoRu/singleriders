window.onload = function(){
    //PRIMER FORM//
    var flexibility  = document.querySelectorAll('input[name="flexibility"]');
    var inputTitle   = document.querySelector('input[name="msgInti"]');
    var country      = document.getElementById('country');
    var amount       = document.querySelector('input[name="amount"]');
    var article_uno  = document.querySelector('#tab1');
    var article_dos  = document.querySelector('#tab2');
    var article_tres = document.querySelector('#tab3');
    var tabs         = document.querySelector('.tabs');
    var body         = document.querySelector('body');
    var boton        = document.querySelector("#prender");
    inputTitle.focus();

    function cambiarSubrayado(numero){
        let tabsChildren = tabs.children;
        for(let i = 0 ; i < tabsChildren.length; i++){
            if(i == numero){
                let iterador    = tabsChildren[i].children;
                let iteradorDos = tabsChildren[i+1].children;

                for (let n = 0; n < iterador.length; n++) {
                    iterador[n].setAttribute('class', ' ');   
                }
                
                for (let d = 0; d < iteradorDos.length; d++) {
                    iteradorDos[d].setAttribute('class', 'active');
                    
                }
            }
            if(i == 1){
                let iterador    = tabsChildren[i-1].children;
                for (let d = 0; d < iterador.length; d++) {
                    iterador[d].setAttribute('class', ' ');
                }
            }
        }
    }

    function tabUnoADos(){
        
        for(let i = 0 ; i < flexibility.length; i++){
            flexibility[i].addEventListener('change', function(event){
            event.preventDefault;
            article_dos.style.display = 'inherit'; 
            article_uno.style.display = "none";
            cambiarSubrayado(0);
            amount.focus();
        });
       }
    }

    function tabDosATres(){
        country.addEventListener('change', function(event){
            event.preventDefault;
            article_dos.style.display  = 'none';
            article_tres.style.display = 'inherit';
            cambiarSubrayado(1);
            amount.focus();
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
    tabUnoADos();
    tabDosATres();
    deploy('content');
}