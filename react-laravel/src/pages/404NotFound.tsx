import React from "react";
import "./notFound.css";

const NotFound: React.FC = () => {
    return (
        <div className="notfound-container">
            <div className="notfound-content text-center">
                <h1 className="display-1">404</h1>
                <h2 className="notfound-message">Page Not Found</h2>
                <p className="lead">
                    Sorry, the page you're looking for doesn't exist.
                </p>
                <a href="/" className="btn btn-primary btn-lg">
                    Go Back Home
                </a>
            </div>
        </div>
    );
};

export default NotFound;
