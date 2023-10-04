<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/browse.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <title>Browse</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <div class='container'>
        <h1>Find Your Matches</h1>
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
                            <option selected value="name_asc">Nama ↓</option>
                            <option value="name_desc">Nama ↑</option>
                            <option value="h_asc">Tinggi ↓</option>
                            <option value="h_desc">Tinggi ↑</option>
                        </select>
                    </div>

                    <button type="submit" id="apply">Apply</button>
                </div>
            </div>
            <div class='browse-container'>
                <div class='profiles-grid'>
                    <div class="profile-card">
                        <div class="img-profile">
                            <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                        </div>
                        <div class="desc-profile">
                            <p class="card-nama">Abdul Mamad</p>
                            <p>Lokasi: Tangerang Selatan</p>
                            <p>Hobi: Main Game</p>
                            <p>Interest: Coding</p>
                            <div class="detail-info">
                                <span>Umur: 22 Tahun</span>
                                <span>Tinggi: 160 cm</span>
                                <span>Agama: Islam</span>
                                <span>MBTI: INFP</span>
                            </div>
                        </div>
                    </div>
                    <div class="profile-card"></div>
                    <div class="profile-card"></div>
                    <div class="profile-card"></div>
                </div>
                <div class='pagination'>
                    <div class='pagination-tab'>
                        <button id="prevPage"><</button>
                        <button>1</button>
                        <button>2</button>
                        <button>...</button>
                        <button>9</button>
                        <button>10</button>
                        <button id="nextPage">></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>
</body>
</html>