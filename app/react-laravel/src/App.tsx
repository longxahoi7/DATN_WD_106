import { useState } from "react";
import reactLogo from "./assets/react.svg";

import "./App.css";
import { useRoutes } from "react-router-dom";

import ProductList from "./layout/Product/ProductList";
import Location from "./layout/Product/Location";
import LienHe from "./layout/Product/LienHe";
import Products from "./layout/Product/Products";
import ProductDetail from "./layout/Product/ProductDetail";
import Introduce from "./layout/Product/Introduce";
import Pay from "./layout/Product/Pay";
import ClothingCare from "./layout/pages/ClothingCare";
import BuyingInstructions from "./layout/pages/BuyingInstructions";
import ReturnPolicy from "./layout/pages/ReturnPolicy";
import LoyalCustomers from "./layout/pages/LoyalCustomers";
import ProductionPartners from "./layout/pages/ProductionPartners";
import Login from "./layout/users/Login";
import Register from "./layout/users/Register";
import ForgotPassword from "./layout/users/ForgotPassword";

function App() {
    const router = useRoutes([
        { path: "/", Component: ProductList },
        { path: "product-detail/:id", Component: ProductDetail },
        { path: "contact", Component: LienHe },
        { path: "introduce", Component: Introduce },
        { path: "pay", Component: Pay },
        { path: "clothingCare", Component: ClothingCare },//huong-dan-bao-quan
        { path: "buyingInstructions", Component: BuyingInstructions },//huong-dan-mua-hang
        { path: "loyalCustomers", Component: LoyalCustomers },//khach-hang-than-thiet
        { path: "returnPolicy", Component: ReturnPolicy },//huong-dan-doi-hang
        { path: "productionPartners", Component: ProductionPartners },//doi-tac-san-xuat
        { path: "location", Component: Location },//he-thong-cua-hang
        { path: "products/:category", Component: Products },
        { path: "login", Component: Login },
        { path: "register", Component: Register },
        { path: "forgotPassword ", Component: ForgotPassword },
    ]);
    return router;
}

export default App;
