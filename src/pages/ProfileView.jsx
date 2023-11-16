import { useEffect, useState } from "react";
import Axios from "../config/Axios";
import { toast } from "react-toastify";
import { useNavigate, useParams } from "react-router-dom";

const ProfileView = () => {
  const { user_id } = useParams();
  const [profile, setProfile] = useState({});
  const [confirm, setConfirm] = useState(false);
  const navigate = useNavigate();

  const blockUser = async (e) => {
    e.preventDefault();
    try {
      const body = {
        username: profile?.nama_lengkap || "Unknown",
      };
      const response = await Axios.post(
        `${import.meta.env.VITE_API_URL}/users/${user_id}`,
        body,
        { withCredentials: true }
      );
      setConfirm(false);
      navigate("/detect");
      toast.success(response.data.message);
    } catch (error) {
      toast.error(error.response?.data?.message || "Fetching data gagal!");
    }
  };

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await Axios.get(
          `${import.meta.env.VITE_API_URL}/users/${user_id}`
        );
        setProfile(response.data.data);
      } catch (error) {
        toast.error(error.response?.data?.message || "Fetching data gagal!");
      }
    };

    fetchData();
  }, [user_id]);

  return (
    <>
      <div className="flex flex-col gap-8 md:px-36">
        {profile ? (
          <>
            <h1 className="text-center text-xl md:text-4xl font-bold">
              Profile {profile?.nama_lengkap}
            </h1>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
              <div className="flex flex-col gap-4">
                <h2 className="text-xl md:text-2xl font-semibold">
                  Informasi Nama
                </h2>
                <div className="bg-[#ffd2da] p-4 rounded-xl">
                  <h1>Nama Lengkap: {profile?.nama_lengkap}</h1>
                  <h2>Nama Panggilan: {profile?.nama_panggilan}</h2>
                </div>
              </div>
              <div className="flex flex-col gap-4">
                <h2 className="text-xl md:text-2xl font-semibold">Profil</h2>
                <div className="bg-[#ffd2da] p-4 rounded-xl">
                  <p>Lokasi: {profile?.domisili}</p>
                  <p>Zodiak: {profile?.zodiak}</p>
                  <p>Umur: {profile?.umur} Tahun</p>
                  <p>Tinggi: {profile?.tinggi_badan} cm</p>
                  <p>Agama: {profile?.agama}</p>
                </div>
              </div>
              <div className="flex flex-col gap-4">
                <h2 className="text-xl md:text-2xl font-semibold">Hobi</h2>
                <div className="bg-[#ffd2da] p-4 rounded-xl">
                  <p className="text-addition">{profile?.hobi}</p>
                </div>
              </div>
              <div className="flex flex-col gap-4">
                <h2 className="text-xl md:text-2xl font-semibold">Interest</h2>
                <div className="bg-[#ffd2da] p-4 rounded-xl">
                  <p className="text-addition">{profile?.interest}</p>
                </div>
              </div>
              <div className="flex flex-col gap-4">
                <h2 className="text-xl md:text-2xl font-semibold">
                  Ketidaksukaan
                </h2>
                <div className="bg-[#ffd2da] p-4 rounded-xl">
                  <p className="text-addition">{profile?.ketidaksukaan}</p>
                </div>
              </div>
              <div className="flex flex-col gap-4">
                <h2 className="text-xl md:text-2xl font-semibold">MBTI</h2>
                <div className="bg-[#ffd2da] p-4 rounded-xl">
                  <p className="text-addition">{profile?.mbti}</p>
                </div>
              </div>
              <div className="flex flex-col gap-4">
                <h2 className="text-xl md:text-2xl font-semibold">
                  Love Language
                </h2>
                <div className="bg-[#ffd2da] p-4 rounded-xl">
                  <p className="text-addition">{profile?.love_language}</p>
                </div>
              </div>
              <button
                className="bg-red-400 w-[8rem] rounded-xl font-semibold mx-auto h-12 my-auto text-white"
                onClick={() => setConfirm(true)}
              >
                Block User!
              </button>
            </div>
          </>
        ) : (
          <>
            <h1 className="text-center text-3xl font-bold">
              Data profile user tidak tersedia!
            </h1>
          </>
        )}
      </div>
      {confirm ? (
        <>
          <div className="fixed inset-0 flex items-center justify-center z-[999999]">
            <div className="bg-white rounded-lg p-8 w-1/3 flex flex-col">
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
                  onClick={(e) => blockUser(e)}
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

export default ProfileView;
