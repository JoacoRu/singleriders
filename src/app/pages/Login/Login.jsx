import React from 'react'
export default class Login extends React.Component {
    constructor (props){
        super(props);
        this.state={ email:"", pwd:""};
        this.userLogin = this.userLogin.bind(this);

    }


    userLogin(){
          //event.preventDefault();
          console.log('logueando');
          console.log(this.state.email);
          let databody = {
            "email": this.state.email,
            "password": this.state.pwd
          };
          fetch('http://localhost:8000/api/auth/login', {
            method: "POST",
            body: JSON.stringify(databody),
            headers: {
              "Content-Type": "application/json",
              "X-Requested-With": "XMLHttpRequest"
            },
            //credentials: "same-origin"
          }).then(response => { return response.json();})
            .then(responseData => {console.log(responseData); return responseData;})
            /*.then(data => {

              console.log(data);

            })*/

            .catch(err => {
                console.log("fetch error" + err);
            });
    }



// {...this.props} quiere decir que puede recibir html

    render(){
        return (
            <div>
              <section className="ingresar mt-5">
                <div className="container-fluid">
                  <div className="row justify-content-center">
                    <div className="col-10 col-lg-5 bg-white p-4 mt-5 rounded shadow">
                      <h1 className="titulo-sr-home text-center mb-4"><span className="single-f mr-2">Single</span><span className="single-f">Riders</span></h1>
                      <div className="dropdown-divider mb-4 mt-4 ml-3 mr-3"></div>
                      <ul className="nav nav-tabs" role="tablist">
                        <li className="nav-item">
                          <a className="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Ingresá</a>
                        </li>
                        <li className="nav-item">
                          <a className="nav-link" id="registro-tab" href="registro.php" aria-selected="false">Registrate</a>
                        </li>
                      </ul>
                      <div className="card border-top-0 rounded-0 bottom-radius">
                        <div className="car-body">
                          <div className="container mt-3">
                            <div className="row">
                              <div className="col-12">
                                <div className="tab-content">
                                  <div className="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                    <form method="post" encType="multipart/form-data">
                                      <div className="form-label-group">
                                        <input name="email" id="useremail" aria-describedby="useremailHelp" type="text" placeholder="Correo electrónico" value={this.state.email} onChange={(ev)=>this.setState({email:ev.target.value})} className="form-control"/>
                                        <label for="useremail">Email</label>

                                          <small id="useremailHelp" className="form-text text-danger"></small>

                                      <div className="form-label-group">
                                        <input name="password" id="userpassword" aria-describedby="userpasswordHelp" type="password" value={this.state.pwd} onChange={(ev)=>this.setState({pwd:ev.target.value})} placeholder="Contraseña" className="form-control"/>
                                        <label for="userpassword">Contraseña</label>
                                        {/*<?php if (isset($errores['password'])): ?>
                                          <small id="userpasswordHelp" className="form-text text-danger"><?= $errores['password'] ?></small>
                                        <?php endif; ?>*/}
                                      </div>
                                      <div className="container">
                                        <div className="row flex-column flex-md-row justify-content-md-between align-items-md-center">
                                          <div onClick={this.userLogin} className="btn btn-primary iniciar mb-3 mb-md-0">Iniciar sesión</div>
                                          <a className="text-center text-md-left" href="#">¿Olvidaste tu contraseña?</a>
                                        </div>
                                        <div className="row mt-3">
                                          <label>
                                            <input type="checkbox" value="1" name="recordarme" checked="checked"/>
                                              Recordarme
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                    </form>
                                  </div>
                                  <div className="tab-pane fade" id="registro" role="tabpanel" aria-labelledby="profile-tab">
                                    {
                                      /*
                                      <form method="post" enctype="multipart/form-data">
                                        <div className="form-group">
                                          <input type="text" name="nombre" className="form-control" aria-describedby="nombreHelp" placeholder="Nombre"/>
                                        </div>
                                        <div className="form-group">
                                          <input type="text" name="apellido" className="form-control" aria-describedby="apellidoHelp" placeholder="Apellido"/>
                                        </div>
                                        <div className="form-group">
                                          <input name="email" type="email" className="form-control" aria-describedby="emailHelp" placeholder="Correo electrónico"/>
                                        </div>
                                        <div className="form-group">
                                          <input name="password" type="password" className="form-control" placeholder="Contraseña"/>
                                        </div>
                                        <div className="container">
                                          <div className="row flex-column flex-md-row justify-content-md-between align-items-md-center">
                                            <button type="submit" className="btn btn-primary iniciar mb-3 mb-md-0">Registrate</button>
                                          </div>
                                          <div className="row mt-3">
                                          </div>
                                        </div>
                                      </form>
                                      */
                                    }
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <article className="mt-4 objetive">
                        <div className="card">
                          <div className="card-body">
                            <div className="container">
                              <div className="row">
                                <div className="col-12 col-sm-6 text-center features-sr overbuttons" onClick="$('.card-viajes').collapse('hide');$('#collapsebuscar').collapse('toggle')">
                                  <div>
                                    Buscá
                                    <i className="fa fa-search"></i>
                                  </div>
                                  <i className="fa fa-angle-down"></i>
                                </div>
                                <div className="col-12 col-sm-6 text-center features-sr overbuttons" onClick="$('.card-viajes').collapse('hide');$('#collapsecrear').collapse('toggle')">
                                  <div>
                                    Creá
                                    <i className="fa fa-plus"></i>
                                  </div>
                                  <i className="fa fa-angle-down"></i>
                                </div>
                              </div>
                            </div>
                            <div className="container">
                              <div className="row">
                                <div className="col-12 obj-viajes text-uppercase text-center p-1 font-weight-bold">
                                  viajes
                                  <i className="fa fa-suitcase"></i>
                                  <div className="collapse card-viajes" id="collapsebuscar">
                                    <div className="card card-body border-0">
                                      Buscá: Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                  </div>
                                  <div className="collapse card-viajes" id="collapsecrear">
                                    <div className="card card-body border-0">
                                      Creá: Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                  </div>
                                  <div className="collapse card-viajes" id="collapseunirse">
                                    <div className="card card-body border-0">
                                      Unite: Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                  </div>
                                  <div className="collapse card-viajes" id="collapsecompartir">
                                    <div className="card card-body border-0">
                                      Compartí: Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div className="container">
                              <div className="row">
                                <div className="col-12 col-sm-6 text-center features-sr overbuttons" onClick="$('.card-viajes').collapse('hide');$('#collapseunirse').collapse('toggle')">
                                  <i className="fa fa-angle-up"></i>
                                  <div>
                                    Unite
                                    <i className="far fa-hand-pointer"></i>
                                  </div>
                                </div>
                                <div className="col-12 col-sm-6 text-center features-sr overbuttons" onClick="$('.card-viajes').collapse('hide');$('#collapsecompartir').collapse('toggle')">
                                  <i className="fa fa-angle-up"></i>
                                  <div>
                                    Compartí
                                    <i className="fa fa-share-alt"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </article>
                    </div>
                  </div>
                </div>
              </section>
            </div>


        );
    }
}
