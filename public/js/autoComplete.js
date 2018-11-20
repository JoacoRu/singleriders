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
        });

    }


    function autoComplete(){
       
    }
    
    tabUnoADos();
    tabDosATres();
}