import PropTypes from "prop-types";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

const MainLayout = ({ children }) => {
  return (
    <div className="flex flex-col">
      <Navbar />
      <div className="bg-[#FFF8DC]">
        <div className="max-w-screen-2xl mx-auto py-8 px-4 min-h-[85vh]">
          {children}
        </div>
      </div>
      <Footer />
    </div>
  );
};

MainLayout.propTypes = {
  children: PropTypes.node.isRequired,
};

export default MainLayout;
