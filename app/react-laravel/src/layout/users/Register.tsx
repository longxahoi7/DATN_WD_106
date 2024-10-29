import React from "react";

type Props = {};

const Register = (props: Props) => {
    return (
        <>
            <div className="flex justify-center items-center min-h-screen">
                <div className="flex flex-col md:flex-row items-center md:items-start mt-10">
                    <div className="text-center md:text-left md:mr-16">
                        <img
                            src="../../../public/image/logo1.png"
                            alt="Ecwid by Lightspeed logo"
                            className="mx-auto md:mx-0 mb-4"
                            width="100"
                            height="50"
                        />
                        <h1 className="text-3xl font-bold text-gray-800 mb-4">
                            Sell online with Gentlemanor
                        </h1>
                        <p className="text-gray-600 mb-8">
                            Gentlemanor là một giải pháp thương mại điện tử đầy
                            đủ tính năng và giá cả phải chăng bao gồm các cửa
                            hàng web, thiết bị di động và mạng xã hội.
                        </p>
                        <div>
                            <video
                                src="../../../public/video/videoplayback.mp4"
                                autoPlay
                                muted
                                loop
                                width={"1200px"}
                                style={{
                                    marginTop: "10px",
                                    marginLeft: "20px",
                                }}
                            ></video>
                        </div>
                    </div>
                    <div className="bg-white shadow-md rounded-lg p-8 w-full max-w-sm">
                        <h2 className="text-xl font-bold mb-4">
                            Get Started with a Free Account!
                        </h2>
                        <form className="space-y-4">
                            <input
                                type="text"
                                placeholder="Your first and last name"
                                className="w-full p-2 border border-gray-300 rounded"
                            />
                            <input
                                type="email"
                                placeholder="Email"
                                className="w-full p-2 border border-gray-300 rounded"
                            />
                            <input
                                type="password"
                                placeholder="Password"
                                className="w-full p-2 border border-gray-300 rounded"
                            />
                            <div className="flex items-center justify-center">
                                <div
                                    className="g-recaptcha"
                                    data-sitekey="your-site-key"
                                ></div>
                            </div>
                            <button
                                type="submit"
                                className="w-full bg-black text-white p-2 rounded"
                            >
                                Signup
                            </button>
                        </form>
                        <p className="text-sm text-center mt-4">
                            <a href="/login" className="text-blue-600">
                                If you already have an Gentlemanor account, sign
                                in
                            </a>
                        </p>
                        <div className="mt-4 space-y-2">
                            <button className="w-full flex items-center justify-center border border-gray-300 p-2 rounded">
                                <i className="fab fa-apple mr-2"></i> Sign Up
                                with Apple
                            </button>
                            <button className="w-full flex items-center justify-center border border-gray-300 p-2 rounded">
                                <i className="fab fa-facebook mr-2"></i> Đăng ký
                                bằng Facebook
                            </button>
                            <button className="w-full flex items-center justify-center border border-gray-300 p-2 rounded">
                                <i className="fab fa-google mr-2"></i> Đăng ký
                                bằng Google
                            </button>
                        </div>
                        <p className="text-xs text-center mt-4 text-gray-500">
                            By continuing, you agree to the{" "}
                            <a href="#" className="text-blue-600">
                                Terms of Service
                            </a>{" "}
                            and{" "}
                            <a href="#" className="text-blue-600">
                                Privacy Policy
                            </a>
                            .
                        </p>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Register;
