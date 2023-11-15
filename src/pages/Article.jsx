import { useState, useRef } from "react";
import { toast } from "react-toastify";
import Axios from "../config/Axios";

const Article = () => {
  const [author, setAuthor] = useState("");
  const [title, setTitle] = useState("");
  const [content, setContent] = useState("");
  const [image, setImage] = useState("");
  const imageInputRef = useRef(null);

  const resetImageInput = () => {
    if (imageInputRef.current) {
      imageInputRef.current.value = "";
    }
  };

  const handleImage = async (e) => {
    const file = e.target.files[0];
    if (file) {
      const fileSizeLimit = 1024 * 1024;
      if (file.size <= fileSizeLimit) {
        const reader = new FileReader();
        reader.onload = function (event) {
          var res = event.target.result.split(",")[1];
          setImage(res);
        };
        reader.readAsDataURL(file);
      } else {
        e.target.value = null;
        toast.error("Gambar tidak boleh melebihi 1MB!");
      }
    }
  };

  const addArticle = async (e) => {
    e.preventDefault();
    let trimmedTitle = title.trim();
    let trimmedAuthor = author.trim();
    let trimmedContent = content.trim();

    // Validasi Kelengkapan
    if (!trimmedTitle) {
      toast.error("Masukkan judul artikel terlebih dahulu!");
      return;
    } else if (!trimmedAuthor) {
      toast.error("Masukkan penulis artikel terlebih dahulu!");
      return;
    } else if (trimmedContent < 50) {
      toast.error("Isi artikel minimal 50 karakter!");
      return;
    } else if (!image) {
      toast.error("Masukkan gambar artikel terlebih dahulu!");
      return;
    }

    // Validasi Format
    if (trimmedContent.length > 900) {
      toast.error("Isi tidak boleh melebihi 900 karakter!");
      return;
    } else if (trimmedTitle.length > 100) {
      toast.error("Judul tidak boleh melebihi 100 karakter!");
      return;
    } else if (trimmedAuthor.length > 100) {
      toast.error("Penulis tidak boleh melebihi 100 karakter!");
      return;
    }

    const body = {
      author: trimmedAuthor,
      title: trimmedTitle,
      content: trimmedContent,
      image: image,
    };

    try {
      const response = await Axios.post(
        import.meta.env.VITE_API_URL + "/article",
        body,
        { withCredentials: true }
      );
      setAuthor("");
      setContent("");
      setImage("");
      setTitle("");
      resetImageInput();
      toast.success(response.data.message);
    } catch (error) {
      toast.error(
        error.response.data.message || "Tambah artikel gagal, silakan coba lagi"
      );
    }
  };

  return (
    <div className="mb-5">
      <div className="flex justify-center mt-5">
        <h1 className="font-['Garamond'] text-3xl font-bold">TAMBAH ARTIKEL</h1>
      </div>

      <form className="max-w-2xl mx-auto p-4 bg-[#FFD2DA] rounded shadow mt-10">
        <div className="mb-4">
          <label htmlFor="judul" className="block font-bold mb-1">
            Judul:
          </label>
          <input
            type="text"
            id="judul"
            className="w-full px-3 py-2 border bg-gray-100 rounded"
            value={title}
            onChange={(e) => setTitle(e.target.value)}
          />
        </div>
        <div className="mb-4">
          <label htmlFor="penulis" className="block font-bold mb-1">
            Penulis:
          </label>
          <input
            type="text"
            id="penulis"
            className="w-full px-3 py-2 border bg-gray-100 rounded"
            value={author}
            onChange={(e) => setAuthor(e.target.value)}
          />
        </div>
        <div className="mb-4">
          <label htmlFor="isi" className="block font-bold mb-1">
            Isi:
          </label>
          <textarea
            id="isi"
            className="w-full px-3 py-2 border bg-gray-100 rounded"
            value={content}
            onChange={(e) => setContent(e.target.value)}
          ></textarea>
        </div>
        <div className="mb-4">
          <label htmlFor="gambar" className="block font-bold mb-1">
            Gambar:
          </label>
          <input
            type="file"
            ref={imageInputRef}
            id="gambar"
            accept="image/*"
            className="w-full px-3 py-2 border bg-gray-100 rounded"
            onChange={(e) => handleImage(e)}
          />
        </div>
        <div className="flex justify-center">
          <button
            type="submit"
            className="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded mr-2 mt-4"
            onClick={(e) => addArticle(e)}
          >
            Tambah Artikel
          </button>
          <button
            type="button"
            className="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded mt-4"
            onClick={() => {
              setAuthor("");
              setContent("");
              setImage("");
              setTitle("");
              resetImageInput();
            }}
          >
            Clear
          </button>
        </div>
      </form>
    </div>
  );
};

export default Article;
