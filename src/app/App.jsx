import React from 'react';
import Main from './layout/Main';
import Sidebar from './layout/Sidebar';
import Header from './layout/Header';
import Principal from './layout/Principal';
import Root from './layout/Root';
import About from './pages/About/About';
import Contact from './pages/Contact/Contact';
import Login from './pages/Login/Login';
import Userinfo from './components/Userinfo/Userinfo'
import {BrowserRouter as Router, Route, Link} from 'react-router-dom';

export default class App extends React.Component {
    constructor (props){
        super(props);
        this.state = {
        	users:null
        }

    }

    componentWillMount(){

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
        		<Router history={true}>
	        		<Root>
	        			<Header className="mt-5">

	        			 </Header>

	        			 <Main className="pt-2">
	        			 	<Route path="/" exact={true} component={Principal}
	        			 	/>
	        			 	<Route path="/u/:userId" render={
	        			 				({ match }) => {
	        			 				return (<Userinfo user={users.find(u => u.id == match.params.userId)}/>);
	        			 			}
	        			 		}
	        			 	/>
	        			 	<Route path="/about" exact={true} component={About}

	        			 	/>
	        			 	<Route path="/contact" exact={true} component={Contact}

	        			 	/>

                  <Route path="/login" exact={true} component={Login}

	        			 	/>

	        			 </Main>
	        		</Root>
	        	</Router>
            </div>

        );
    }
}

/*

<Sidebar>
 <ul>
   {
     users ? (

         users.map((user,index) => {

           return(<li key={index}><Link to={`/u/${user.id}`}>{user.name}</Link></li>)
         })
       ) : (<li>Cargando...</li>)
   }
   <li><Link to="/about">About</Link></li>
   <li><Link to="/contact">Contact</Link></li>
 </ul>
</Sidebar>

*/
