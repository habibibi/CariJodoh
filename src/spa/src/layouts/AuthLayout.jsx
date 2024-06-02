import PropTypes from "prop-types";

const AuthLayout = ({ children }) => {
  return <div className="min-h-[100vh] bg-[#FFF8DC]">{children}</div>;
};

AuthLayout.propTypes = {
  children: PropTypes.node.isRequired,
};

export default AuthLayout;
