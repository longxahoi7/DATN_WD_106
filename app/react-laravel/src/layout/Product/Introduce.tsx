import React, { useEffect } from "react";
import Footer from "../Footer/footer";
import Header from "../Header/header";
import SlideShow from "../slideShow/SlideShow";

type Props = {};

const Introduce = () => {
    useEffect(() => {
        const handleScroll = () => {
            sessionStorage.setItem("scrollPosition", window.scrollY.toString()); // Chuyển đổi thành chuỗi
        };

        window.addEventListener("scroll", handleScroll);

        const savedPosition = sessionStorage.getItem("scrollPosition");
        if (savedPosition) {
            window.scrollTo(0, parseInt(savedPosition, 10)); // Chuyển thành number khi dùng
        }

        return () => {
            window.removeEventListener("scroll", handleScroll);
        };
    }, []);

    return (
        <>
            <Header />
            <SlideShow />

            <div className=" p-4  " style={{ width: "100vw" }}>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div className="mt-48">
                        <h1 className="text-3xl font-bold mb-2 ">
                            The Whiplash of a Major Fashion World Shake-up
                        </h1>
                        <p className="text-gray-600 mb-4">
                            Brooks shocked the industry by announcing that Brad
                            Simmons, a top designer at Jannings, Brooks' rival,
                            will be joining the company by naming his
                            replacement, effective immediately.
                        </p>
                    </div>
                    <div>
                        <video
                            src="../../../public/video/Tainhanh.net_YouTube_saigon-sunday-fashion-film-BMPCC-6K-Cont_Media_yCBNYpMgDmE_002_720p.mp4"
                            autoPlay
                            muted
                            loop
                            width={"2000px"}
                            style={{ marginTop: "10px" }}
                        ></video>
                    </div>
                </div>
                <div className="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div className="border p-2">
                        <a
                            href="https://www.glitzandglambytiff.com/blog/staging-a-fashion-show-heres-how-to-ensure-its-a-success"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img
                                src="../../../public/image/h2.png"
                                alt="A fashion show with models walking on the runway"
                                className="w-full h-auto mb-2"
                            />
                        </a>
                        <h2 className="text-xl font-bold">
                            How to Stage a Viral Fashion Show
                        </h2>
                        <p className="text-gray-600">By Jane Doe</p>
                    </div>
                    <div className="border p-2">
                        <a
                            href="https://northshoreexchange.org/pages/nse-trend-report?_kx=mTCOCdPFshPcmjgujln2wh6Em2GUBKZeEZDnYVCF4OZCnjszphPZsD_-L3mb2JHP.XcXwa8&msclkid=d5a55accef94112977543ddc2bf5389c&utm_source=bing&utm_medium=cpc&utm_campaign=NSE%20-%20Blog&utm_term=fashion%20trends&utm_content=Fashion%20Trend%20Report"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img
                                src="../../../public/image/h3.png"
                                alt="A group of people sitting and watching a fashion show"
                                className="w-full h-auto mb-2"
                            />
                        </a>
                        <h2 className="text-xl font-bold">
                            The Best Trend of Fashion Month. And The Worst.
                        </h2>
                        <p className="text-gray-600">By John Smith</p>
                    </div>
                    <div className="border p-2">
                        <a
                            href="https://www.nytimes.com/2024/10/02/style/walz-vance-debate-style.html"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img
                                src="../../../public/image/h4.png"
                                alt="Two people standing at podiums during a debate"
                                className="w-full h-auto mb-2"
                            />
                        </a>
                        <h2 className="text-xl font-bold">
                            The Politics of a Boring Suit
                        </h2>
                        <p className="text-gray-600">By Alex Johnson</p>
                    </div>
                </div>
                <div className="grid grid-cols-2 md:grid-cols-6 gap-4 ml-20">
                    <div className="border p-2">
                        <a
                            href="https://www.youtube.com/watch?v=QHMuss1vq7Q"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img
                                src="../../../public/image/h5.png"
                                alt="A person standing in front of a fashion show"
                                className="w-full h-auto mb-2"
                            />
                        </a>
                        <h3 className="text-lg font-bold">
                            A Talk with the Talents to Watch
                        </h3>
                    </div>
                    <div className="border p-2">
                        <a
                            href="https://www.youtube.com/watch?v=qJ-MuvwAkSs"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img
                                src="../../../public/image/h6.png"
                                alt="A person standing in front of a fashion show"
                                className="w-full h-auto mb-2"
                            />
                        </a>
                        <h3 className="text-lg font-bold">
                            The New Wave of Fashion Designers
                        </h3>
                    </div>
                    <div className="border p-2">
                        <a
                            href="https://wwd.com/eye/parties/john-legend-usher-chris-pine-colman-domingo-attend-ralph-lauren-party-milan-fashion-week-1236443486/"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img
                                src="../../../public/image/h7.png"
                                alt="A person standing in front of a fashion show"
                                className="w-full h-auto mb-2"
                            />
                        </a>
                        <h3 className="text-lg font-bold">
                            Who Invited John to Milan Fashion Week?
                        </h3>
                    </div>
                    <div className="border p-2">
                        <a
                            href="https://www.vogue.com/article/vogue-wardrobe-essentials-guide"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img
                                src="../../../public/image/h8.png"
                                alt="A person standing in front of a fashion show"
                                className="w-full h-auto mb-2"
                            />
                        </a>
                        <h3 className="text-lg font-bold">What to Wear Next</h3>
                    </div>
                    <div className="border p-2">
                        <a
                            href="https://northshoreexchange.org/blogs/news/trends-in-fashion?msclkid=3891d6a704581c1e8ba8b1b7c2640f4a&utm_source=bing&utm_medium=cpc&utm_campaign=NSE%20-%20Blog&utm_term=fashion%20trends&utm_content=Fashion%20Trends"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            <img
                                src="../../../public/image/h9.png"
                                alt="A person standing in front of a fashion show"
                                className="w-full h-auto mb-2"
                            />
                        </a>
                        <h3 className="text-lg font-bold">
                            Fashion Forward: Spring and Summer Trends
                        </h3>
                    </div>
                </div>
                <hr className="mt-20" />
                <video
                    src="../../../public/video/yt1s.com - Britney Manson  FΛSHION Single 2023.mp4"
                    autoPlay
                    muted
                    loop
                    width={"2000px"}
                    style={{ marginTop: "10px" }}
                ></video>
            </div>
            <Footer />
        </>
    );
};

export default Introduce;
