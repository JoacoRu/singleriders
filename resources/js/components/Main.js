import React from 'react';
import ReactDOM from 'react-dom';
import Sidebar from './layout/Sidebar';
import Header from './pages/Header/Header';
import Principal from './layout/Principal';
import Root from './layout/Root';
import About from './pages/About/About';
import Contact from './pages/Contact/Contact';
import Login from './pages/Login/Login';
import Home from './pages/Home/Home';
import { Switch } from 'react-router';
import { BrowserRouter, Route, Link } from 'react-router-dom';

export default class Main extends React.Component {
    constructor (props){
        super(props);
        this.state = {
        	users:null,
          loggedIn:false
        }

    }

    handleLogin = (loginValue) => {
        this.setState({loggedIn: loginValue});
    }

    componentWillMount(){
      let token = localStorage.getItem('sr_token');
      //console.log('Token',token);
    	fetch('https://jsonplaceholder.typicode.com/users')
    	.then(users => users.json())
    	.then(users => {
    		this.setState(
    		{
    			users:users
    		})
    		console.log(this.state.users)

    	})


    }

    render(){
    	let users= this.state.users;
        return (
        	<div>
            <BrowserRouter basename={'/react'}>

              <Root>

	        			<Header className="mb-5" userLogged={this.state.loggedIn} onChangeLogin={this.handleLogin}>

	        			</Header>


                  <Switch>

  	        			 	<Route path="/welcome" exact component={Principal}
  	        			 	/>
  	        			 	<Route path="/u/:userId" render={
  	        			 				({ match }) => {
  	        			 				return (<Userinfo user={users.find(u => u.id == match.params.userId)}/>);
  	        			 			}
  	        			 		}
  	        			 	/>
  	        			 	<Route path="/about" exact component={About}

  	        			 	/>
  	        			 	<Route path="/contact" exact component={Contact}

  	        			 	/>

                    <Route path="/login" exact render={
                        ()=> {
                          return (<Login onChangeLogin={this.handleLogin}/>)
                        }
                     }

  	        			 	/>

                    <Route path="/home" exact render={
                        ()=> {
                          return (<Home userLogged={this.state.loggedIn}/>)
                        }
                     }

	        			 	  />

                  </Switch>



	        		</Root>

            </BrowserRouter>

          </div>

        );
    }
}

if (document.getElementById('root')) {
    ReactDOM.render(<Main />, document.getElementById('root'));
}
