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
        { path: "lien-he", Component: LienHe },
        { path: "gioi-thieu", Component: Introduce },
        { path: "thanh-toan", Component: Pay },
        { path: "huong-dan-bao-quan", Component: ClothingCare },
        { path: "huong-dan-mua-hang", Component: BuyingInstructions },
        { path: "khach-hang-than-thiet", Component: LoyalCustomers },
        { path: "huong-dan-doi-hang", Component: ReturnPolicy },
        { path: "doi-tac-san-xuat", Component: ProductionPartners },
        { path: "he-thong-cua-hang", Component: Location },
        { path: "products/:category", Component: Products },
        { path: "login", Component: Login },
        { path: "register", Component: Register },
        { path: "quenmk", Component: ForgotPassword },
    ]);
    return router;
}

export default App;
