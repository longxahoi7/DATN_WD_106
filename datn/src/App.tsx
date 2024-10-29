import { useState } from 'react'
import './App.css'
import QuanLyDonHangAdmin from './QuanLyDonHangAdmin';
import chiTietDonHang from './chiTietDonHang';
import { useRoutes } from "react-router-dom";
function App() {
  const router = useRoutes([
      { path: "/", Component: QuanLyDonHangAdmin},   
      { path: "/chitietdonhang", Component: chiTietDonHang },

      
  ]);
  return router;
}

export default App
