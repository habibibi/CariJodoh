<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/register.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <title>CariJodoh</title>
</head>
<body>
    <div class="container">
        <div class="register-outer">
            <div class="register-form-section">
                <form class="register-form">
                    <div class="register-form-container" id="section1">
                        <h1>CariJodoh</h1>
                        <h2>Daftarkan dirimu segera di sini!</h2>
                        <div class="main-form-register">
                            <input id="username" type="username" placeholder="Username"/>
                            <input id="password" type="password" placeholder="Password"/>
                            <input id="confirmPassword" type="password" placeholder="Confirm Password"/>
                            <button type="button" id="registerButton">DAFTAR</button>
                        </div>
                        <div class="login-register">
                            Sudah punya akun? <a href="/public/user/login">Login</a>
                        </div>
                    </div>
                    <div class="register-form-container" id="section2">
                        <h3>Lengkapi Data Anda</h3>
                        <div class="main-form-register">
                            <input id="fullName" type="text" placeholder="Nama Lengkap"/>
                            <div class="flex-row">
                                <input id="name" type="text" placeholder="Nama Panggilan" class="w-half"/>
                                <input id="age" type="number" placeholder="Umur" class="ml-auto w-half"/>
                            </div>
                            <select id="gender" class="select-option">
                                <option value="">Gender</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <input id="contact" type="text" placeholder="Kontak (No HP atau Social Media)"/>
                            <input id="hobby" type="text" placeholder="Hobi"/>
                            <input id="interest" type="text" placeholder="Interest"/>
                            <div class="flex-row">
                                <input id="tinggiBadan" type="number" placeholder="Tinggi Badan" class="w-half"/>
                                <select id="agama" class="ml-auto w-half">
                                    <option value="">Agama</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                            </div>
                            <input id="domisili" type="text" placeholder="Domisili"/>
                            <div class="flex-row">
                                <button type="button" id="prev1">Previous</button>
                                <button type="button" id="next1" class="ml-auto">Next</button>
                            </div>
                        </div>
                    </div>
                    <div class="register-form-container" id="section3">
                        <h1>CariJodoh</h1>
                        <div class="main-form-register">
                            <select id="loveLanguage" name="loveLanguage" class="select-option">
                                <option value="">Love Language</option>
                                <option value="Words of Affirmation">Words of Affirmation</option>
                                <option value="Acts of Service">Acts of Service</option>
                                <option value="Receiving Gifts">Receiving Gifts</option>
                                <option value="Quality Time">Quality Time</option>
                                <option value="Physical Touch">Physical Touch</option>
                            </select>

                            <select id="mbti" name="mbti" class="select-option">
                                <option value="">MBTI</option>
                                <option value="INTJ">INTJ</option>
                                <option value="ENTJ">ENTJ</option>
                                <option value="INTP">INTP</option>
                                <option value="ENTP">ENTP</option>
                                <option value="INFJ">INFJ</option>
                                <option value="ENFJ">ENFJ</option>
                                <option value="INFP">INFP</option>
                                <option value="ENFP">ENFP</option>
                                <option value="ISTJ">ISTJ</option>
                                <option value="ESTJ">ESTJ</option>
                                <option value="ISFJ">ISFJ</option>
                                <option value="ESFJ">ESFJ</option>
                                <option value="ISTP">ISTP</option>
                                <option value="ESTP">ESTP</option>
                                <option value="ISFP">ISFP</option>
                                <option value="ESFP">ESFP</option>
                            </select>

                            <select id="zodiac" name="zodiac" class="select-option">
                                <option value="">Zodiac</option>
                                <option value="Aries">Aries</option>
                                <option value="Taurus">Taurus</option>
                                <option value="Gemini">Gemini</option>
                                <option value="Cancer">Cancer</option>
                                <option value="Leo">Leo</option>
                                <option value="Virgo">Virgo</option>
                                <option value="Libra">Libra</option>
                                <option value="Scorpio">Scorpio</option>
                                <option value="Sagittarius">Sagittarius</option>
                                <option value="Capricorn">Capricorn</option>
                                <option value="Aquarius">Aquarius</option>
                                <option value="Pisces">Pisces</option>
                            </select>
                            <input id="ketidaksukaan" type="text" placeholder="Ketidaksukaan"/>
                            <div class="flex-row bg-white input-statis">
                                <label class="w-half">Gambar Profile:</label>
                                <input class="w-half" type="file" id="imageUpload" name="imageFile" accept="image/*">
                            </div>
                            <div class="flex-row bg-white input-statis">
                                <label class="w-half">Video Profile (opsional):</label>
                                <input class="w-half" type="file" id="videoUpload" name="videoFile" accept="video/*">
                            </div>
                            <div class="flex-row">
                                <button type="button" id="prev2">Previous</button>
                                <button type="submit" id="realDaftar">DAFTAR!</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="register-title-section">
                <div class="register-title">
                    <h1>Selamat</h1>
                    <h1>Dating</h1>
                </div>
            </div>
        </div>
    </div>
    <script>
        function hasUppercase(str) {
            return /[A-Z]/.test(str);
        }

        function hasLowercase(str) {
            return /[a-z]/.test(str);
        }

        document.getElementById("registerButton").addEventListener("click", function () {
            const section1 = document.getElementById("section1");
            const section2 = document.getElementById("section2");
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            // Perform validation
            // Check username
            if (!username || username.length < 5){
                alert("Username minimal 5 karakter.");
                return;
            }

            // Check password
            if (!password || password.length < 5){
                alert("Password minimal 5 karakter.");
                return;
            } else if (!hasUppercase(password) || !hasLowercase(password)){
                alert("Password harus terdapat huruf besar dan huruf kecil.");
                return;
            }

            // Check confirm password
            if (password !== confirmPassword) {
                alert("Password dan Confirm Password tidak sama.");
                return;
            }

            // Move to next section
            section1.style.display = "none";
            section2.style.display = "flex";
        });

        document.getElementById("prev1").addEventListener("click", function () {
            const section1 = document.getElementById("section1");
            const section2 = document.getElementById("section2");

            // Move to next section
            section2.style.display = "none";
            section1.style.display = "flex";
        });

        document.getElementById("prev2").addEventListener("click", function () {
            const section2 = document.getElementById("section2");
            const section3 = document.getElementById("section3");

            // Move to next section
            section3.style.display = "none";
            section2.style.display = "flex";
        });

        document.getElementById("next1").addEventListener("click", function () {
            const section2 = document.getElementById("section2");
            const section3 = document.getElementById("section3");
            const fullName = section2.querySelector("#fullName").value;
            const name = section2.querySelector("#name").value;
            const age = section2.querySelector("#age").value;
            const contact = section2.querySelector("#contact").value;
            const hobby = section2.querySelector("#hobby").value;
            const interest = section2.querySelector("#interest").value;
            const tinggiBadan = section2.querySelector("#tinggiBadan").value;
            const agama = section2.querySelector("#agama").value;
            const domisili = section2.querySelector("#domisili").value;
            const selectedAgama = section2.querySelector("#agama").value;
            const gender = section2.querySelector("#gender").value;
            
            // Validasi
            if(!fullName || fullName.length < 2) {
                alert("Nama Lengkap minimal 3 karakter.");
                return;
            }

            if(!name || name.length < 2) {
                alert("Nama Panggilan minimal 3 karakter.");
                return;
            }

            if(!age || age < 12 || age > 100){
                alert("Umur tidak valid!")
                return;
            }

            if(!contact || contact.length < 5){
                alert("Contact minimal 5 karakter. (Bisa berupa id line, no WA, dll)");
            }

            if(!hobby || hobby.length < 5) {
                alert("Hobby minimal 5 karakter.");
                return;
            }

            if(!interest || interest.length < 5) {
                alert("Hobby minimal 5 karakter.");
                return;
            }

            if(!tinggiBadan || tinggiBadan < 100 || tinggiBadan > 300){
                alert("Tinggi badan tidak valid!")
                return;
            }

            if(!agama){
                alert("Pilih agama terlebih dahulu.")
                return;
            }

            if(!gender){
                alert("Pilih jenis kelamin terlebih dahulu.")
                return;
            }

            if(!domisili){
                alert("Masukkan domisili terlebih dahulu.")
                return;
            }

            // Move to next section
            section2.style.display = "none";
            section3.style.display = "flex";
        });

        const registerForm = document.querySelector(".register-form");

        registerForm.addEventListener("submit", async function (e) {
            e.preventDefault();
            const section2 = document.getElementById("section2");
            const fullName = section2.querySelector("#fullName").value;
            const name = section2.querySelector("#name").value;
            const age = section2.querySelector("#age").value;
            const contact = section2.querySelector("#contact").value;
            const hobby = section2.querySelector("#hobby").value;
            const interest = section2.querySelector("#interest").value;
            const tinggiBadan = section2.querySelector("#tinggiBadan").value;
            const agama = section2.querySelector("#agama").value;
            const domisili = section2.querySelector("#domisili").value;
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;
            const loveLanguage = document.getElementById("loveLanguage").value;
            const mbti = document.getElementById("mbti").value;
            const zodiac = document.getElementById("zodiac").value;
            const ketidaksukaan = document.getElementById("ketidaksukaan").value;
            const imageFile = document.getElementById("imageUpload").files[0];
            const videoFile = document.getElementById("videoUpload").files[0];
            const gender = document.getElementById("gender").value;

            // Validasi
            if(!loveLanguage){
                alert("Pilih love language terlebih dahulu.")
                return;
            }

            if(!mbti){
                alert("Pilih MBTI terlebih dahulu.")
                return;
            }

            if(!zodiac){
                alert("Pilih zodiac terlebih dahulu.")
                return;
            }

            if(!ketidaksukaan){
                alert("Masukkan ketidaksukaan terlebih dahulu.")
                return;
            }

            if(!imageFile){
                alert("Masukkan gambar muka anda terlebih dahulu.")
                return;
            }

            // AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/public/user/register");

            const formData = new FormData();
            formData.append("fullName", fullName);
            formData.append("name", name);
            formData.append("age", age);
            formData.append("contact", contact);
            formData.append("hobby", hobby);
            formData.append("interest", interest);
            formData.append("tinggiBadan", tinggiBadan);
            formData.append("agama", agama);
            formData.append("domisili", domisili);
            formData.append("username", username);
            formData.append("password", password);
            formData.append("loveLanguage", loveLanguage);
            formData.append("mbti", mbti);
            formData.append("zodiac", zodiac);
            formData.append("ketidaksukaan", ketidaksukaan);
            formData.append("imageFile", imageFile);
            formData.append("videoFile", videoFile);
            formData.append("gender", gender);

            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 201) {
                        const data = JSON.parse(this.responseText);
                        location.replace(data.redirect_url);
                    } else if(this.status == 409) {
                        alert("Username sudah ada!");
                    } else {
                        alert("An error occured, please try again!");
                    }
                }
            };
        });
    </script>
</body>
</html>