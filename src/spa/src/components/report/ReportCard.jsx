import { Link } from "react-router-dom";
import PropTypes from "prop-types";
import Axios from "../../config/Axios";
import { toast } from "react-toastify";

const DetectCard = ({
  report_id,
  user_id_reporter,
  user_id_reported,
  report_detail,
  setSelectedUserId,
  setReportDetail,
  setConfirm,
  refreshData,
}) => {
  const tryBlock = () => {
    setConfirm(true);
    setSelectedUserId(user_id_reported);
    setReportDetail(report_detail);
  };

  const ignoreReport = async () => {
    try {
      const response = await Axios.delete(
        `${import.meta.env.VITE_API_URL}/report/${report_id}`,
        { withCredentials: true }
      );
      toast.success(response.data.message);
      refreshData();
    } catch (error) {
      toast.error(error.response?.data?.message || "Fetching data gagal!");
    }
  };

  return (
    <div className="flex flex-col gap-4 bg-[#ffd2da] rounded-xl p-4 w-full md:w-3/4 mx-auto">
      <div className="flex flex-col lg:flex-row items-center lg:items-start gap-2">
        <div className="flex flex-col gap-2">
          <p className="text-center lg:text-left">
            <strong>Pelapor:</strong> {user_id_reporter}
          </p>
          <p className="text-center lg:text-left">
            <strong>Tersangka:</strong> {user_id_reported}
          </p>
        </div>
        <Link
          to={`/detect/${user_id_reported}`}
          className="h-full flex flex-row gap-2 justify-center lg:justify-end lg:ml-auto"
        >
          <button className="h-full rounded-lg cursor-pointer p-2 border-2 bg-white">
            <strong>View Reported Profile!</strong>
          </button>
        </Link>
        <button
          className="h-full rounded-lg cursor-pointer p-2 border-2 bg-white"
          onClick={() => ignoreReport()}
        >
          <strong>Ignore</strong>
        </button>
        <button
          className="h-full rounded-lg cursor-pointer p-2 border-2 bg-white"
          onClick={() => tryBlock()}
        >
          <strong>Block</strong>
        </button>
      </div>
      <div className="flex flex-col gap-4">
        <h2 className="text-center md:text-xl font-semibold">Detail Report</h2>
        <p className="border-[1px] p-4 border-black rounded-xl bg-white">
          {report_detail}
        </p>
      </div>
    </div>
  );
};

export default DetectCard;

DetectCard.propTypes = {
  report_id: PropTypes.number.isRequired,
  user_id_reporter: PropTypes.number.isRequired,
  user_id_reported: PropTypes.number.isRequired,
  report_detail: PropTypes.string.isRequired,
  setSelectedUserId: PropTypes.func.isRequired,
  setReportDetail: PropTypes.func.isRequired,
  setConfirm: PropTypes.func.isRequired,
  refreshData: PropTypes.func.isRequired,
};
