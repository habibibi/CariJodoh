<?php
    $nonce = bin2hex(random_bytes(16));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/chat.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'nonce-<?= $nonce ?>'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; object-src 'none'; form-action 'self'; base-uri 'self'; connect-src 'self' http://localhost:8001;">
    <title>Chat</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <div class='main-container'>
        <div class='chat-container'>
        </div>
        <div class='chat-input'>
            <textarea id="message-box"></textarea> 
            <button id="send-message">Send</button>
        </div>
    </div>
    <button class="refresh">
        <img src="<?= BASE_URL ?>/images/icons/refresh.png" alt="refresh">
    </button>
    <button class="delete-chat">
        <img src="<?= BASE_URL ?>/images/icons/delete.png" alt="delete">
    </button>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>
    <div class="popup-delete">
        <h1>Do you wish to delete?</h1>
        <div class="button-container-popup">
            <button class="no-button"><strong>No</strong></button>
            <button class="yes-button"><strong>Delete</strong></button>
        </div>
    </div>
    <div class="overlay"></div>
    <?php
        echo '<script nonce="' . $nonce . '">const API_KEY_SOAP = "' . API_KEY_SOAP . '";</script>';
        echo '<script nonce="' . $nonce . '">const user_id = ' . $this->user_id . ';</script>';
        echo '<script nonce="' . $nonce . '">const other_id = ' . $this->other_id . ';</script>';
        echo '<script nonce="' . $nonce . '">const our_name = "' . $this->our_name . '";</script>';
        echo '<script nonce="' . $nonce . '">const other_name = "' . $this->other_name . '";</script>';
        echo '<script nonce="' . $nonce . '">const other_email = "' . $this->other_email . '";</script>';
    ?>
    <script nonce="<?= $nonce ?>">
        const BASE_URL = "<?= BASE_URL ?>";
    </script>
    <script src="<?= BASE_URL ?>/js/chat.js"></script>
</body>
</html>