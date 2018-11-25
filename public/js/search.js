window.onload = function () {
        
        var search = document.querySelector('.search');
        
        
        function bringsProfiles(){
        
        fetch('http://127.0.0.1:8000/searchH')
        .then(function(data) {
            return data.json();
            console.log(data)
        })
        .then(function(myJson) {
            console.log(myJson);
        });
    }

    /* search.addEventListener('submit', function() {
        bringsProfiles();
    }) */
}


