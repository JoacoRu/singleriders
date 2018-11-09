import React from 'react'
export default class Test extends React.Component {
    constructor (props){
        super(props);
        this.state = {
            color0:'white',
            color1:'orange'
            
        }
    }

    render(){
        return (
            <div style={{backgroundColor:this.state.color1, color:this.state.color0, textAlign:'center',padding:'10px'}}>
                Hola mundo!
            </div>
        );
    }
}