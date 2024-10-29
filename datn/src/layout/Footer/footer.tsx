import React from "react";
import "./footer.css";
type Props = {};

const Footer = (props: Props) => {
  return (
    <>
      <div className="footer">
        <div className="container">
          <div className="row-grid">
            <div className="footer-item">
              <p>MEN'S POLO SHIRT</p>
              <p>Đăng kí thành viên</p>
              <p>Ưu đãi và đọc quyền</p>
            </div>
            <div className="footer-item">
              <p>CHÍNH SÁCH</p>
              <p>Chính sách đổi trả trong ngày</p>
              <p>Chính sách khuyến mại</p>
              <p>Chính sách giao hàng</p>
            </div>
            <div className="footer-item">
              <p>CHĂM SÓC KHÁCH HÀNG</p>
              <p>Trải nghiệm mua sắm 100% hài lòng</p>
              <p>Hỏi đáp 24/7</p>
            </div>
            <div className="footer-item">
              <p>ĐỊA CHỈ LIÊN HỆ</p>
              <p>Trịnh Văn Bô-Bắc Từ Liêm-Hà Nội</p>
            </div>
          </div>
        </div>
      </div>
    </>
  );
};

export default Footer;
