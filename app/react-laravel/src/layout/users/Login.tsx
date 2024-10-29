import React from "react";

type Props = {};

const Login = (props: Props) => {
    const handleAppleSignIn = () => {
        // Replace with your Apple sign-in logic
        window.location.href = "https://appleid.apple.com/auth/authorize";
    };

    const handleFacebookSignIn = () => {
        // Replace with your Facebook sign-in logic
        window.location.href = "https://www.facebook.com/v10.0/dialog/oauth";
    };

    const handleGoogleSignIn = () => {
        // Replace with your Google sign-in logic
        window.location.href = "https://accounts.google.com/o/oauth2/auth";
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        // Add your form submission logic here
    };
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
                            Sign in to your Gentlemanor account
                        </h2>
                        <form onSubmit={handleSubmit}>
                            <div className="mb-4">
                                <input
                                    type="email"
                                    placeholder="Email"
                                    className="w-full p-2 border border-gray-300 rounded"
                                />
                            </div>
                            <div className="mb-4">
                                <input
                                    type="password"
                                    placeholder="Password"
                                    className="w-full p-2 border border-gray-300 rounded"
                                />
                            </div>
                            <div className="mb-4 text-right">
                                <a href="#" className="text-blue-600">
                                    Quên mật khẩu?
                                </a>
                            </div>
                            <div className="mb-4">
                                <div
                                    className="g-recaptcha"
                                    data-sitekey="YOUR_RECAPTCHA_SITE_KEY"
                                ></div>
                            </div>
                            <button
                                type="submit"
                                className="w-full bg-black text-white p-2 rounded"
                            >
                                Sign In
                            </button>
                            <div className="flex items-center mt-4">
                                <input
                                    type="checkbox"
                                    id="keep-signed-in"
                                    className="mr-2"
                                />
                                <label className="text-gray-600">
                                    Keep me signed in
                                </label>
                            </div>
                            <div className="mt-4 text-center">
                                <a href="/register" className="text-blue-600">
                                    Tạo tài khoản Gentlemanor mới
                                </a>
                            </div>
                        </form>
                        <div className="mt-8">
                            <button
                                onClick={handleAppleSignIn}
                                className="w-full bg-gray-100 text-black p-2 rounded flex items-center justify-center mb-2"
                            >
                                <i className="fab fa-apple mr-2"></i> Sign In
                                with Apple
                            </button>
                            <button
                                onClick={handleFacebookSignIn}
                                className="w-full bg-gray-100 text-black p-2 rounded flex items-center justify-center mb-2"
                            >
                                <i className="fab fa-facebook-f mr-2"></i> Đăng
                                nhập bằng facebook
                            </button>
                            <button
                                onClick={handleGoogleSignIn}
                                className="w-full bg-gray-100 text-black p-2 rounded flex items-center justify-center"
                            >
                                <i className="fab fa-google mr-2"></i> Đăng nhập
                                bằng Google
                            </button>
                            <div className="mt-4 text-center">
                                <a href="#" className="text-blue-600">
                                    More ways to sign in
                                </a>
                            </div>
                            <div className="mt-4 text-center text-gray-600 text-sm">
                                By continuing, you agree to the{" "}
                                <a href="#" className="text-blue-600">
                                    Terms of Service
                                </a>{" "}
                                and{" "}
                                <a href="#" className="text-blue-600">
                                    Privacy Policy
                                </a>
                                .
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
};

export default Login;
