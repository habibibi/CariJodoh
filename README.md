# Aplikasi Berbasis Web: CariJodoh

![Logo CariJodoh](src/public/images/assets/logo.webp){width=50%}

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
    * ![SS](docs/visualisasi/login.JPG)
- Fitur _Register_
    * ![SS](docs/visualisasi/register1.JPG)
    * ![SS](docs/visualisasi/register2.JPG)
    * ![SS](docs/visualisasi/register3.JPG)
- Fitur _Recommendation_
![SS](docs/visualisasi/recommendation.JPG)
- Fitur _Browse_
    * ![SS](docs/visualisasi/browse1.JPG)
    * ![SS](docs/visualisasi/browse2.JPG)
- Fitur _Profile_
    * ![SS](docs/visualisasi/myprofile1.JPG)
    * ![SS](docs/visualisasi/myprofile2.JPG)
    * ![SS](docs/visualisasi/othersprofile.JPG)
- Fitur _Edit Profile_
    * ![SS](docs/visualisasi/editprofile.JPG)
- Fitur _Like User_
    * ![SS](docs/visualisasi/likeuser.JPG)
- Fitur _Notification_
    * ![SS](docs/visualisasi/notification.JPG)
- Fitur _Likes_
    * ![SS](docs/visualisasi/likes.JPG)
- Fitur _Admin-Dashboard_
    * ![SS](docs/visualisasi/admin-dashboard.JPG)
- Fitur _Admin-User_
    * ![SS](docs/visualisasi/admin-user.JPG)
- Fitur _Admin-Notification_
    * ![SS](docs/visualisasi/admin-notification.JPG)
    * ![SS](docs/visualisasi/admin-notification2.JPG)
- Fitur _Admin-Likes_
    * ![SS](docs/visualisasi/admin-likes.JPG)
    * ![SS](docs/visualisasi/admin-likes2.JPG)
- Fitur _Pagination_
    * ![SS](docs/visualisasi/pagination.JPG)
- Fitur _Not Found_
    * ![SS](docs/visualisasi/notfound.JPG)
    

## Pembagian Tugas
| Fitur | _Side_ | NIM Pembuat
| :---: | :---: | :---:
| _Login_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Register_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Browse_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Recommendation_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Profile_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Edit Profile_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Like User_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Notification_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Likes_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Admin-Dashboard_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Admin-User_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Admin-Notification_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Admin-Likes_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Header_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Footer_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Pagination_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`
| _Not Found_ | _Server_<br>_Client_ | `13521XXX`<br>`13521XXX`



## BONUS: Hasil Tes Google Lightouse
<div align="justify">
    <p>Berikut adalah beberapa tangkapan layar hasil terbaik dari pengujian setiap halaman dengan menggunakan Google Lighthouse. Detail nilai untuk setiap halaman dapat dilihat pada tabel di bawah. <b>Catatan: Kami memiliki bukti tangkapan layar lengkap untuk setiap halaman, hanya saja tidak disertakan di sini demi efisiensi.<b></p>
</div>

![SS](docs/lighthouse/register.jpg)
![SS](docs/lighthouse/recommendation.jpg)
![SS](docs/lighthouse/profile.JPG)
![SS](docs/lighthouse/admin-likes.jpg)

| Halaman | _Performance_ | _Accessibility_ | _Best Practices_
| :---: | :---: | :---: | :---:
| _Login_ | 96 | 95 | 100
| _Register_ | 99 | 95 | 100
| _Recommendation_ | 91 | 95 | 100
| _Browse_ | 85 | 96 | 100
| _Notification_ | 88 | 100 | 100
| _Likes_ | 89 | 100 | 100
| _My Profile_ | 89 | 100 | 100
| _Other's Profile_ | 90 | 95 | 100
| _Admin-Dashboard_ | 81 | 95 | 100
| _Admin-User_ | 87 | 96 | 100
| _Admin-Notification_ | 92 | 97 | 100
| _Admin-Likes_ | 95 | 97 | 100