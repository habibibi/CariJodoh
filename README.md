# Aplikasi Berbasis Web: CariJodoh

![Logo CariJodoh](src/public/images/assets/logo.webp){width=50%}

## Deskripsi Singkat

> <h3>Halo para pejuang cinta!</h3>

<div align="justify">
    <p>CariJodoh adalah sebuah perangkat lunak berbasis web yang memungkinkan Anda menemukan calon kekasih dalam hitungan menit. Anda bisa mencari pengguna lain berdasarkan nama, minat, agama, hingga MBTI. Bagi Anda yang pemalu atau malas mencari, jangan khawatir, sebab CariJodoh juga menyediakan beranda berisi rekomendasi orang untuk Anda! Temukan seseorang yang cocok dengan Anda, langsung sukai profilnya dan atur jadwal kencan, ya. Segera daftarkan diri di CariJodoh dan buat profilmu semenarik mungkin bagi para pencari pasangan!</p>
</div>

---

## _Requirements_

- Docker Desktop. [Klik _link_ ini untuk melakukan instalasi](https://www.docker.com/products/docker-desktop/).

## Instalasi

1. _Clone_ repositori ini dengan memasukkan _script_ berikut pada terminal

```
git clone -b main https://gitlab.informatika.org/if3110-2023-k02-01-35/tugas-besar-1.git
```

## Menjalankan Server

1. Buka Docker Desktop.
2. Buatlah file .env menggunakan format dari .env.example
3. Jalankan _script_ berikut setelah masuk ke folder hasil _clone_ pada terminal

```
docker build -t tubes-1:latest .
```

4. Jalankan _script_ berikut pada terminal

```
docker compose up -d
```

5. Jalankan _script_ berikut pada terminal untuk membuat _user seed_

```
docker exec -it tugas-besar-1-web-1 php "./app/seed/seed_users.php"
```

6. Jalankan _script_ berikut pada terminal untuk membuat _admin seed_

```
docker exec -it tugas-besar-1-web-1 php "./app/seed/seed_admin.php"
```

7. Jalankan dua _command_ berikut untuk memberikan akses _image_ dan _video_.

```
docker exec -it tugas-besar-1-web-1 chmod -R 777 /var/www/html/public/videos
```

```
docker exec -it tugas-besar-1-web-1 chmod -R 777 /var/www/html/public/images/profile
```

8. Buka _browser_ favorit dan masukkan URL berikut untuk memulai aplikasi

```
http://localhost:8080/public/user/login
```

## Beberapa Tangkapan Layar Aplikasi

- Fitur _Login_
  - ![SS](docs/visualisasi/login.JPG)
- Fitur _Register_
  - ![SS](docs/visualisasi/register1.JPG)
  - ![SS](docs/visualisasi/register2.JPG)
  - ![SS](docs/visualisasi/register3.JPG)
- Fitur _Recommendation_
  ![SS](docs/visualisasi/recommendation.JPG)
- Fitur _Browse_
  - ![SS](docs/visualisasi/browse1.JPG)
  - ![SS](docs/visualisasi/browse2.JPG)
- Fitur _Profile_
  - ![SS](docs/visualisasi/myprofile1.JPG)
  - ![SS](docs/visualisasi/myprofile2.JPG)
  - ![SS](docs/visualisasi/othersprofile.JPG)
- Fitur _Edit Profile_
  - ![SS](docs/visualisasi/editprofile.JPG)
- Fitur _Like User_
  - ![SS](docs/visualisasi/likeuser.JPG)
- Fitur _Notification_
  - ![SS](docs/visualisasi/notification.JPG)
- Fitur _Likes_
  - ![SS](docs/visualisasi/likes.JPG)
- Fitur _Admin-Dashboard_
  - ![SS](docs/visualisasi/admin-dashboard.JPG)
- Fitur _Admin-User_
  - ![SS](docs/visualisasi/admin-user.JPG)
  - ![SS](docs/visualisasi/admin-add-user.JPG)
  - ![SS](docs/visualisasi/admin-view-user.JPG)
  - ![SS](docs/visualisasi/admin-edit-user.JPG)
  - ![SS](docs/visualisasi/admin-delete-user.JPG)
- Fitur _Admin-Notification_
  - ![SS](docs/visualisasi/admin-notification.JPG)
  - ![SS](docs/visualisasi/admin-notification2.JPG)
  - ![SS](docs/visualisasi/admin-delete-notification.JPG)
- Fitur _Admin-Likes_
  - ![SS](docs/visualisasi/admin-likes.JPG)
  - ![SS](docs/visualisasi/admin-likes2.JPG)
  - ![SS](docs/visualisasi/admin-delete-likes.JPG)
- Fitur _Pagination_
  - ![SS](docs/visualisasi/pagination.JPG)
- Fitur _Not Found_
  - ![SS](docs/visualisasi/notfound.JPG)

## Pembagian Tugas

|        Fitur         |        _Side_        |       NIM Pembuat        |
| :------------------: | :------------------: | :----------------------: |
|       _Login_        | _Client_<br>_Server_ | `13521140`<br>`13521124` |
|      _Register_      | _Client_<br>_Server_ | `13521140`<br>`13521124` |
|       _Browse_       | _Client_<br>_Server_ | `13521169`<br>`13521169` |
|   _Recommendation_   | _Client_<br>_Server_ | `13521124`<br>`13521124` |
|      _Profile_       | _Client_<br>_Server_ | `13521140`<br>`13521169` |
|    _Edit Profile_    | _Client_<br>_Server_ | `13521169`<br>`13521169` |
|     _Like User_      | _Client_<br>_Server_ | `13521140`<br>`13521140` |
|    _Notification_    | _Client_<br>_Server_ | `13521124`<br>`13521124` |
|       _Likes_        | _Client_<br>_Server_ | `13521124`<br>`13521140` |
|  _Admin-Dashboard_   | _Client_<br>_Server_ | `13521124`<br>`13521124` |
|     _Admin-User_     | _Client_<br>_Server_ | `13521124`<br>`13521124` |
| _Admin-Notification_ | _Client_<br>_Server_ | `13521124`<br>`13521124` |
|    _Admin-Likes_     | _Client_<br>_Server_ | `13521124`<br>`13521124` |
|       _Header_       |       _Client_       |        `13521124`        |
|       _Footer_       |       _Client_       |        `13521124`        |
|     _Pagination_     | _Client_<br>_Server_ | `13521124`<br>`13521169` |
|     _Not Found_      | _Client_<br>_Server_ | `13521124`<br>`13521124` |

## BONUS: Hasil Tes Google Lightouse

<div align="justify">
    <p>Berikut adalah beberapa tangkapan layar hasil terbaik dari pengujian setiap halaman dengan menggunakan Google Lighthouse. Detail nilai untuk setiap halaman dapat dilihat pada tabel di bawah.</p>
</div>

![SS](docs/lighthouse/login.png)
![SS](docs/lighthouse/register.png)
![SS](docs/lighthouse/recommendation.png)
![SS](docs/lighthouse/browse.png)
![SS](docs/lighthouse/user-notification.png)
![SS](docs/lighthouse/user-likes.png)
![SS](docs/lighthouse/my-profile.png)
![SS](docs/lighthouse/view-profile.png)
![SS](docs/lighthouse/admin-dashboard.png)
![SS](docs/lighthouse/admin-users.png)
![SS](docs/lighthouse/admin-view-user.png)
![SS](docs/lighthouse/admin-notification.png)
![SS](docs/lighthouse/admin-likes.png)

|       Halaman        | _Performance_ | _Accessibility_ | _Best Practices_ |
| :------------------: | :-----------: | :-------------: | :--------------: |
|       _Login_        |      100      |       95        |       100        |
|      _Register_      |      100      |       95        |       100        |
|   _Recommendation_   |      100      |       95        |       100        |
|       _Browse_       |      98       |       96        |       100        |
| _User Notification_  |      95       |       100       |       100        |
|     _User Likes_     |      95       |       100       |       100        |
|     _My Profile_     |      99       |       100       |       100        |
|  _Other's Profile_   |      100      |       95        |       100        |
|  _Admin-Dashboard_   |      100      |       95        |       100        |
|    _Admin-Users_     |      98       |       96        |       100        |
|  _Admin-View-Users_  |      100      |       100       |        92        |
| _Admin-Notification_ |      84       |       97        |       100        |
|    _Admin-Likes_     |      82       |       97        |       100        |
