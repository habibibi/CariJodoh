<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/recommendation.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <title>Recommendation</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <div class="recommend">
        <h1>Discover Your Matches</h1>
        <div class="recommend-container">
            <div class="flex-row gap-1">
                <div class="card-profile">
                    <div class="img-profile">
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="desc-profile">
                        <p class="card-nama">Test Nama</p>
                        <p>Lokasi: Tangerang Selatan</p>
                        <p>Hobi: Main Game</p>
                        <p>Interest: Coding</p>
                        <div class="flex-row items-center margin-auto">
                            <span class="detail-info">Umur: 22 Tahun</span>
                            <span class="detail-info">Tinggi: 160 cm</span>
                            <span class="detail-info">Agama: Islam</span>
                        </div>
                    </div>
                </div>
                <div class="card-profile">
                    <div class="img-profile">
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="desc-profile">
                        <p class="card-nama">Test Nama</p>
                        <p>Lokasi: Tangerang Selatan</p>
                        <p>Hobi: Main Game</p>
                        <p>Interest: Coding</p>
                        <div class="flex-row items-center margin-auto">
                            <span class="detail-info">Umur: 22 Tahun</span>
                            <span class="detail-info">Tinggi: 160 cm</span>
                            <span class="detail-info">Agama: Islam</span>
                        </div>
                    </div>
                </div>
                <div class="card-profile">
                    <div class="img-profile">
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="desc-profile">
                        <p class="card-nama">Test Nama</p>
                        <p>Lokasi: Tangerang Selatan</p>
                        <p>Hobi: Main Game</p>
                        <p>Interest: Coding</p>
                        <div class="flex-row items-center margin-auto">
                            <span class="detail-info">Umur: 22 Tahun</span>
                            <span class="detail-info">Tinggi: 160 cm</span>
                            <span class="detail-info">Agama: Islam</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-row gap-1">
                <div class="card-profile">
                    <div class="img-profile">
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="desc-profile">
                        <p class="card-nama">Test Nama</p>
                        <p>Lokasi: Tangerang Selatan</p>
                        <p>Hobi: Main Game</p>
                        <p>Interest: Coding</p>
                        <div class="flex-row items-center margin-auto">
                            <span class="detail-info">Umur: 22 Tahun</span>
                            <span class="detail-info">Tinggi: 160 cm</span>
                            <span class="detail-info">Agama: Islam</span>
                        </div>
                    </div>
                </div>
                <div class="card-profile">
                    <div class="img-profile">
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="desc-profile">
                        <p class="card-nama">Test Nama</p>
                        <p>Lokasi: Tangerang Selatan</p>
                        <p>Hobi: Main Game</p>
                        <p>Interest: Coding</p>
                        <div class="flex-row items-center margin-auto">
                            <span class="detail-info">Umur: 22 Tahun</span>
                            <span class="detail-info">Tinggi: 160 cm</span>
                            <span class="detail-info">Agama: Islam</span>
                        </div>
                    </div>
                </div>
                <div class="card-profile">
                    <div class="img-profile">
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="desc-profile">
                        <p class="card-nama">Test Nama</p>
                        <p>Lokasi: Tangerang Selatan</p>
                        <p>Hobi: Main Game</p>
                        <p>Interest: Coding</p>
                        <div class="flex-row items-center margin-auto">
                            <span class="detail-info">Umur: 22 Tahun</span>
                            <span class="detail-info">Tinggi: 160 cm</span>
                            <span class="detail-info">Agama: Islam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pagination">
            <div class="pagination-tab">
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
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>
</body>
</html>