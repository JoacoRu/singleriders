import React from 'react'
export default class Main extends React.Component {
    constructor (props){
        super(props);

    }



// {...this.props} quiere decir que puede recibir html

    render(){
        return (
            <div className="Main" style={styles} {...this.props} />
        );
    }
}

const styles= {

    width:'100%'
}
