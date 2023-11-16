<?php
    $nonce = bin2hex(random_bytes(16));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/articles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'nonce-<?= $nonce ?>'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; object-src 'none'; form-action 'self'; base-uri 'self'; connect-src 'self' http://localhost:8001; img-src 'self' blob:;">
    <title>Articles</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <div class='main-container'>
        <h1>Browse Articles</h1>
        <div class='card-list'>
        </div>
    </div>
    <div class="pagination">
        <div class="pagination-tab">
            <button id="prevPage"><</button>
            <div id="button-pagination"></div>
            <button id="nextPage">></button>
        </div>
    </div>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>
    <?php
        echo '<script nonce="' . $nonce . '">const BASE_URL = "' . BASE_URL . '";</script>';
        echo '<script nonce="' . $nonce . '">const API_KEY_SOAP = "' . API_KEY_SOAP . '";</script>';
    ?>
    <script src="<?= BASE_URL ?>/js/articles.js"></script>
</body>
</html>