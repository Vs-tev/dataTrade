import React, { useState } from 'react'
import Item from './Item'
import Navbar from './Navbar'
import About from './About'
import Login from './Login'
import itemDetail from './itemDetail'
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom'


function App() {
    /* 
        const [users, setUsers] = useState([
            { name: 'vasko', message: 'there' },
            { name: 'jays', message: 'i want y' },
            { name: 'traversy', message: 'HIhihi' }
        ])
     */
    return (
        <Router>
            <div>

                <Navbar />
                <Switch>
                    <Route path="/" exact component={Item} />
                    <Route path="/Login" component={Login} />
                    <Route path="/about" component={About} />
                    <Route path="/item" exact component={Item} />
                    <Route path="/item/:id" component={itemDetail} />
                </Switch>


                {/*  {users.map(user => (
                <Item name={user.name} message={user.message} />
            ))} */}


            </div >
        </Router>
    )
}

export default App