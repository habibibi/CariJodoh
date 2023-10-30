import { useRef, useEffect, useState } from "react";
import DetectCard from "../components/detect/DetectCard";
import Axios from "../config/Axios";
import { toast } from "react-toastify";
import { useDebounce } from "use-debounce";
import { updatePaginationButtons } from "../common/Pagination";

const Detect = () => {
  const [count, setCount] = useState(0);
  const [profiles, setProfiles] = useState([]);
  const [search, setSearch] = useState("");
  const [currentPage, setCurrentPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);
  const [paginationOffset, setPaginationOffset] = useState(1);
  const [debounced] = useDebounce(search, 300);

  const prevButtonRef = useRef(null);
  const nextButtonRef = useRef(null);
  const paginationRef = useRef(null);

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
          `${
            import.meta.env.VITE_API_URL
          }/detect/users?search=${debounced}&page=${currentPage}`
        );
        setProfiles(response.data.data.users);
        setTotalPages(response.data.totalPages);
        setCount(response.data.totalAnomalies);
      } catch (error) {
        console.log(error);
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

    if (!debounced) {
      setProfiles([]);
      setCurrentPage(1);
      setPaginationOffset(1);
      setTotalPages(1);
      setCount(0);
      updatePaginationButtons(paginationConfig, load);
      return;
    }

    paginationProcess();
  }, [debounced, currentPage, totalPages, paginationOffset]);

  return (
    <div className="flex flex-col gap-8 px-36">
      <h1 className="text-center text-4xl font-bold">
        Detect Anomalies & Block Users
      </h1>
      <div className="w-full flex">
        <input
          type="text"
          placeholder="Masukkan hal anomali yang ingin dicari..."
          className="w-full p-4 rounded-xl mx-auto"
          value={search}
          onChange={(e) => {
            if (currentPage !== 1) {
              setCurrentPage(1);
              setPaginationOffset(1);
            }
            setSearch(e.target.value);
          }}
        />
      </div>
      <h2 className="text-center text-2xl font-bold">
        There are {count} anomalies found.
      </h2>
      <div className="grid grid-cols-2 gap-x-4 gap-y-4">
        {profiles.length > 0 &&
          profiles.map((el, idx) => (
            <DetectCard
              key={idx}
              user_id={el.user_id}
              name={el.nama_lengkap}
              anomalies={el?.anomalies}
            />
          ))}
      </div>
      <div className="flex">
        <div className="flex flex-row gap-[10px] mx-auto">
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
  );
};

export default Detect;
