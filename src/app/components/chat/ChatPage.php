
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
    <title>Chat</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <div class='main-container'>
        <div class='chat-container'>
            <div class='user-chat-component'>
                <div class='sender-name'>John Doe</div>
                <div class='message'>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quam nibh, feugiat vel auctor id, vulputate at magna. Nulla magna nunc, aliquam at molestie varius, viverra vitae lorem. Aenean lobortis orci laoreet, vestibulum leo maximus, accumsan nibh. Aliquam in mi dignissim, facilisis urna sit amet, porttitor velit. Ut elit urna, pellentesque eget gravida eu, faucibus eu lacus. Mauris consectetur lectus eu luctus tempus. In placerat nisl enim, at sollicitudin ipsum sodales sit amet. Donec ut ligula nibh. Aenean eget ante lacus. Etiam vitae ipsum hendrerit, interdum purus in, rutrum ligula. Fusce in enim et urna pellentesque vestibulum. Donec ullamcorper ut purus ac condimentum. Nulla facilisi. Morbi tincidunt nunc in dui fringilla, ac consequat justo vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras nec velit congue arcu condimentum congue sit amet vitae ipsum.</p>
                </div>
            </div>
            <div class='other-chat-component'>
                <label class='sender-name'>John Doe</label>
                <div class='message'>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quam nibh, feugiat vel auctor id, vulputate at magna. Nulla magna nunc, aliquam at molestie varius, <br> <br> viverra vitae lorem. Aenean lobortis orci laoreet, vestibulum leo maximus, accumsan nibh. Aliquam in mi dignissim, facilisis urna sit amet, porttitor velit. Ut elit urna, pellentesque eget gravida eu, faucibus eu lacus. Mauris consectetur lectus eu luctus tempus. In placerat nisl enim, at sollicitudin ipsum sodales sit amet. Donec ut ligula nibh. Aenean eget ante lacus. Etiam vitae ipsum hendrerit, interdum purus in, rutrum ligula. Fusce in enim et urna pellentesque vestibulum. Donec ullamcorper ut purus ac condimentum. Nulla facilisi. Morbi tincidunt nunc in dui fringilla, ac consequat justo vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras nec velit congue arcu condimentum congue sit amet vitae ipsum.</p>
                </div>
                <div class='message'>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quam nibh, feugiat vel auctor id, vulputate at magna. Nulla magna nunc, aliquam at molestie varius, <br> <br> viverra vitae lorem. Aenean lobortis orci laoreet, vestibulum leo maximus, accumsan nibh. Aliquam in mi dignissim, facilisis urna sit amet, porttitor velit. Ut elit urna, pellentesque eget gravida eu, faucibus eu lacus. Mauris consectetur lectus eu luctus tempus. In placerat nisl enim, at sollicitudin ipsum sodales sit amet. Donec ut ligula nibh. Aenean eget ante lacus. Etiam vitae ipsum hendrerit, interdum purus in, rutrum ligula. Fusce in enim et urna pellentesque vestibulum. Donec ullamcorper ut purus ac condimentum. Nulla facilisi. Morbi tincidunt nunc in dui fringilla, ac consequat justo vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras nec velit congue arcu condimentum congue sit amet vitae ipsum.</p>
                </div>
            </div>
        </div>
        <div class='chat-input'>
            <textarea w></textarea> 
            <button id="send-message">Send</button>
        </div>
    </div>
    <button class="refresh">
        <img src="<?= BASE_URL ?>/images/icons/refresh.png" alt="refresh">
    </button>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>
    <?php
        echo '<script>';

        echo '</script>';
    ?>
    <script>
        const BASE_URL = "<?= BASE_URL ?>" ;
        const user_id = <?= $this->user_id ?>;
        const other_id = <?= $this->other_id ?>;
    </script>
    <script src="<?= BASE_URL ?>/js/chat.js"></script>
</body>
</html>