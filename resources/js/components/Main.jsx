import React from 'react';
import ReactDOM from 'react-dom/client';
import '../../sass/app.scss';
import UserList from "./UserList.jsx";

if (document.getElementById('main')) {
    const rootUrl = "http://127.0.0.1:8000";

    ReactDOM.createRoot(document.getElementById('main')).render(
        <React.StrictMode>
            <UserList />
        </React.StrictMode>
    );
}