# CONFIG: Aplikasi CariJodoh

## Deskripsi Singkat
<div align="justify">
    <p>CONFIG adalah _repository_ yang berisi berbagai pengaturan awal yang diperlukan oleh CariJodoh, sebuah aplikasi kencan. Agar dapat menjalankan serta menggunakan aplikasi tersebut, ikuti langkah-langkah berikut ini.
</div>

## _Requirements_

- Docker Desktop. [Klik _link_ ini untuk melakukan instalasi](https://www.docker.com/products/docker-desktop/).

## Instalasi Aplikasi CariJodoh

1. _Clone_ 5 (lima) buah repositori dengan memasukkan _script_ berikut pada terminal

```
git clone -b main https://gitlab.informatika.org/if3110-2023-02-35/tugas-besar-2-config.git
```
```
git clone -b main https://gitlab.informatika.org/if3110-2023-02-35/tugas-besar-2-php.git
```
```
git clone -b main https://gitlab.informatika.org/if3110-2023-02-35/tugas-besar-2-rest.git
```
```
git clone -b main https://gitlab.informatika.org/if3110-2023-02-35/tugas-besar-2-soap.git
```
```
git clone -b main https://gitlab.informatika.org/if3110-2023-02-35/tugas-besar-2-spa.git
```

## Menjalankan Server

1. Buka Docker Desktop.
2. Masuk ke folder "tugas-besar-2-config" hasil _clone_, lalu jalankan _script_ berikut pada terminal.

```
cd ../tugas-besar-2-config
./build-image.sh
```

3. Lalu jalankan _script_ berikut pada terminal.

```
docker compose up -d
```

4. Buka _browser_ favorit dan masukkan URL berikut untuk memulai aplikasi sebagai pengguna,

```
http://localhost:8080/public/user/login
```
atau masukkan URL berikut untuk memulai aplikasi sebagai anggota tim _security_.
```
http://localhost:5173/
```
