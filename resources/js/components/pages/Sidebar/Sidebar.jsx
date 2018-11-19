import React from 'react';

import { Redirect } from 'react-router-dom';


export default class Siderbar extends React.Component {
    constructor (props){
        super(props);
        this.state = {  text:"",
                        redirect: false,

                      };


    }

    setRedirect = () => {
     this.setState({
       redirect: true
     })
    }

    renderRedirect = () => {
    if (this.state.redirect) {
      //return <Redirect to='/about' />
      return <Redirect to='/home' />
    }
   }



    render(){
        return (

              <div className="col-12 pt-4 col-md-4 col-lg-3 ml-lg-2 d-flex flex-column justify-content-flex-start align-items-center">
                <div className="row w-100 pt-2">
                  <ul className="d-block list-unstyled w-100 py-4 border rounded shadow-perfil">
                    <li className="text-center"><img style={{maxWidth: '150px'}} className="border rounded-circle" src={'http://localhost:8000/images/'+this.props.imgperfil} alt="" id="foto-perfil"/></li>
                    <li className="text-center mt-3"><a className="btn btn-outline-secondary" href="editar_perfil.php"><img src="images/iconos/home/editar.png" alt=""/> <span className="mb-1">Editar perfil</span></a></li>
                  </ul>
                </div>
                <div className="row justify-content-center">
                  <ul className="d-block list-unstyled mt-4 text-center p-3 border navegacion-perfil">

                    <li className="d-flex align-items-center mb-2"><span className="fa fa-home"></span> <a className="mt-1" href="home.php">Home</a></li>
                    <li className="d-flex align-items-center mb-2"><img className="mr-1" src="./images/iconos/home/crear_viaje.png" alt=""/><a href="crea2.php">Crear Viaje</a></li>
                    <li className="d-flex align-items-center mb-2"><img className="mr-1" src="./images/iconos/home/ver_mis_viajes.png" alt=""/><a className="mt-1" href="mis_viajes.php">Ver mis Viajes</a></li>
                    <li className="d-flex align-items-center mb-2"><img className="mr-1" src="./images/iconos/home/ver_mis_viajes.png" alt=""/><a href="viajes.php">Todos los Viajes</a></li>
                    <li className="d-flex align-items-center mb-2"><img className="mr-1" style={{width:'24px',height:'24px'}} src="./images/iconos/home/sobre.png" alt=""/><a href="mensajes.php">Ver mis Mensajes</a></li>
                  </ul>
                </div>
              </div>



        );
    }
}
