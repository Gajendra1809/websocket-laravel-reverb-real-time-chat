import React, { useEffect, useRef, useState } from "react";
import Message from "./Message.jsx";
import MessageInput from "./MessageInput.jsx";

const ChatBox = ({ user }) => {

    const authUser = JSON.parse(document.getElementById('main').getAttribute('data-user'));

    const [messages, setMessages] = useState([]);
    const scroll = useRef();

    const connectWebSocket = () => {
        window.Echo.channel('chat.'+authUser.id)
        .listen('GotMessage', (e) => {
            console.log('Message received:', e);
            getMessages();
        });
    }

    const getMessages = async () => {
        try {
            let response = await fetch('http://127.0.0.1:8000/messages/user/' + user.id);
            response = await response.json();
            console.log(response.messages);
            setMessages(response.messages || []);
        } catch (err) {
            console.log(err.message);
        }
    };

    useEffect(() => {
        getMessages();
        connectWebSocket();
        return () => {
            window.Echo.leave(webSocketChannel);
        }
    }, []);

    return (
        <div className="row justify-content-center">
            <div className="col-md-8">
                <div className="card">
                    <div className="card-header">Chat Box</div>
                    <div className="card-body"
                         style={{height: "500px", overflowY: "auto"}}>
                        {
                            messages?.map((message) => (
                                <Message key={message.id} userId={user.id} message={message} />
                            ))
                        }
                        <span ref={scroll}></span>
                    </div>
                    <div className="card-footer">
                        <MessageInput user={user} />
                    </div>
                </div>
            </div>
        </div>
    );
};

export default ChatBox;