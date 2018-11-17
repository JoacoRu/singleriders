import React from 'react';
import { Redirect } from 'react-router-dom';


export default class Header extends React.Component {
    constructor (props){
        super(props);
        this.state = {

                        email:'',
                        nombre:'',
                        apellido:'',
                        imgPerfil:''
                      };
    }


   componentWillReceiveProps(){
     this.validateUser();
   }

   componentWillMount(){
     this.validateUser();
   }

   validateUser = () => {
         let token = localStorage.getItem('sr_token');
         console.log('verificando user');
         if (token) {
           fetch('http://localhost:8000/api/auth/user', {
             method: "GET",
             headers: {
               "Accept": "application/json",
               "Authorization": `Bearer ${token}`
             },
             //credentials: "same-origin"
           }).then(response => { return response.json()})
             .then(responseData => {
               console.log(responseData);

               if (responseData.email) {
                 this.setState({
                   email:responseData.email,
                   nombre:responseData.name,
                   apellido:responseData.surname,
                   imgPerfil:responseData.profile_picture,
                 })
               }
               //return responseData;
             })
             .catch(err => {
                 console.log("fetch error" + err);
             });
         }
   }

   logout = () => {
     let token = localStorage.getItem('sr_token');
     console.log('verificando user');
     fetch('http://localhost:8000/api/auth/logout/', {
       method: "GET",
       headers: {
         "Accept": "application/json",
         "Authorization": `Bearer ${token}`
       },
       //credentials: "same-origin"
     }).then(response => { return response.json()})
       .then(responseData => {
         console.log(responseData);

         if (responseData.message == 'Deslogueo ok') {
           this.setState({
             email:'',
             nombre:'',
             apellido:'',
             imgPerfil:'',
           });
           this.props.onChangeLogin(false);
         }

         //return responseData;
       })
       .catch(err => {
           console.log("fetch error" + err);
       });
   }





