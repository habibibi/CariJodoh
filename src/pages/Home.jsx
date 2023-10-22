import { useNavigate } from "react-router-dom";
import Lock from "../assets/lock.webp";

const Home = () => {
  const navigate = useNavigate();
  const logout = () => {
    localStorage.removeItem("jwtToken");
    navigate("/login");
  };

  return (
    <div className="text-5xl flex flex-col min-h-[72vh] font-semibold">
      <div className="mx-auto my-auto flex flex-col gap-12">
        <h1 className="text-4xl text-center">
          Welcome to CariJodoh Security Application
        </h1>
        <div className="mx-auto w-3/4 sm:w-1/3">
          <img src={Lock} alt="" />
        </div>
        <button
          className="bg-[#FFD2DA] p-5 rounded-xl text-3xl"
          onClick={() => logout()}
        >
          Logout
        </button>
      </div>
    </div>
  );
};

export default Home;
