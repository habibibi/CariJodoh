<?php
    $nonce = bin2hex(random_bytes(16));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/user.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'nonce-<?= $nonce ?>'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; object-src 'none'; form-action 'self'; base-uri 'self';">
    <title>CariJodoh</title>
</head>
<body>
    <div class="container">
        <div class="login-outer">
            <div class="login-form-section">
                <div class="login-form">
                    <div class="login-form-container">
                        <h1>CariJodoh</h1>
                        <h2>Selamat datang kembali!</h2>
                        <form class="main-form-login">
                            <input type="username" placeholder="Username" id="username"/>
                            <input type="password" placeholder="Password" id="password"/>
                            <button type="submit">MASUK</button>
                        </form>
                        <div class="login-register">
                            Belum punya akun? <a href="/public/user/register">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="login-title-section">
                <div class="login-title">
                    <h1>Selamat</h1>
                    <h1>Dating</h1>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= BASE_URL ?>/js/globals.js"></script>
    <script nonce="<?= $nonce ?>">
        const formLogin = document.querySelector(".main-form-login");

        // AJAX
        formLogin.addEventListener("submit", async function (e) {
            e.preventDefault();
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            if(username && password){
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "/public/user/login");

                const formData = new FormData();
                formData.append("username", username);
                formData.append("password", password);

                xhr.send(formData);
                xhr.onreadystatechange = function () {
                    if (this.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 201) {
                            const data = JSON.parse(this.responseText);
                            location.replace(data.redirect_url);
                        } else if(this.status === 401){
                            showToast("Username atau password salah!");
                        } else {
                            showToast("Gagal login!");
                        }
                    }
                };
            } else {
                showToast("Lengkapi Form!");
            }
        })
    </script>
</body>
</html>