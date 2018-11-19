import React from 'react'
export default class Contact extends React.Component {
    constructor (props){
        super(props);

    }



// {...this.props} quiere decir que puede recibir html 

    render(){
        return (
            <div className="Contact">
            Podés contactarnos desde el siguiente formulario:
            </div>

                  
        );
    }
}