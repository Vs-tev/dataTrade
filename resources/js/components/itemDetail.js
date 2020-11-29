import React, { useState, useEffect } from 'react'
import './App.css';


function itemDetail({ match }) {
    useEffect(() => {
        fetchItem();
        console.log(match)

    }, []);

    const [item, setItem] = useState({});

    async function fetchItem() {
        const fetchItem = await fetch(`https://fortnite-api.theapinetwork.com/upcoming/get?id=${match.params.id}`);
        const item = await fetchItem.json();

        console.log(item);
    }

    return (
        <div>
            <h1>{item.name}</h1>
        </div>
    )
}

export default itemDetail