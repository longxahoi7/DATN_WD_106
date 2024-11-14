import React from "react";
import "../../style/notification.css";

interface NotificationProps {
    message: string;
    type: "success" | "error";
}

const Notification: React.FC<NotificationProps> = ({ message, type }) => {
    return (
        <div className={`notification ${type}`}>
            <p>{message}</p>
        </div>
    );
};

export default Notification;
