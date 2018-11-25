
  <div class="col-12 pt-4 col-md-4 col-lg-3 ml-lg-2 d-flex flex-column justify-content-flex-start align-items-center">
    <div class="row w-100 pt-2">
      <ul class="d-block list-unstyled w-100 py-4 border rounded shadow-perfil">
        <li class="text-center"><img style="max-width: 150px;" class="border rounded-circle" src="#" alt="" id="foto-perfil"></li>
        <li class="text-center mt-3"><a class="btn btn-outline-secondary" href="{{ 'edit_profile' }}"><img src="images/iconos/home/editar.png" alt=""> <span class="mb-1">Editar perfil</span></a></li>
      </ul>
    </div>
    <div class="row justify-content-center">
      <ul class="d-block list-unstyled mt-4 text-center p-3 border navegacion-perfil">
  
        @if(Request::path() == 'profile')
    
        @else
          <li class="d-flex align-items-center mb-2"><span class="fa fa-home"></span> <a class="mt-1" href="{{'profile'}}">Mi Perfil</a></li>
        @endif

        <li class="d-flex align-items-center mb-2"><img class="mr-1" src="./images/iconos/home/crear_viaje.png" alt=""><a href="{{'travel'}}">Crear Viaje</a></li>

        @if(Request::path() == 'myTravel')

        @else
          <li class="d-flex align-items-center mb-2"><img class="mr-1" src="./images/iconos/home/ver_mis_viajes.png" alt=""><a class="mt-1" href="{{'myTravel'}}">Ver mis Viajes</a></li>
        @endif

        @if(Request::path() == 'allTravel')

        @else
          <li class="d-flex align-items-center mb-2"><img class="mr-1" src="./images/iconos/home/ver_mis_viajes.png" alt=""><a href="{{'allTravel'}}">Todos los Viajes</a></li>
        @endif

        @if(Request::path() == 'messages')

        @else
          <li class="d-flex align-items-center mb-2"><img class="mr-1" style="width:24px;height:24px;" src="./images/iconos/home/sobre.png" alt=""><a href="{{'mensajes'}}">Ver mis Mensajes</a></li>
        @endif

        @if(Request::path() == 'sharedTravel')

        @else
          <li class="d-flex align-items-center mb-2"><img class="mr-1" style="width:24px;height:24px;" src="./images/iconos/home/ver_mis_viajes.png" alt=""><a href="{{'sharedTravel'}}">Viajes Compartidos</a></li>
        @endif

      
      </ul>
    </div>
  </div>
