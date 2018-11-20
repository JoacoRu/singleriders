window.onload = function(){
    var flexibility  = document.querySelectorAll('input[name="flexibility"]');
    var country      = document.getElementById('country');
    var amount       = document.querySelector('input[name="amount"]');
    var article_uno  = document.querySelector('#tab1');
    var article_dos  = document.querySelector('#tab2');
    var article_tres = document.querySelector('#tab3');

    console.log(article_uno)


    function autoComplete(){
       for(let i = 0 ; i < flexibility.length; i++){
            flexibility[i].addEventListener('focus', function(event){
            event.preventDefault;
            article_dos.style.display = 'inherit'; 
            article_uno.style.visibility = "hidden";
            amount.focus();
        });
       }
    }
    autoComplete();
}