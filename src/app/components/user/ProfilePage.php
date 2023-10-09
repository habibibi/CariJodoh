<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/profile.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <title>CariJodoh</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <div class="container">
        <div class="view_detail">
            <div class="header">
                <img src="<?= BASE_URL ?>/images/profile/<?= $_SESSION['user_id'] ?>.jpg" alt="profile_picture" class="profile_picture">
                <input type="file" id="imageInput" name="Foto Profil" accept="image/*">
            </div>
            <form class="profile_detail">
                <label for="fullNameInput"> Nama Lengkap </label>
                <p id="fullName"> </p>
                <input type="text" id="fullNameInput" placeholder="Masukkan nama lengkap..">

                <label for="nameInput"> Nama Panggilan </label>
                <p id="name"> </p>
                <input type="text" id="nameInput" placeholder="Masukkan nama panggilan..">

                <label for="genderInput"> Jenis Kelamin </label>
                <p id="gender"> </p>
                <select id="genderInput" name="gender">
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>

                <label for="domisiliInput"> Domisili </label>
                <p id="domisili"> </p>
                <input type="text" id="domisiliInput" placeholder="Masukkan domisili..">

                <label for="ageInput"> Umur </label>
                <p id="age"> </p>
                <input type="number" id="ageInput">

                <label for="tinggiBadanInput"> Tinggi Badan </label>
                <p id="tinggiBadan"> </p>
                <input type="number" id="tinggiBadanInput">


                <label for="agamaInput"> Agama </label>
                <p id="agama"> </p>
                <select id="agamaInput">
                    <option value="Islam">Islam</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Konghucu">Konghucu</option>
                </select>

                <label for="hobbyInput"> Hobi </label>
                <p id="hobby"> </p>
                <input type="text" id="hobbyInput" placeholder="Masukkan hobi..">

                <label for="interestInput"> Interest </label>
                <p id="interest"> </p>
                <input type="text" id="interestInput" placeholder="Masukkan interest..">

                <label for="ketidaksukaanInput"> Ketidaksukaan </label>
                <p id="ketidaksukaan"> </p>
                <input type="text" id="ketidaksukaanInput" placeholder="Masukkan ketidaksukaan..">



                <label for=loveLanguageInput> Love Language </label>
                <p id="loveLanguage"> </p>
                <select id="loveLanguageInput">
                    <option value="Words of Affirmation">Words of Affirmation</option>
                    <option value="Acts of Service">Acts of Service</option>
                    <option value="Receiving Gifts">Receiving Gifts</option>
                    <option value="Quality Time">Quality Time</option>
                    <option value="Physical Touch">Physical Touch</option>
                </select>

                <label for="mbtiInput"> MBTI </label>
                <p id="mbti"> </p>
                <select id="mbtiInput" name="mbti" class="select-option">
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

                <label for=zodiacInput> Zodiak </label>
                <p id="zodiac"> </p>
                <select id="zodiacInput" name="zodiac" class="select-option">
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

                <label for="kontakInput"> Kontak </label>
                <p id="contact"> </p>
                <input type="text" id="contactInput" placeholder="Masukkan kontak..">

                <div class="flex-col gap-4">
                    <label>Video Perkenalan</label>
                    <?php
                        $videoFilePath = BASE_URL . '/videos/' . $_SESSION['user_id'] . '.mp4';
                        $checkVideoPath = __DIR__ . '/../../../public/videos/' . $_SESSION['user_id'] . '.mp4';
                        if (file_exists($checkVideoPath)) {
                            echo '
                            <video id="video" height="240" controls>
                                <source src="' . $videoFilePath . '" type="video/mp4">
                            </video>';
                        } else {
                            echo 'No video available';
                        }
                    ?>
                    <input type="file" id="videoInput" name="Video Perkenalan" accept="video/*">
                </div>

                <button type="button" id="editButton" class="mt-4"> Edit </button>
                
                <div class="form-buttons">
                    <button type="button" id="cancelButton"> Cancel </button>
                    <button type="button" id="saveButton"> Save </button>
                </div>
            </div>
            <div class="mx-auto button-container">
                <button type="button" class="logout-user">Logout</button>
            </div>
        </div>
        <div class="popup-confirm">
            <h1>Konfirmasi</h1>
            <p>Apakah Anda yakin untuk menyimpan perubahan?</p>
            <div class="button-container-popup">
                <button type="button" class="no-button"><strong>No</strong></button>
                <button type="button" class="yes-button"><strong>Yes</strong></button>
            </div>
        </div>
        <div class="overlay"></div>
    </div>
    <? include(__DIR__ . '/../main/footer/Footer.php'); ?>
    <script src="<?= BASE_URL ?>/js/profile.js"></script>
</body>
</html>