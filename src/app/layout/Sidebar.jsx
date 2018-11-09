import React from 'react'
export default class Sidebar extends React.Component {
    constructor (props){
        super(props);

    }



// {...this.props} quiere decir que puede recibir html 

    render(){
        return (
            <div className="Sidebar" style={styles}>
            <h2>Menú</h2>
            <div {...this.props} />
            </div>
        );
    }
}

const styles= {

    width:'15%',
    float:'left'
}