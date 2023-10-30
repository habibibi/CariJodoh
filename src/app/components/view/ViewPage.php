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
                        <?php
                            $videoFilePath = BASE_URL . '/videos/' . $this->data['profile']->user_id . '.mp4';
                            $checkVideoPath = __DIR__ . '/../../../public/videos/' . $this->data['profile']->user_id . '.mp4';
                            if (file_exists($checkVideoPath)) {
                                echo '
                                <video id="video" height="240" controls>
                                    <source src="' . $videoFilePath . '" type="video/mp4">
                                </video>';
                            } else {
                                echo 'No video available';
                            }
                        ?>
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
                <div class="w-full flex">
                    <button class="report-button">REPORT!</button>
                </div>
            </div>
        </main>
        <?php
            include(__DIR__ . '/../main/Footer/Footer.php');
        ?>
        <div class="popup-report">
            <h1>Report User</h1>
            <div class="flex-col gap-2">
                <label>Alasan</label>
                <textarea type="text" placeholder="Alasan Report" name="isi_report" id="isi_report"></textarea>
            </div>
            <div class="button-container-popup">
                <button class="cancel-button"><strong>Cancel</strong></button>
                <button class="add-button"><strong>Report</strong></button>
            </div>
        </div>
        <div class="overlay"></div>
        <script>
            const likeButton = document.querySelector(".like-button");
            const openReport = document.querySelector(".report-button");
            const cancelButton = document.querySelector(".cancel-button");
            const reportButton = document.querySelector(".add-button");
            const overlay = document.querySelector(".overlay");
            const popupReport = document.querySelector(".popup-report");
            
            cancelButton.addEventListener('click', () => {
                popupReport.style.display = 'none';
                overlay.style.display = 'none';
            });

            openReport.addEventListener('click', () => {
                popupReport.style.display = 'block';
                overlay.style.display = 'block';
            });

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

            reportButton.addEventListener('click', async () => {
                const deskripsiReport = document.getElementById("isi_report").value;
                if (deskripsiReport) {
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", `/public/view/report/`);

                    const formData = new FormData();
                    formData.append("user_id_reporter", <?= $_SESSION['user_id'] ?>)
                    formData.append("user_id_reported", <?= $this->data['profile']->user_id ?>)
                    formData.append("report_detail", deskripsiReport)

                    xhr.send(formData);

                    xhr.onreadystatechange = function () {
                        if (this.readyState === XMLHttpRequest.DONE) {
                            if (this.status === 201) {
                                popupReport.style.display = 'none';
                                overlay.style.display = 'none';
                                showToast("Berhasil report user!");
                            } else {
                                const response = JSON.parse(this.responseText);
                                popupReport.style.display = 'none';
                                overlay.style.display = 'none';
                                showToast(response.message);
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