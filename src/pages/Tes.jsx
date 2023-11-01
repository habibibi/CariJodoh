const Tes = () => {
    return (
        // <div className="flex flex-col gap-4 w-full items-center">
        //     <p>GAMBAR MUKA</p>
        //     <p className="text-2xl">Nama</p>
        //     <p className="text-xl">Umur</p>
        // </div>

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
                    />
                </div>
                <div className="mb-4">
                    <label htmlFor="penulis" className="block font-bold mb-1">Penulis:</label>
                    <input
                        type="text"
                        id="penulis"
                        className="w-full px-3 py-2 border bg-gray-100 rounded"
                    />
                </div>
                <div className="mb-4">
                    <label htmlFor="isi" className="block font-bold mb-1">Isi:</label>
                    <textarea
                        id="isi"
                        className="w-full px-3 py-2 border bg-gray-100 rounded">
                    </textarea>
                </div>
                <div className="mb-4">
                    <label htmlFor="gambar" className="block font-bold mb-1">Gambar:</label>
                    <input
                        type="file"
                        id="gambar"
                        accept="image/*"
                        className="w-full px-3 py-2 border bg-gray-100 rounded"
                    />
                </div>
                <div className="flex justify-center">
                    <button type="submit" className="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded mr-2 mt-4">
                        Tambah Artikel
                    </button>
                    <button type="button" className="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded mt-4">
                        Batal
                    </button>
                </div>
            </form>
        </div>
        );
}

export default Tes;