import { Link } from "react-router-dom";
import AuthLayout from "../layouts/AuthLayout";
import AuthImage from "../../public/assets/auth-img.webp";

const Register = () => {
  return (
    <AuthLayout>
      <div className="flex flex-col items-center md:items-left md:flex-row h-full min-h-[inherit]">
        <div className="md:w-1/2 my-auto h-full">
          <img
            src={AuthImage}
            alt=""
            className="w-1/2 md:w-3/4 mx-auto my-auto"
          />
        </div>
        <div className="flex flex-col p-4 gap-8 items-center w-full md:w-1/2 md:ml-auto my-auto">
          <div className="flex flex-col gap-2 items-center w-full">
            <h1 className="text-[#FFD2DA] text-5xl font-bold">Register</h1>
            <p className="text-sm">Please enter your register details below</p>
          </div>
          <div className="flex flex-col gap-4 w-3/4">
            <div className="flex flex-col gap-1">
              <label className="ml-2">Username</label>
              <input
                type="text"
                placeholder="Enter your username..."
                className="p-3 rounded-xl"
              />
            </div>

            <div className="flex flex-col gap-1">
              <label className="ml-2">Password</label>
              <input
                type="password"
                placeholder="Enter your password..."
                className="p-3 rounded-xl"
              />
            </div>

            <div className="flex flex-col gap-1">
              <label className="ml-2">Confirm Password</label>
              <input
                type="password"
                placeholder="Enter your confirm password..."
                className="p-3 rounded-xl"
              />
            </div>
          </div>
          <div className="flex flex-col gap-4 w-3/4">
            <button className="bg-[#FFD2DA] p-3 font-semibold rounded-xl">
              Register
            </button>
            <div className="flex flex-row gap-2 items-center">
              <hr className="h-[2px] bg-black w-full"></hr>
              <h2>OR</h2>
              <hr className="h-[2px] bg-black w-full"></hr>
            </div>
            <button className="mx-auto bg-[#FFD2DA] p-4 rounded-xl font-semibold">
              Google
            </button>
          </div>
          <p>
            Already have an account?{" "}
            <Link to={"/login"} className="underline">
              Login Now
            </Link>
          </p>
        </div>
      </div>
    </AuthLayout>
  );
};

export default Register;
