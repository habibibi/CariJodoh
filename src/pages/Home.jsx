import { useNavigate } from "react-router-dom";

const Home = () => {
  const navigate = useNavigate();
  const logout = () => {
    localStorage.removeItem("jwtToken");
    navigate("/login");
  };

  return (
    <div className="text-5xl flex flex-col h-[100vh]">
      <div className="mx-auto my-auto flex flex-col gap-8">
        <h1>Welcome to CariJodoh Security Application</h1>
        <button
          className="bg-[#FFD2DA] p-5 rounded-xl"
          onClick={() => logout()}
        >
          Logout
        </button>
      </div>
    </div>
  );
};

export default Home;
