import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { checkAuthenticationStatus } from "../config/VerifyAuth";
import { toast } from "react-toastify";
import Axios from "../config/Axios";

const Tes = () => {
    const [author, setAuthor] = useState("");
    const [title, setTitle] = useState("");
    const [content, setContent] = useState("");
    const [image, setImage] = useState("");
    const navigate = useNavigate();

    // useEffect(() => {
    //     const isAuthenticated = checkAuthenticationStatus();
    //     if (!isAuthenticated) {
    //         toast.error("Login terlebih dahulu!");
    //         navigate("/");
    //     }
    // }, [navigate]);

    const addArticle = async (e) => {
        e.preventDefault();

        // Validasi Kelengkapan
        if (!title) {
            toast.error("Masukkan judul artikel terlebih dahulu!");
            return;
        } else if (!author) {
            toast.error("Masukkan penulis artikel terlebih dahulu!");
            return;
        } else if (content < 50) {
            toast.error("Isi artikel minimal 50 karakter!");
            return;
        }

        const body = {
            author: author,
            title: title,
            content: content,
            image: image,
        };

        try {
            const response = await Axios.post(
                // ???????? belum
            )
        } catch (error) {
            toast.error(error.response.data.message || "Tambah artikel gagal, silakan coba lagi");
        }
    };

    return (
        <div className="mb-5">
            <div className="flex justify-center mt-5">
                <h1 className="font-['Garamond'] text-3xl font-bold">TAMBAH ARTIKEL</h1>
            </div>
            
            <form className="max-w-2xl mx-auto p-4 bg-[#FFD2DA] rounded shadow mt-10">
                <div className="mb-4">
                    <label htmlFor="judul" className="block font-bold mb-1">Judul:</label>
                    <input
                        type="text"
                        id="judul"
                        className="w-full px-3 py-2 border bg-gray-100 rounded"
                        value={title}
                        onChange={(e) => setTitle(e.target.value)}
                    />
                </div>
                <div className="mb-4">
                    <label htmlFor="penulis" className="block font-bold mb-1">Penulis:</label>
                    <input
                        type="text"
                        id="penulis"
                        className="w-full px-3 py-2 border bg-gray-100 rounded"
                        value={author}
                        onChange={(e) => setAuthor(e.target.value)}
                    />
                </div>
                <div className="mb-4">
                    <label htmlFor="isi" className="block font-bold mb-1">Isi:</label>
                    <textarea
                        id="isi"
                        className="w-full px-3 py-2 border bg-gray-100 rounded"
                        value={content}
                        onChange={(e) => setContent(e.target.value)}>
                    </textarea>
                </div>
                <div className="mb-4">
                    <label htmlFor="gambar" className="block font-bold mb-1">Gambar:</label>
                    <input
                        type="file"
                        id="gambar"
                        accept="image/*"
                        className="w-full px-3 py-2 border bg-gray-100 rounded"
                        value={image}
                        onChange={(e) => setImage(e.target.value)}
                    />
                </div>
                <div className="flex justify-center">
                    <button type="submit" className="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded mr-2 mt-4"
                    onClick={(e) => addArticle(e)}>
                        Tambah Artikel
                    </button>
                    <button type="button" className="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded mt-4">
                        Clear
                    </button>
                </div>
            </form>
        </div>
    );
};

export default Tes;