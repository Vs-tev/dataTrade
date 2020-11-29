import React from 'react';
import ReactDOM from 'react-dom'

import App from './App'


export default App;

if (document.getElementById('example')) {
    ReactDOM.render(<App />, document.getElementById('example'));
}
