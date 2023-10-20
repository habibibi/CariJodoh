import { Link } from "react-router-dom";

const Home = () => {
  return (
    <div className="text-5xl flex flex-col h-[90vh]">
      <div className="mx-auto my-auto flex flex-col gap-8">
        <h1>Welcome to CariJodoh Security Application</h1>
        <div className="flex gap-8">
          <Link to={"/login"} className="w-1/2 border-black border-2 p-4">
            <button className="mx-auto w-full">Login</button>
          </Link>
          <Link to={"/register"} className="w-1/2 border-black border-2 p-4">
            <button className="mx-auto w-full">Register</button>
          </Link>
        </div>
      </div>
    </div>
  );
};

export default Home;
