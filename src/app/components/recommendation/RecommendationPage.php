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
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <title>Recommendation</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <main class="recommend">
        <h1>Discover Your Matches</h1>
        <div class="flex-row">
            <div class="ml-auto flex-row gap-4">
                <span>Cocokkan dengan:</span>
                <select id="recommend-by">
                    <option value="mbti" selected>MBTI</option>
                    <option value="agama">Agama</option>
                    <option value="zodiak">Zodiak</option>
                </select>
            </div>
        </div>
        <div class="no-data flex-row"></div>
        <div class="recommend-container"></div>
    </main>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>

    <script>
        function card_profile(userId, namaLengkap, domisili, hobi, interest, umur, tinggi, agama) {
            const result = `
                <a href="<?= BASE_URL ?>/view/profile/${userId}">
                    <div class="card-profile">
                        <div class="img-profile">
                            <img src="<?= BASE_URL ?>/images/profile/${userId}.jpg" alt="profile"/>
                        </div>
                        <div class="desc-profile">
                            <p class="card-nama">${namaLengkap}</p>
                            <p>Lokasi: ${domisili}</p>
                            <p>Hobi: ${hobi}</p>
                            <p>Interest: ${interest}</p>
                            <div class="flex-row items-center margin-auto">
                                <span class="detail-info">Umur: ${umur} Tahun</span>
                                <span class="detail-info">Tinggi: ${tinggi} cm</span>
                                <span class="detail-info">Agama: ${agama}</span>
                            </div>
                        </div>
                    </div>
                </a>
            `

            return result;
        }

        const selector = document.getElementById("recommend-by");

        function loadRecommendations() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `<?= BASE_URL ?>/user/fetch_recommendation?condition=${selector.value}`, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const recommendationContainer = document.querySelector('.recommend-container');
                    const noData = document.querySelector(".no-data");
                    recommendationContainer.innerHTML = '';
                    noData.innerHTML = '';

                    if (response.data.length == 0) {
                        noData.innerHTML = "<p class='mx-auto pt-4'>No recommendations are available yet.</p>"
                    }

                    response.data.forEach((recom) => {
                        recommendationContainer.innerHTML += card_profile(recom.user_id, recom.nama_lengkap, recom.domisili, recom.hobi, recom.interest, recom.umur, recom.tinggi_badan, recom.agama);
                    });
                } else {
                    console.error('XHR request failed');
                }
            };

            xhr.send();
        }

        loadRecommendations();

        selector.addEventListener('change', function() {
            loadRecommendations();
        })
    </script>
</body>
</html>