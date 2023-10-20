import PropTypes from "prop-types";

const MainLayout = ({ children }) => {
  return (
    <div className="bg-[#FFF8DC]">
      <div className="max-w-screen-2xl mx-auto">{children}</div>
    </div>
  );
};

MainLayout.propTypes = {
  children: PropTypes.node.isRequired,
};

export default MainLayout;
