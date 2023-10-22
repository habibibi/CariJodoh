import { Navigate } from "react-router-dom";
import PropTypes from "prop-types";
import { checkAuthenticationStatus } from "./VerifyAuth";
import { toast } from "react-toastify";

const ProtectedRoute = ({ children }) => {
  const isAuthenticated = checkAuthenticationStatus();

  if (!isAuthenticated) {
    toast.error("Login terlebih dahulu!");
    return <Navigate to="/login" />;
  }
  return children;
};

ProtectedRoute.propTypes = {
  children: PropTypes.node.isRequired,
};

export default ProtectedRoute;
