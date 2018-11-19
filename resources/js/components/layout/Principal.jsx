import React from 'react'
export default class Principal extends React.Component {
    constructor (props){
        super(props);

    }



// {...this.props} quiere decir que puede recibir html

    render(){
        return (
          // NOTE: si esta logueado
          <div>
          <div className="home-mod-login pt-5 mt-3 pt-md-5 mt-md-0">
            <a className="mr-1 btn btn-outline-primary">Ingresá</a>
            <a className="ml-1 btn btn-outline-secondary">Registrate</a>
          </div>
          <div className="container-fluid titulo-sr-home pt-2 bg-white">
            <div className="row justify-content-center">
              <div className="text-center mb-4"><span className="single-f mr-2">Single</span><span className="single-f">Riders</span></div>
            </div>
          </div>
          <div className="col-12 p-0 home-carousel">

            <div id="carouselExampleIndicators" className="carousel slide" data-ride="carousel">
              <ol className="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" className="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
              </ol>
              <div className="carousel-inner">
                <div className="carousel-item active">
                  <div className="carousel-caption carousel-caption-top d-none d-md-block">
                    <h2>Red social para viajeros</h2>
                  </div>
                  <img className="d-block w-100" src="./images/home01.png" alt="First slide"/>
                  <div className="carousel-caption d-none d-md-block">
                    <h5><a href="registro.php" className="text-white">Registrate</a></h5>
                    <p>Es gratis!</p>
                  </div>
                </div>
                <div className="carousel-item">
                  <div className="carousel-caption carousel-caption-top d-none d-md-block" style={{top:'45%'}}>
                    <h2>Red social para viajeros</h2>
                  </div>
                  <img className="d-block w-100" src="./images/home05.png" alt="Second slide"/>
                  <div className="carousel-caption d-none d-md-block">
                    <h5><a href="registro.php" className="text-white">Registrate</a></h5>
                    <p>Es gratis!</p>
                  </div>
                </div>
                <div className="carousel-item">
                  <div className="carousel-caption carousel-caption-top d-none d-md-block" style={{top:'45%'}}>
                    <h2>Red social para viajeros</h2>
                  </div>
                  <img className="d-block w-100" src="./images/home06.png" alt="Third slide"/>
                  <div className="carousel-caption d-none d-md-block">
                    <h5><a href="registro.php" className="text-white">Registrate</a></h5>
                    <p>Es gratis!</p>
                  </div>
                </div>
                <div className="carousel-item">
                  <div className="carousel-caption carousel-caption-top d-none d-md-block" style={{top:'45%'}}>
                    <h2>Red social para viajeros</h2>
                  </div>
                  <img className="d-block w-100" src="./images/home07.png" alt="Fourth slide"/>
                  <div className="carousel-caption d-none d-md-block">
                    <h5><a href="registro.php" className="text-white">Registrate</a></h5>
                    <p>Es gratis!</p>
                  </div>
                </div>
              </div>
              <a className="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                <span className="sr-only">Previous</span>
              </a>
              <a className="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span className="carousel-control-next-icon" aria-hidden="true"></span>
                <span className="sr-only">Next</span>
              </a>
            </div>
          </div>
          // NOTE: finsi esta logueado
          <div className="col-12">
            <h3 className="mb-5 mt-5 pt-3 pb-3 text-center">Encontrá compañeros de viaje</h3>
            <ul className="items-home-slider">
              <li>Armá tu viaje</li>
              <li>Compartí tu itinerario</li>
              <li>Contactate con otros viajeros</li>
              <li>Unite a viajes de otros usuarios</li>
            </ul>
          </div>
          <div className="col-12 second-section mt-2">
            <h3 className="mb-5 mt-5 pt-3 pb-3 text-center">Últimos viajes publicados</h3>
            <div className="card-columns">
          // NOTE: php foreach cards
              <div className="card">
                <div className="fondo-card"></div>

                  <img className="card-img-top" src="./images/flags/india.png" alt="Card image cap"/>

                <div className="card-body">
                  <h5 className="card-title text-center"><strong>aca va el texto del viaje</strong></h5>
                  <p className="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
              </div>
              // NOTE: fin php foreach

            </div>
          </div>
          <div className="col-12 mt-2 mb-5">
            <h3 className="mb-5 mt-5 pt-3 pb-3 text-center">Riders en el mundo</h3>
            <div className="container-fluid">
              <div id="map">
              </div>
            </div>
          </div>
          </div>
        );
    }
}
