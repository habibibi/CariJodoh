# CariJodoh

![Logo CariJodoh](src/public/images/assets/logo.webp){width=200%}

## Deskripsi Singkat
> <h3>Halo para pejuang cinta!</h3> 
<div align="justify">
    <p>CariJodoh adalah sebuah perangkat lunak berbasis web yang memungkinkan Anda menemukan calon kekasih dalam hitungan menit. Anda bisa mencari pengguna lain berdasarkan nama, minat, agama, hingga MBTI. Bagi Anda yang pemalu atau malas mencari, jangan khawatir, sebab CariJodoh juga menyediakan beranda berisi rekomendasi orang untuk Anda! Temukan seseorang yang cocok dengan Anda, langsung sukai profilnya dan atur jadwal kencan, ya. Segera daftarkan diri di CariJodoh dan buat profilmu semenarik mungkin bagi para pencari pasangan!</p>
</div>

----

## _Requirements_
- Docker Desktop. [Klik _link_ ini untuk melakukan instalasi](https://www.docker.com/products/docker-desktop/).

## Instalasi
1. _Clone_ repositori ini dengan memasukkan _script_ berikut pada terminal
```
git clone -b main https://gitlab.informatika.org/if3110-2023-k02-01-35/tugas-besar-1.git
```
2. ...

## Menjalankan Server
1. Buka Docker Desktop.
2. Jalankan _script_ berikut setelah masuk ke folder hasil _clone_ pada terminal
```
docker build -t tubes-1:latest .
```
3. Jalankan _script_ berikut pada terminal
```
docker compose up -d
```
4. Jalankan Jalankan _script_ berikut pada terminal untuk membuat _user seed_
```
docker exec -it tugas-besar-1-web-1 php "./app/seed/seed_users.php"
```
5. Jalankan Jalankan _script_ berikut pada terminal untuk membuat _admin seed_
```
docker exec -it tugas-besar-1-web-1 php "./app/seed/seed_admin.php"
```
6. Buka _browser_ favorit dan masukkan URL berikut untuk memulai aplikasi
```
http://localhost:8080/public/user/login
```


## Beberapa Tangkapan Layar Aplikasi
- Fitur _Login_
![SS](docs/visualisasi/login.JPG)
- Fitur _Register_
![SS]()
- Fitur _Recommendation_
![SS](docs/visualisasi/recommendation.JPG)


## Pembagian Tugas
| Fitur | _Side_ | NIM Pembuat
| :---: | :---: | :---:
| _Login_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Register_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Browse_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Profile_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Recommendation_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Notification_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Likes_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Like User_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Admin-Dashboard_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Admin-User_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Admin-Notification_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Admin-Likes_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Header_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Footer_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`



## BONUS: Hasil Tes Google Lightouse