    render(){
        return (
          <section className="container-fluid">
          <div className="titulos">
            <div className="row">
              <div className= "col-12">
                <h1>CREA EL VIAJE DE TUS SUEÑOS</h1>
                <h3>Compartilo en linea con todos los viajeros</h3>
              </div>
              </div>
          </div>
          <div className="wrap">
            <div className="row">
              <div className= "col-12">
                <ul className="tabs">
                  <li><a href="#tab1"><span className="fa fa-info"></span><span className="tab-text">Info General</span></a></li>
                  <li><a href="#tab2"><span className="fa fa-map-marked-alt"></span><span className="tab-text">Destinos</span></a></li>
                  <li><a href="#tab3"><span className="fa fa-dollar-sign"></span><span className="tab-text">Presupuesto</span></a></li>
                  <li><a href="#tab4"><span className="fa fa-edit"></span><span className="tab-text">Itinerario de tu viaje </span></a></li>
                </ul>
                  <div className="secciones">
                  <article id="tab1">
                    <form method="post" enctype="multipart/form-data">
      
                      <input type="text" id="textmensaje" onkeyup="$('#mensaje').text($('#textmensaje').val());" className="form-control" name="textmensaje" value="<?=$textmensaje?>" placeholder="Ponele un Titulo a tu viaje..."></textarea>
                      {/*<?php if (isset($errores['textmensaje'])):?>
                        <p><?= $errores['textmensaje'] ?></p>
                        <?php endif; ?>*/}
      
                    <div className="d-flex flex-column flex-md-row align-items-md-center mt-2">
                      Partida: <input className="ml-2 mr-4" type="date" name="datein" value="<?=$datein?>">
                      Regreso: <input className="ml-2 mr-4" type="date" name="dateout" value="<?=$dateout?>"><br></br>
                      {/*<?php if (isset($errores['datein'])):?>
                          <p><?= $errores['datein']?></p>
                        <?php endif;?>
                        <?php if (isset($errores['dateout'])):?>
                            <p><?= $errores['dateout']?></p>
                          <?php endif;?>*/}
                    </div>
                    <label for="inlineRadioOptions"> ¿Tus Fechas son flexibles?</label><br></br>
                    <div className="form-check form-check-inline">
                      <input className="form-check-input" type="radio" name="inlineRadioOptions" id="infoGeneral" value="option1">
                      <label className="form-check-label" for="inlineRadio1">Si, seguro!</label>
                    </div>
                    <div className="form-check form-check-inline">
                      <input className="form-check-input" type="radio" name="inlineRadioOptions" id="infoGeneral" value="option2">
                      <label className="form-check-label" for="inlineRadio2">Lo podemos Charlar!</label>
                    </div>
                    <div className="form-check form-check-inline">
                      <input className="form-check-input" type="radio" name="inlineRadioOptions" id="infoGeneral" value="option3">
                      <label className="form-check-label" for="inlineRadio3">No puedo mover las fechas</label>
                    </div>
                  </article>
                    <article id="tab2">
                      <label for="pais">¿Adonde queres ir?</label>
                      <select className="form-control" name="pais">
                        {/*<?php if (isset($errores['pais'])):?>
                            <p><?= $errores['pais']?></p>
                          <?php endif;?>
                        <option value="">Selecciona el país a visitar</option>
                        <?php foreach ($paises as $key => $value) :?>
                            <option value="<?= $value['pais'] ?>"><?= $value['pais'] ?></option>
                        <?php endforeach ?>*/}
                      </select>
      
      
                      {/*<!--<select className="form-control" name="ciudad">
                        <option value="">Selecciona la ciudad a visitar</option>
                        {/*<?php foreach ($ciudades as $key => $value) :?>
                            <option value="<?= $value['ciudad'] ?>"><?= $value['ciudad'] ?></option>
                        <?php endforeach ?>
                      </select>-->*/}
                      <label for="actividades">¿Que tipo de viaje queres hacer?</label>
                      <select className="custom-select" size="3">
                        <option value="1">Aventura</option>
                        <option value="2">Impacto Social</option>
                        <option value="3">Relax y playa</option>
                        <option value="2">Proyectos Ecológcos</option>
                        <option value="3">Relax y playa</option>
                      </select>
                    </article>
                    <article id="tab3">
                      <div className="card-body">
                        <div className="input-group mb-3">
                          <div className="input-group-prepend">
                            <span className="input-group-text">Importe</span>
                            {/*<?php if (isset($errores['importe'])):?>
                                <p><?= $errores['importe']?></p>
                      <?php endif;?>*/}
                            </div>
                            <input type="text" className="form-control" name="importe"  aria-label="Amount (to the nearest dollar)">
                            <div className="input-group-append">
                              <span className="input-group-text">.00</span>
                            </div>
                          </div>
                            <div className="input-group mb-3">
                              <div className="input-group-prepend">
                              <span className="input-group-text">Moneda</span>
                              {/*<?php if (isset($errores['moneda'])):?>
                                  <p><?= $errores['moneda']?></p>
                    <?php endif;?>*/}
                              </div>
                              <input type="text" className="form-control" name="moneda"  aria-label="Amount (to the nearest dollar)">
                            </div>
                          </div>
                    </article>
                    <article id="tab4">
                      <div className="card-body">
                        <div className="input-group mb-3">
                          <div className="input-group-prepend">
                            <label className="input-group-text" for="inputGroupSelect01">Dia 1</label>
                          </div>
                          <select className="custom-select" name="ciudad">
                          </select>
                        </div>
                        <div className="descripcion">
                          <textarea id="descripcion" className="form-control" name="mensajeiti" placeholder="Que vas a hacer en esta ciudad?..."></textarea>
                        </div>
                        <input type="submit" className="btn btn-primary" value="Guarda Tu Viaje">
                      </div>
                    </article>
                    <article id="tab3">
      
                    </article>
      
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div className="card-deck">
      <div className="card">
        <img className="card-img-top" src="images/crea/america.jpeg" alt="Card image cap">
        <div className="card-body">
          <h5 className="card-title">America Del Sur</h5>
          <p className="card-text">Desde los picos nevados de los Andes a los extensos ríos de la región del Amazonas, el sur de América tiene una larga lista de maravillas naturales para todos los gustos</p>
        </div>
        <div className="card-footer">
          <small className="text-muted">Conoce los mejores destinos</small>
        </div>
      </div>
      <div className="card">
        <img className="card-img-top" src="images/crea/beach.jpg" alt="Card image cap">
        <div className="card-body">
          <h5 className="card-title">Caribe</h5>
          <p className="card-text">El Caribe es definitivamente  un lugar que es sinónimo de hermosas imágenes de arenas blancas, aguas turquesa, cocteles, sol brillante y mucho relax. Aunque estas son las palabras que lo describen en su mayoría, las islas caribeñas ofrecen mucho más de lo que puedas imaginar.</p>
        </div>
        <div className="card-footer">
          <small className="text-muted">Conoce los mejores destinos</small>
        </div>
      </div>
      <div className="card">
        <img className="card-img-top" src="images/crea/eeuu.jpeg" alt="Card image cap">
        <div className="card-body">
          <h5 className="card-title">America del Norte</h5>
          <p className="card-text">Sus ciudades desvelan arquitecturas de una modernidad sin igual que se encuentran a tan solo unas horas de los paisajes más salvajes, en los que puedes vivir aventuras en tu tienda de campaña o con la mochila a la espalda rodeado de una naturaleza muy bien conservada.</p>
        </div>
        <div className="card-footer">
          <small className="text-muted">Conoce los mejores destinos</small>
        </div>
      </div>
      <div className="card">
        <img className="card-img-top" src="images/crea/europa.jpeg" alt="Card image cap">
        <div className="card-body">
          <h5 className="card-title">Europa</h5>
          <p className="card-text">A algunos les atrae su historia, la multiplicidad de culturas en un mismo espacio, las bellezas naturales, la facilidad para el transporte, la amplia y variada oferta de alojamiento, la arquitectura, las playas, las compras.</p>
        </div>
        <div className="card-footer">
          <small className="text-muted">Conoce los mejores destinos</small>
        </div>
      </div>
      <div className="card">
        <img className="card-img-top" src="images/crea/resto.png" alt="Card image cap">
        <div className="card-body">
          <h5 className="card-title">Resto</h5>
          <p className="card-text">Viajar a un destino exótico es conocer un nuevo país, una nueva cultura, nuevas costumbres y tradiciones, ajenas a lo ya explorado. Elegir un viaje no es una decisión fácil, pero es preferible distanciarnos de lo cotidiano, abrir nuestras mentes y disfrutar de las riquezas de una novedosa excursión..</p>
        </div>
        <div className="card-footer">
          <small className="text-muted">Conoce los mejores destinos</small>
        </div>
      </div>
      </div>
      
          </section> 
        );
    }
}
