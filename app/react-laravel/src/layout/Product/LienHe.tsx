import React from "react";
import Header from "../Header/header";
import Footer from "../Footer/footer";
import SlideShow from "../slideShow/SlideShow";

type Props = {};

const LienHe = (props: Props) => {
    return (
        <>
            <Header />
            <SlideShow />

            <div
                className="min-h-screen bg-gray-100 mt-20 "
                style={{ width: "100vw" }}
            >
                <div className="relative">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.702004469364!2d105.8194543154021!3d21.00311799396364!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab5c5b5b5b5b%3A0x5b5b5b5b5b5b5b5b!2s313-315%20D.%20Tr%C6%B0%E1%BB%9Dng%20Chinh%2C%20Kh%C6%B0%C6%A1ng%20Th%C6%B0%E1%BB%A3ng%2C%20Thanh%20Xu%C3%A2n%2C%20H%C3%A0%20N%E1%BB%99i!5e0!3m2!1sen!2s!4v1633072800000!5m2!1sen!2s"
                        width="100%"
                        height="450"
                        style={{ border: 0 }}
                        loading="lazy"
                        title="Google Map"
                    ></iframe>
                </div>
                <div className="container mx-auto px-4 py-8">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h2 className="text-2xl font-semibold mb-4">
                                Gửi thắc mắc cho chúng tôi
                            </h2>
                            <p className="mb-4">
                                Nếu bạn có thắc mắc gì, có thể gửi yêu cầu cho
                                chúng tôi, và chúng tôi sẽ liên lạc với bạn sớm
                                nhất có thể.
                            </p>
                            <form className="space-y-4">
                                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input
                                        type="text"
                                        placeholder="Tên của bạn"
                                        className="border border-gray-300 p-2 rounded w-full"
                                    />
                                    <input
                                        type="text"
                                        placeholder="Số điện thoại của bạn"
                                        className="border border-gray-300 p-2 rounded w-full"
                                    />
                                </div>
                                <input
                                    type="email"
                                    placeholder="Email của bạn"
                                    className="border border-gray-300 p-2 rounded w-full"
                                />
                                <textarea
                                    placeholder="Nội dung"
                                    className="border border-gray-300 p-2 rounded w-full h-32"
                                ></textarea>
                                <p className="text-sm text-gray-500">
                                    This site is protected by reCAPTCHA and the
                                    Google{" "}
                                    <a href="#" className="text-blue-500">
                                        Privacy Policy
                                    </a>{" "}
                                    and{" "}
                                    <a href="#" className="text-blue-500">
                                        Terms of Service
                                    </a>{" "}
                                    apply.
                                </p>
                                <button
                                    type="submit"
                                    className="bg-black text-white px-4 py-2 rounded"
                                >
                                    GỬI CHO CHÚNG TÔI
                                </button>
                            </form>
                        </div>
                        <div>
                            <h2 className="text-2xl font-semibold mb-4">
                                Thông tin liên hệ
                            </h2>
                            <ul className="space-y-4">
                                <li className="flex items-start">
                                    <i className="fas fa-map-marker-alt text-xl mr-4"></i>
                                    <div>
                                        <h3 className="font-semibold">
                                            Địa chỉ
                                        </h3>
                                        <p>
                                            Tầng 8, tòa nhà Ford, số 315 Trường
                                            Chinh, quận Thanh Xuân, Hà Nội
                                        </p>
                                    </div>
                                </li>
                                <li className="flex items-start">
                                    <i className="fas fa-phone-alt text-xl mr-4"></i>
                                    <div>
                                        <h3 className="font-semibold">
                                            Điện thoại
                                        </h3>
                                        <p>0964.942.121</p>
                                    </div>
                                </li>
                                <li className="flex items-start">
                                    <i className="fas fa-clock text-xl mr-4"></i>
                                    <div>
                                        <h3 className="font-semibold">
                                            Thời gian làm việc
                                        </h3>
                                        <p>
                                            Thứ 2 đến thứ 6: từ 8h30 đến 18h;
                                            Thứ 7: từ 8h30 đến 12h00
                                        </p>
                                    </div>
                                </li>
                                <li className="flex items-start">
                                    <i className="fas fa-envelope text-xl mr-4"></i>
                                    <div>
                                        <h3 className="font-semibold">Email</h3>
                                        <p>cskh@Gentlemanor.vn</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <Footer />
        </>
    );
};

export default LienHe;
