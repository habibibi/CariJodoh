import { useRef, useEffect, useState } from "react";
import ReportCard from "../components/report/ReportCard";
import Axios from "../config/Axios";
import { toast } from "react-toastify";
import { updatePaginationButtons } from "../common/Pagination";

const Report = () => {
  const [count, setCount] = useState(0);
  const [reports, setReports] = useState([]);
  const [currentPage, setCurrentPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);
  const [paginationOffset, setPaginationOffset] = useState(1);
  const [confirm, setConfirm] = useState(false);
  const [selectedUserId, setSelectedUserId] = useState(null);
  const [reportDetail, setReportDetail] = useState("");
  const prevButtonRef = useRef(null);
  const nextButtonRef = useRef(null);
  const paginationRef = useRef(null);

  const fetchData = async () => {
    try {
      const response = await Axios.get(
        `${import.meta.env.VITE_API_URL}/report?page=${currentPage}`,
        { withCredentials: true }
      );
      setReports(response.data.data.reports);
      setTotalPages(response.data.data.totalPages);
      setCount(response.data.data.totalReports);
    } catch (error) {
      toast.error(error.response?.data?.message || "Fetching data gagal!");
    }
  };

  const refreshData = () => {
    if (currentPage == 1) {
      fetchData();
    } else {
      setCurrentPage(1);
    }
  };

  const blockUser = async (e, user_id) => {
    e.preventDefault();

    try {
      const responseUser = await Axios.get(
        `${import.meta.env.VITE_API_URL}/users/${user_id}`,
        { withCredentials: true }
      );

      const body = {
        username: responseUser.data.data.nama_lengkap || "Unknown",
        report_detail: reportDetail,
      };

      const response = await Axios.post(
        `${import.meta.env.VITE_API_URL}/report/${user_id}`,
        body,
        { withCredentials: true }
      );

      setConfirm(false);
      toast.success(response.data.message);

      refreshData();
    } catch (error) {
      toast.error(error.response?.data?.message || "Fetching data gagal!");
    }
  };

  useEffect(() => {
    prevButtonRef.current = document.getElementById("prevPage");
    nextButtonRef.current = document.getElementById("nextPage");
    paginationRef.current = document.getElementById("button-pagination");

    // Define a function for your event listener
    const handlePrevButtonClick = () => {
      setCurrentPage(currentPage - 1);
      if (paginationOffset * 3 > currentPage) {
        setPaginationOffset(paginationOffset - 1);
      }
    };

    const handleNextButtonClick = () => {
      setCurrentPage(currentPage + 1);
      if ((paginationOffset + 1) * 3 <= currentPage) {
        setPaginationOffset(paginationOffset + 1);
      }
    };

    if (prevButtonRef.current) {
      prevButtonRef.current.addEventListener("click", handlePrevButtonClick);
    }

    if (nextButtonRef.current) {
      nextButtonRef.current.addEventListener("click", handleNextButtonClick);
    }

    // Clean up event listeners when the component unmounts
    return () => {
      if (prevButtonRef.current) {
        prevButtonRef.current.removeEventListener(
          "click",
          handlePrevButtonClick
        );
      }
      if (nextButtonRef.current) {
        nextButtonRef.current.removeEventListener(
          "click",
          handleNextButtonClick
        );
      }
    };
  }, [currentPage, paginationOffset]);

  useEffect(() => {
    const paginationConfig = {
      currentPage: currentPage,
      totalPages: totalPages,
      prevButton: prevButtonRef.current,
      nextButton: nextButtonRef.current,
      paginationOffset: paginationOffset,
      pagination: paginationRef.current,
    };

    const fetchData = async () => {
      try {
        const response = await Axios.get(
          `${import.meta.env.VITE_API_URL}/report?page=${currentPage}`,
          { withCredentials: true }
        );
        setReports(response.data.data.reports);
        setTotalPages(response.data.data.totalPages);
        setCount(response.data.data.totalReports);
      } catch (error) {
        toast.error(error.response?.data?.message || "Fetching data gagal!");
      }
    };

    const load = (paginationConfig) => {
      setCurrentPage(paginationConfig.currentPage);
      setPaginationOffset(paginationConfig.paginationOffset);
    };

    const paginationProcess = () => {
      // Fetch data
      fetchData();

      // Update tombol
      updatePaginationButtons(paginationConfig, load);

      // Update state baru
      setCurrentPage(paginationConfig.currentPage);
      setPaginationOffset(paginationConfig.paginationOffset);
    };

    paginationProcess();
  }, [currentPage, totalPages, paginationOffset]);

  return (
    <>
      <div className="flex flex-col gap-8 px-4 md:px-36">
        <h1 className="text-center text-4xl font-bold">Users{"'"} Reports</h1>
        <h2 className="text-center text-2xl font-bold">
          There are {count} report(s) available.
        </h2>
        <div className="flex flex-col gap-8">
          {reports.length > 0 &&
            reports.map((el, idx) => (
              <ReportCard
                key={idx}
                report_id={el.report_id}
                user_id_reporter={el.user_id_reporter}
                user_id_reported={el.user_id_reported}
                report_detail={el.report_detail}
                setSelectedUserId={setSelectedUserId}
                setReportDetail={setReportDetail}
                setConfirm={setConfirm}
                refreshData={refreshData}
              />
            ))}
        </div>
        <div className="flex">
          <div className="flex md:flex-row flex-col gap-[10px] mx-auto md:items-center md:justify-center">
            <button
              id="prevPage"
              className="p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {"<"}
            </button>
            <div id="button-pagination" className="flex flex-row gap-1"></div>
            <button
              id="nextPage"
              className="p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {">"}
            </button>
          </div>
        </div>
      </div>
      {confirm ? (
        <>
          <div className="fixed inset-0 flex items-center justify-center z-[999999]">
            <div className="bg-white rounded-lg p-8 w-2/3 md:w-1/3 flex flex-col">
              <h1 className="mb-4 text-center text-xl">
                Apakah anda betul ingin blokir user ini?
              </h1>
              <div className="flex mx-auto">
                <button
                  className="mr-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                  onClick={() => setConfirm(false)}
                >
                  Cancel
                </button>
                <button
                  className="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600"
                  onClick={(e) => blockUser(e, selectedUserId)}
                >
                  Confirm
                </button>
              </div>
            </div>
          </div>
          <div className="fixed top-0 left-0 w-full h-full flex items-center justify-center z-[99999] bg-black bg-opacity-70"></div>
        </>
      ) : (
        <></>
      )}
    </>
  );
};

export default Report;
