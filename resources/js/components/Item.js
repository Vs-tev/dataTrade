import React, { useState, useEffect } from 'react'
import './App.css';
import { Link } from 'react-router-dom'

function Item() {

    useEffect(() => {
        fetchItems();
    }, []);

    const [data, setItems] = useState([]);

    async function fetchItems() {
        const data = await fetch('https://fortnite-api.theapinetwork.com/upcoming/get');
        const items = await data.json();
        console.log(items);
        setItems(items.data);
    }
    return (
        <div>
            {data.map(item => (
                <h1 key={item.itemId}><Link to={`/item/${item.itemId}`}>{item.item.name}</Link></h1>
            ))}
        </div>
    )
}

export default Item