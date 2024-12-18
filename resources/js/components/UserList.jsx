import React, { useState, useEffect } from "react";
import ChatBox from "./ChatBox";

const UserList = ({ rootUrl }) => {
    const [users, setUsers] = useState([]);

    const getUsers = async () => {
        try {
            let response = await fetch('http://127.0.0.1:8000/users');
            response = await response.json();
            setUsers(response.users || []);
        } catch (err) {
            console.log(err.message);
        }
    };

    useEffect(() => {
        getUsers();
    }, []);

    return (
        <div>
            {users.length > 0 ? (
                users.map((user) => (
                    <div>
                        <h6>Chat with : {user.name}</h6>
                        <ChatBox key={user.id} user={user} />
                    </div>
                ))
            ) : (
                <p>No users found.</p>
            )}
        </div>
    );
};

export default UserList;
