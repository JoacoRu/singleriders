$(document).ready(function(){
  $('ul.tabs li a:first').addClass('active');
  $('.secciones article').hide();
  $('.secciones article:first').show();

  $('ul.tabs li a ').click(function(){
    $('ul.tabs li a').removeClass('active');
    $(this).addClass('active');
    $('.secciones article').hide();

    var activeTab = $(this).attr('href');
    $(activeTab).show();
    return false;
  });

  let dropdown = document.querySelector('select[name="country"]');
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

});
