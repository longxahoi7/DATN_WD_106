import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import QuanLyDonHangAdmin from './QuanLyDonHangAdmin';
import { useRoutes } from "react-router-dom";
function App() {
  const router = useRoutes([
      { path: "/", Component: QuanLyDonHangAdmin},
      
  ]);
  return router;
}

export default App
