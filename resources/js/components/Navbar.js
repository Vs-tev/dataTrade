import React from 'react'
import './App.css'
import { Link } from 'react-router-dom'
function Navbar() {
    return (
        <div>
            <nav className={"list-unsyled"}>
                <Link to="/"><li>Home</li></Link>
                <Link to="/about"><li >About</li></Link>
                <Link to="/login"><li >Login</li></Link>
                <Link to="/item"><li>Item</li></Link>

            </nav>
        </div>
    )
}

export default Navbar