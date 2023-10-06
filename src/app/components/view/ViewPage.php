<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/view.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
        <title><?= $this->data['profile']->nama_panggilan ?></title>
    </head>
    <body>
        <?php
            include(__DIR__ . '/../main/navbar/Navbar.php');
        ?>
        <main class="view-profile">
            <div class="container">
                <div class="header">
                    <div class="img-profile">
                        <img src="<?= BASE_URL ?>/images/profile/<?= $this->data['profile']->user_id ?>.jpg" alt="profile"/>
                    </div>
                    <div class="nama">
                        <h1><?= $this->data['profile']->nama_lengkap ?></h1>
                        <h2>Panggil saya: <?= $this->data['profile']->nama_panggilan ?></h2>
                    </div>
                    <button class="like-button" <?= $this->data['liked'] == "true" || $this->data['liked'] == "pending" ? 'disabled' : '' ?>>Like</button>
                </div>
                <div class="profil-utama">
                    <div class="video">
                        <h2>Video Perkenalan</h2>
                        <video controls>
                            <source src="<?= BASE_URL ?>/videos/<?= $this->data['profile']->user_id ?>.mp4" type="video/mp4">
                        </video>
                    </div>
                    <div class="profil">
                        <h2>Profil</h2>
                        <div class="desc-profile">
                            <p>Lokasi: <?= $this->data['profile']->domisili ?></p>
                            <p>Zodiak: <?= $this->data['profile']->zodiak ?></p>
                            <p>Umur: <?= $this->data['profile']->umur ?> Tahun</p>
                            <p>Tinggi: <?= $this->data['profile']->tinggi_badan ?> cm</p>
                            <p>Agama: <?= $this->data['profile']->agama ?></p>
                        </div>
                    </div>
                </div>
                <div class="desc-addition">
                    <h2>Hobi</h2>
                    <div class="desc-container">
                        <p class="text-addition"><?= $this->data['profile']->hobi ?></p>
                    </div>
                    <h2>Interest</h2>
                    <div class="desc-container">
                        <p class="text-addition"><?= $this->data['profile']->interest ?></p>
                    </div>
                    <h2>Ketidaksukaan</h2>
                    <div class="desc-container">
                        <p class="text-addition"><?= $this->data['profile']->ketidaksukaan ?></p>
                    </div>
                    <h2>MBTI</h2>
                    <div class="desc-container">
                        <p class="text-addition"><?= $this->data['profile']->mbti ?></p>
                    </div>
                    <h2>Love Language</h2>
                    <div class="desc-container">
                        <p class="text-addition"><?= $this->data['profile']->love_language ?></p>
                    </div>
                </div>
            </div>
        </main>
        <?php
            include(__DIR__ . '/../main/Footer/Footer.php');
        ?>

        <script>
            const likeButton = document.querySelector(".like-button");

            likeButton.addEventListener('click', async function() {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", `/public/view/like/${<?= $this->data['profile']->user_id ?>}`);

                xhr.send();
                xhr.onreadystatechange = function () {
                    if (this.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 201) {
                            showToast("Berhasil like!");
                            likeButton.disabled = true;
                        } else {
                            showToast("Gagal like!");
                        }
                    }
                };
            })
        </script>
    </body>
</html>