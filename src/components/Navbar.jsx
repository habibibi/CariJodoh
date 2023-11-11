import { Link } from "react-router-dom";
import Logo from "../assets/logo.webp";
import Hamburger from "../assets/hamburger.webp";
import { useState } from "react";

const Navbar = () => {
  const [open, setOpen] = useState(false);

  return (
    <nav className="bg-[#ffd2da] sticky top-0 left-0 z-[999]">
      <div className="flex flex-row items-center max-w-[1440px] mx-auto">
        <span>
          <Link to="/">
            <img src={Logo} alt="logo" className="w-[12rem] p-[1rem]" />
          </Link>
        </span>
        <ul className="m-0 ml-auto hidden lg:block">
          <li className="inline-block p-[1rem]">
            <Link to="/">Home</Link>
          </li>
          <li className="inline-block p-[1rem]">
            <Link to="/detect">Detect</Link>
          </li>
          <li className="inline-block p-[1rem]">
            <Link to="/report">Report</Link>
          </li>
          <li className="inline-block p-[1rem]">
            <Link to="/article">Article</Link>
          </li>
        </ul>
        <div className="flex w-full lg:hidden cursor-pointer">
          <div className="ml-auto">
            <img
              className="border-0 text-black w-[4rem] ml-auto py-[14px] px-[16px]"
              src={Hamburger}
              alt="dropdown"
              onClick={() => setOpen(!open)}
            />
          </div>
          {open ? (
            <ul className="absolute flex flex-col lg:hidden bg-[#ffd2da] w-full right-0 top-[100%]">
              <li className="p-[1rem] text-center font-semibold border-y-[1px] border-black">
                <Link to="/">Home</Link>
              </li>
              <li className="p-[1rem] text-center font-semibold border-b-[1px] border-black">
                <Link to="/detect">Detect</Link>
              </li>
              <li className="p-[1rem] text-center font-semibold border-b-[1px] border-black">
                <Link to="/report">Report</Link>
              </li>
              <li className="p-[1rem] text-center font-semibold">
                <Link to="/article">Article</Link>
              </li>
            </ul>
          ) : (
            <></>
          )}
        </div>
      </div>
    </nav>
  );
};

export default Navbar;
