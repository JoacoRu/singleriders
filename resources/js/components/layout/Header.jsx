import React from 'react'
export default class Header extends React.Component {
    constructor (props){
        super(props);

    }



// {...this.props} quiere decir que puede recibir html 

    render(){
        return (
            <div className="Header">
                <h1 {...this.props} />
            </div>
        );
    }
}