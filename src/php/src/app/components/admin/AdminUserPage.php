<?php
    $nonce = bin2hex(random_bytes(16));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/browseAdmin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'nonce-<?= $nonce ?>'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; object-src 'none'; form-action 'self'; base-uri 'self';">
    <title>Admin's Users</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/NavbarAdmin.php');
    ?>
    <main class='container'>
        <div class="flex-row header add-header">
            <h1>Users</h1>
            <button class="add-button"><strong>Add</strong></button>
        </div>
        <div class='main-container'>
            <div class='left-container'>
                <h1>Opsi</h1>
                <div class='options-container'>
                    <div class='option'>
                        <h2>Pencarian</h2>
                        <h3>Nama</h3>
                        <input type="text" name="name_search" id="name_search" placeholder="masukkan nama..">
                        <h3>Interest</h3>
                        <input type="text" name="interest_search" id="interest_search" placeholder="masukkan interest..">
                    </div>
                    <div class='option'>
                        <h2>Filter</h2>
                            <h3>Agama</h3>
                            <select id="agama" name="agama" class="select-option">
                                    <option value="">-</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Konghucu">Konghucu</option>
                            </select>

                            <h3>MBTI</h3>
                            <select id="mbti" name="mbti" class="select-option">
                                    <option value="">-</option>
                                    <option value="ESTJ">ESTJ</option>
                                    <option value="ESTP">ESTP</option>
                                    <option value="ESFJ">ESFJ</option>
                                    <option value="ESFP">ESFP</option>
                                    <option value="ENTJ">ENTJ</option>
                                    <option value="ENTP">ENTP</option>
                                    <option value="ENFJ">ENFJ</option>
                                    <option value="ENFP">ENFP</option>
                                    <option value="ISTJ">ISTJ</option>
                                    <option value="ISTP">ISTP</option>
                                    <option value="ISFJ">ISFJ</option>
                                    <option value="ISFP">ISFP</option>
                                    <option value="INTJ">INTJ</option>
                                    <option value="INTP">INTP</option>
                                    <option value="INFJ">INFJ</option>
                                    <option value="INFP">INFP</option>
                                </select>
                            </select>
                    </div>
                    <div class='option'>
                        <h2>Pengurutan</h2>
                        <select name="sort" id="sort" class="select-option">
                            <option selected value="name_asc">Nama ↑</option>
                            <option value="name_desc">Nama ↓</option>
                            <option value="height_asc">Tinggi ↑</option>
                            <option value="height_desc">Tinggi ↓</option>
                            <option value="umur_asc">Umur ↑</option>
                            <option value="umur_desc">Umur ↓</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class='right-container'>
                <div class='browser-container'>
                    <div class='profiles-grid'>
                    </div>
                </div>
                <div class="pagination">
                    <div class="pagination-tab">
                        <button id="prevPage"><</button>
                        <div id="button-pagination"></div>
                        <button id="nextPage">></button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <form class="register-form">
                <div class="register-form-container" id="section1">
                    <h1>CariJodoh</h1>
                    <div class="main-form-register">
                        <input id="form-username" type="username" placeholder="Username"/>
                        <input id="form-password" type="password" placeholder="Password"/>
                        <input id="form-confirmPassword" type="password" placeholder="Confirm Password"/>
                    </div>
                </div>
                <div class="register-form-container" id="section2">
                    <h3>Lengkapi Data</h3>
                    <div class="main-form-register">
                        <input id="form-fullName" type="text" placeholder="Nama Lengkap"/>
                        <div class="flex-row gap-4 flex-col-sm">
                            <input id="form-name" type="text" placeholder="Nama Panggilan" class="w-half"/>
                            <input id="form-age" type="number" placeholder="Umur" class="ml-auto w-half"/>
                        </div>
                        <select id="form-gender" class="select-option">
                            <option value="">Gender</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <input id="form-contact" type="text" placeholder="Kontak (No HP atau Social Media)"/>
                        <input id="form-hobby" type="text" placeholder="Hobi"/>
                        <input id="form-interest" type="text" placeholder="Interest"/>
                        <div class="flex-row gap-4 flex-col-sm">
                            <input id="form-tinggiBadan" type="number" placeholder="Tinggi Badan" class="w-half"/>
                            <select id="form-agama" class="ml-auto w-half">
                                <option value="">Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        <input id="form-domisili" type="text" placeholder="Domisili"/>
                    </div>
                </div>
                <div class="register-form-container" id="section3">
                    <div class="main-form-register">
                        <select id="form-loveLanguage" name="loveLanguage" class="select-option">
                            <option value="">Love Language</option>
                            <option value="Words of Affirmation">Words of Affirmation</option>
                            <option value="Acts of Service">Acts of Service</option>
                            <option value="Receiving Gifts">Receiving Gifts</option>
                            <option value="Quality Time">Quality Time</option>
                            <option value="Physical Touch">Physical Touch</option>
                        </select>

                        <select id="form-mbti" name="mbti" class="select-option">
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

                        <select id="form-zodiac" name="zodiac" class="select-option">
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
                        <input id="form-ketidaksukaan" type="text" placeholder="Ketidaksukaan"/>
                        <div class="flex-row bg-white input-statis">
                            <label class="w-half">Gambar Profile:</label>
                            <input class="w-half" type="file" id="form-imageUpload" name="imageFile" accept="image/*">
                        </div>
                        <div class="flex-row bg-white input-statis">
                            <label class="w-half">Video Profile (opsional):</label>
                            <input class="w-half" type="file" id="form-videoUpload" name="videoFile" accept="video/*">
                        </div>
                        <div class="flex-row button-container">
                            <button type="button" id="cancelDaftar">Cancel</button>
                            <button type="submit" id="realDaftar">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        echo '<script nonce="' . $nonce . '">const BASE_URL = "' . BASE_URL . '";</script>';
    ?>
    <script src="<?= BASE_URL ?>/js/browseAdmin.js"></script>
</body>
</html>