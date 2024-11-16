import { StrictMode } from "react";
import { createRoot } from "react-dom/client";
import App from "./App";
// import "./index.css";
import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import { BrowserRouter } from "react-router-dom";

const root = createRoot(document.getElementById("root")!);
root.render(
    <StrictMode>
        <BrowserRouter>
            <App />
        </BrowserRouter>
    </StrictMode>
);
