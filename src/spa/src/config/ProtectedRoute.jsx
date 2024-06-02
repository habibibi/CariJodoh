import { Navigate } from "react-router-dom";
import PropTypes from "prop-types";
import { toast } from "react-toastify";
import MainLayout from "../layouts/MainLayout";

const ProtectedRoute = ({ children }) => {
  const isAuthenticated =
    localStorage.getItem("session") &&
    new Date() <= new Date(localStorage.getItem("session"));

  if (!isAuthenticated) {
    toast.error("Login terlebih dahulu!");
    return <Navigate to="/login" />;
  }
  return <MainLayout>{children}</MainLayout>;
};

ProtectedRoute.propTypes = {
  children: PropTypes.node.isRequired,
};

export default ProtectedRoute;
