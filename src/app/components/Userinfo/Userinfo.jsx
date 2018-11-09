import React from 'react'
export default class UserInfo extends React.Component {
    constructor (props){
        super(props);

    }



// {...this.props} quiere decir que puede recibir html 

    render(){
    	let user = this.props.user;
        return (
            <div className="Userinfo">
            {
            user ? (
            	<div>
            	<div>Email: {user.email}</div>
            	<div>Tel: {user.phone}</div>
            	<div>Nombre: {user.name}</div>
            	<div>Usuario: {user.username}</div>
            	<div>Ciudad: {user.address.city}</div>
            	<div>Calle: {user.address.street}</div>
            	<div>Empresa: {user.company.name}</div>
            	
            	</div>
            ) : (<div>Cargando...</div>)
            
        	}
            </div>

                  
        );
    }
}