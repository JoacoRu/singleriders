let dropdown = document.getElementById('paises');
dropdown.length = 0;

let defaultOption = document.createElement('option');
defaultOption.text = 'Seleccionar país de residencia';
defaultOption.value = '';

dropdown.add(defaultOption);
dropdown.selectedIndex = 0;

const urlpais = 'http://localhost:8000/api/paises';

fetch(urlpais)
  .then(
    function(response) {
      if (response.status !== 200) {
        console.warn('error: ' +
          response.status);
        return;
      }

      // Examine the text in the response
      response.json().then(function(data) {
        let option;

    	for (let i = 0; i < data.length; i++) {
          option = document.createElement('option');
      	  option.text = data[i].name;
      	  option.value = data[i].name;
      	  dropdown.add(option);
    	}
      });
    }
  )
  .catch(function(err) {
    console.error('Fetch Error -', err);
  });


  let dropdownprov = document.getElementById('provincias');
  dropdownprov.length = 0;

  let defaultOptionprov = document.createElement('option');
  defaultOptionprov.text = 'Seleccionar provincia';

  dropdownprov.add(defaultOptionprov);
  dropdownprov.selectedIndex = 0;

  const urlprovincia = 'http://localhost:8000/api/provincias';

  fetch(urlprovincia)
    .then(
      function(response) {
        if (response.status !== 200) {
          console.warn('error: ' +
            response.status);
          return;
        }

        // Examine the text in the response
        response.json().then(function(data) {
          let option;

      	for (let i = 0; i < data.length; i++) {
            option = document.createElement('option');
        	  option.text = data[i].name;
        	  option.value = data[i].name;
        	  dropdownprov.add(option);
      	}
        });
      }
    )
    .catch(function(err) {
      console.error('Fetch Error -', err);
    });


  $(document).ready(function () {
    $('#showprovincias').hide();
    $("#paises").change(function () {
        var val = $(this).val();
        if (val == "Argentina") {
          $('#showprovincias').show();
        }
    });
});
