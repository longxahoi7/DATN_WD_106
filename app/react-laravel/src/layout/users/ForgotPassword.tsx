import React from "react";
import { Link } from "react-router-dom";

type Props = {};

const ForgotPassword = (props: Props) => {
    return (
        <>
            <div className="flex justify-center items-center min-h-screen">
                <div className="flex flex-col md:flex-row items-center md:items-start mt-10">
                    <div className="text-center md:text-left md:mr-16">
                        <Link to="/">
                            <img
                                src="../../../public/image/logo1.png"
                                alt="Ecwid by Lightspeed logo"
                                className="mx-auto md:mx-0 mb-4"
                                width="100"
                                height="50"
                            />
                        </Link>
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
                            Password Reset
                        </h2>
                        <p className="mb-4">
                            We'll send a password reset link to this email.
                        </p>
                        <input
                            type="email"
                            placeholder="Email"
                            className="w-full p-2 mb-4 border rounded"
                        />

                        <button className="w-full bg-black text-white p-2 rounded">
                            Reset password
                        </button>
                        <div className="mt-4">
                            <a href="/register">
                                <button className="w-full bg-white border p-2 rounded mb-2">
                                    Tạo tài khoản Gentlemanor mới
                                </button>
                            </a>
                            <a href="/login">
                                <button className="w-full bg-white border p-2 rounded">
                                    Sign In
                                </button>
                            </a>
                        </div>

                        <p className="text-sm mt-4">
                            By continuing, you agree to the{" "}
                            <a href="#" className="text-blue-500">
                                Terms of Service
                            </a>{" "}
                            and{" "}
                            <a href="#" className="text-blue-500">
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

export default ForgotPassword;
