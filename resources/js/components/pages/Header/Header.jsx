import React from 'react';
import { Link } from 'react-router-dom';


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
            <div>
              <header>
                <nav className="navbar navbar-expand-lg navbar-dark fixed-top d-flex justify-content-between">
                  <Link className="navbar-brand" to="/">
                    <div>
                      <div className="logo-container">
                        <div className="single">
                          S
                        </div>
                        <div className="riders">
                          R
                        </div>
                      </div>
                    </div>
                    </Link>
                  {/*<!--<?php if (!isset($usuariologin)): ?>*/}
                  {this.state.email == ''?

                  <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                  </button>


                  :

                  <div className="d-none d-sm-inline-block" id="loguerla">
                    <h2>Single Riders</h2>
                  </div>

                  }

                  {/*<?php endif; ?>
                  <?php if (isset($usuariologin)): ?>*/}

                  {/*<?php endif; ?>
                  <?php // NOTE: Navbar no logueado ?>
                  <?php if (!isset($usuariologin)): ?>*/}
                  {
                    this.state.email == '' && !this.props.userLogged ?
                    <div className="collapse navbar-collapse" id="navbarNav">
                      <ul className="navbar-nav">
                        <li className="nav-item">
                          <Link className="nav-link" to="/">Home<span className="sr-only">(current)</span></Link>
                        </li>
                        <li className="nav-item">
                          <Link className="nav-link" to="/login">Faqs</Link>
                        </li>
                        <li className="nav-item">
                          {/*<a className="nav-link" href="login.php">Login</a>*/}

                            <Link className="nav-link" to="/login">Login</Link>

                        </li>
                        <li className="nav-item">
                          {/*<a className="nav-link" href="registro.php">Registro</a>*/}
                          <Link className="nav-link" to="/Registro">Registro</Link>
                        </li>
                      </ul>
                    </div>
                    :

                    <div className="dropdown">
                      <button className="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {/*<?=$usuariologin['nombre']; ?>*/}
                      {this.state.nombre}
                      </button>
                      <div className="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a className="dropdown-item" href="editar_perfil.php">Editar Perfil</a>
                      <a className="dropdown-item" href="home.php">Mis Viajes</a>

                      <a className="dropdown-item" href="faqs.php">faqs</a>

                      <a className="dropdown-item" onClick={this.logout}>Cerrar sesión</a>
                      </div>
                    </div>


                  }

                  {/*<?php endif; ?>

                  <?php // NOTE: navbar logueado ?>
                  <?php if (isset($usuariologin)): ?>*/}

                  {/*<?php endif; ?>-->*/}
                </nav>
              </header>
            </div>


        );
    }
}
