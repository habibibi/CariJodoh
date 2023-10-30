import { Link } from "react-router-dom";
import PropTypes from "prop-types";

const DetectCard = ({ user_id, name, anomalies }) => {
  return (
    <div className="flex flex-row items-center gap-2 bg-[#ffd2da] rounded-xl p-4 w-full">
      <div className="flex flex-col gap-2">
        <p>
          <strong>Nama Lengkap:</strong> {name}
        </p>
        <p>
          <strong>Anomalies:</strong> {anomalies || "-"}
        </p>
      </div>
      <Link
        to={`/detect/${user_id}`}
        className="ml-auto h-full flex flex-row gap-2"
      >
        <button className="h-full rounded-lg cursor-pointer p-2 border-2 bg-white">
          <strong>View Profile!</strong>
        </button>
      </Link>
    </div>
  );
};

export default DetectCard;

DetectCard.propTypes = {
  user_id: PropTypes.number.isRequired,
  name: PropTypes.string.isRequired,
  anomalies: PropTypes.string,
};
