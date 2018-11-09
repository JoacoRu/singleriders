import React from 'react'
export default class Root extends React.Component {
    constructor (props){
        super(props);

    }



// {...this.props} quiere decir que puede recibir html 

    render(){
        return (
            <div className="Root" {...this.props} />

                  
        );
    }
}

