# CariJodoh
> Dibangun untuk memenuhi Tugas Besar IF3110 Pengembangan Aplikasi Berbasis Web
## Deskripsi Singkat
<div align="justify">

CariJodoh adalah sebuah platform yang bertujuan untuk membantu pengguna untuk mencari pasangan, berteman, dan berkomunikasi dengan satu sama lain melalu _chat system_. Platform ini menggabungkan arsitektur server yang beragam: sebuah Single Page Application (SPA) berbasis React, sebuah server monolitik yang ditenagai oleh _vanilla_ PHP, sebuah server REST yang didorong oleh Express.js, dan sebuah server SOAP berbasis Java yang menggunakan JAX-WS. Detail dari setiap server disediakan dalam folder masing-masing di dalam _src_.
</div>

## _Requirements_

- Docker Engine. [[Link Download untuk pengguna Windows]](https://www.docker.com/products/docker-desktop/)
- WSL 2 atau OS yang mampu menjalankan script .sh  
_tested on windows 11 and WSL 2_

## Menjalankan Server

1. Jalankan Docker engine atau Docker Desktop untuk pengguna windows.
2. Masuk ke folder _repository_ hasil _clone_, lalu jalankan _script_ berikut pada terminal.

```
./build-image.sh
```

3. Lalu jalankan perintah berikut pada terminal.

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
