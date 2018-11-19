

    <header>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top <?= isset(Auth::user()->name) ? 'd-flex justify-content-between' : '' ?>">
        <a class="navbar-brand" href="index.php">
          <div>
            <div class="logo-container">
              <div class="single">
                S
              </div>
              <div class="riders">
                R
              </div>
            </div>
          </div>
        </a>
        @guest
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        @endguest
        @guest
        <div></div>
        @else
        <div class="d-none d-sm-inline-block" id="loguerla">
          <h2>Single Riders</h2>
        </div>
        @endguest
        <?php // NOTE: Navbar no logueado ?>
        @guest
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item <?= strpos($_SERVER['REQUEST_URI'], 'index.php') > -1  ? 'active' : ''  ?>">
                <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item <?= strpos($_SERVER['REQUEST_URI'], 'faqs.php') > -1  ? 'active' : ''  ?>">
                <a class="nav-link" href="faqs.php">Faqs</a>
              </li>
              <li class="nav-item <?= strpos($_SERVER['REQUEST_URI'], 'login.php') > -1  ? 'active' : ''  ?>">
                <a class="nav-link" href="login.php">Login</a>
              </li>
              <li class="nav-item <?= strpos($_SERVER['REQUEST_URI'], 'registro.php') > -1  ? 'active' : ''  ?>">
                <a class="nav-link" href="registro.php">Registro</a>
              </li>
            </ul>
          </div>
        @endguest

        <?php // NOTE: navbar logueado ?>
        @guest
          <div>
          </div>
        @else
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="editar_perfil.php">Editar Perfil</a>
            <a class="dropdown-item" href="home.php">Mis Viajes</a>
            <!--<a class="dropdown-item" href="#">Cambiar Cuenta</a>-->
            <a class="dropdown-item" href="faqs.php">faqs</a>


            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Cerrar sesión') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </div>
          </div>
       @endguest
      </nav>
    </header>
