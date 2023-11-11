import { Link } from "react-router-dom";
import AuthLayout from "../layouts/AuthLayout";
import AuthImage from "../assets/auth-img.webp";
import Axios from "../config/Axios";
import { useEffect, useState } from "react";
import { toast } from "react-toastify";
import { useNavigate } from "react-router-dom";
import { checkAuthenticationStatus } from "../config/VerifyAuth";

const Register = () => {
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [confirmPassword, setConfirmPassword] = useState("");
  const navigate = useNavigate();

  useEffect(() => {
    const isAuthenticated = checkAuthenticationStatus();
    if (isAuthenticated) {
      toast.error("Logout terlebih dahulu!");
      navigate("/");
    }
  }, [navigate]);

  const registerUser = async (e) => {
    e.preventDefault();

    // Validate
    if (!username || !password || !confirmPassword) {
      toast.error("Lengkapi form terlebih dahulu!");
      return;
    }

    if (username < 5) {
      toast.error("Username minimal 5 karakter");
      return;
    }

    if (password < 5) {
      toast.error("Password minimal 5 karakter");
      return;
    }

    if (password != confirmPassword) {
      toast.error("Password dan confirm password tidak sama!");
      return;
    }

    const body = {
      username: username,
      password: password,
    };

    try {
      const response = await Axios.post(
        `${import.meta.env.VITE_API_URL}/auth/register`,
        body
      );
      toast.success(response.data.message);
      navigate("/login");
    } catch (error) {
      toast.error(
        error.response.data.message || "Registrasi gagal, silahkan coba lagi"
      );
    }
  };

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
                value={username}
                onChange={(e) => setUsername(e.target.value)}
              />
            </div>

            <div className="flex flex-col gap-1">
              <label className="ml-2">Password</label>
              <input
                type="password"
                placeholder="Enter your password..."
                className="p-3 rounded-xl"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
            </div>

            <div className="flex flex-col gap-1">
              <label className="ml-2">Confirm Password</label>
              <input
                type="password"
                placeholder="Enter your confirm password..."
                className="p-3 rounded-xl"
                value={confirmPassword}
                onChange={(e) => setConfirmPassword(e.target.value)}
              />
            </div>
          </div>
          <div className="flex flex-col gap-4 w-3/4">
            <button
              className="bg-[#FFD2DA] p-3 font-semibold rounded-xl"
              onClick={(e) => registerUser(e)}
            >
              Register
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
