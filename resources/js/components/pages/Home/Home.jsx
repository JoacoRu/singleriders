import React from 'react';
//import style from './home.css';
import { Redirect } from 'react-router-dom';
import Sidebar from '../Sidebar/Sidebar';

export default class Home extends React.Component {
    constructor (props){
        super(props);
        this.state = {  email:'',
                        pwd:'',
                        redirect: false,
                        errorPwd:false,
                        errorEmail:false,
                        pwValidationText:'',
                        emailValidationText:'',
                        nombre:'',
                        apellido:'',
                        imgPerfil:''
                      };
        //this.userLogin = this.userLogin.bind(this);

    }

    setRedirect = () => {
     this.setState({
       redirect: true
     })
    }

    renderRedirect = () => {

    if (this.state.redirect) {
      //return <Redirect to='/about' />
      return <Redirect to='/login' />
    }
   }


   componentWillMount(){
     this.validateUser();
   }


   componentWillReceiveProps(){
     this.validateUser();
   }



      validateUser = () => {

            let token = localStorage.getItem('sr_token');
            if(!token){
              this.setRedirect();
            }
            //console.log('verificando user');
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
                      redirect: false,
                      email:responseData.email,
                      nombre:responseData.name,
                      apellido:responseData.surname,
                      imgPerfil:responseData.profile_picture,
                    })
                  }else {
                    this.setState({
                      redirect: true,
                      email:'',
                      nombre:'',
                      apellido:'',
                      imgPerfil:'',
                    })
                  }
                  //return responseData;
                })
                .catch(err => {
                    console.log("fetch error" + err);
                    this.setState({
                      redirect: true
                    })
                });
            }
      }


    render(){
        return (
            <div>
              {this.renderRedirect()}
              <section className="mt-5 section">
                <div className="container-fluid pt-5">
                  <div className="row p-0 m-0 bg-white rounded home-row-main justify-content-center">
                    <div className="col-12 p-0 top-muro-image d-flex align-items-center justify-content-center">
                      <h1 className="font-weight-bold text-center">Muro</h1>
                    </div>
                    <Sidebar imgperfil={this.state.imgPerfil}></Sidebar>
                    {/*<?php require_once('lateral_izquierdo.php'); ?>

                <!-- CREAR UN POST HTML -->*/}

              <div className="col-12 p-10 pt-4 col-md-8">
                <article className="posteo_crear col-12 p-10 pt-4 col-md-8">
                  <div className="publicacion rounded">
                      <div className="publicacion_imagen">
                        {/*<img style="max-width: 30px;" className="border rounded-circle" src=".<?=$usuariologin['srcImagenperfil']?>" alt="" id="foto-perfil">*/}
                        <form method="get" className="d-flex flex-column justify-content-center align-items-center pl-2">
                          <textarea name="posteo" rows="10" placeholder="¿Que estas pensado?" style={{resize: 'none',border: '1px solid lightgrey'}}></textarea>
                          <button type="submit" className="mt-3" id="boton_end">Publicar</button>

                        </form>
                      </div>
                  </div>
                </article>

                {/*<!-- POSTEO HTML -->
                      <?php foreach ($postRealizados as $key => $value) : ?>
                            <?php if($value['user_id'] == $_SESSION['id']) : ?>*/}

                              <div className="col-12 p-10 pt-4 col-md-8">
                                <article className="articulo_post">
                                  <div className="posteos_card">
                                    <div className="datos_post">
                                      {/*<img style="max-width: 30px;" className="border rounded-circle" src=".<?=$usuariologin['srcImagenperfil']?>" alt="" id="foto-perfil">*/}
                                      {/*<p><?= $usuariologin['nombre'] ?></p>*/}
                                    </div>
                                    <div className="contenido_post">
                                      {/*<p><?php echo $value['post'] ?></p>*/}
                                    </div>
                                    <div className="post_interaccion">
                                      <label htmlFor="me_gusta">Me gusta</label>
                                      <img src="images/iconos/interaccion_posteo/me-gusta_no_seleccionado.png" alt="" name="me_gusta"/>
                                      <label htmlFor="comentar">Comentar</label>
                                      <img src="images/iconos/interaccion_posteo/comentario.png" alt="" name="comentar"/>
                                    </div>
                                  </div>
                                </article>
                              </div>
                            {/*<?php endif;?>
                        <?php endforeach;?>*/}
                      </div>
                    </div>
                </div>
              </section>
            </div>


        );
    }
}
