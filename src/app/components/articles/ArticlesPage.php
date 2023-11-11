
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
    <title>Articles</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <div class='main-container'>
        <h1>Browse Articles</h1>
        <div class='card-list'>
            <div class='card'>
                <h2>How to be a Good Partner</h2>
                <div class='author'>Author: John Doe</div>
                <div class='card-content'>
                    <div class='card-image'>
                        <img class='article-image' src="https://lh3.googleusercontent.com/hwau7OVWx96XaME5KpRuJ0I_MscrerK6SbRH1UwYHYaxIDQQtn7RZK02LDSfBzCreidFgDsJeXyqDct6EZiH6vsV=w640-h400-e365-rj-sc0x00ffffff" alt="article-image">
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quam nibh, feugiat vel auctor id, vulputate at magna. Nulla magna nunc, aliquam at molestie varius, viverra vitae lorem. Aenean lobortis orci laoreet, vestibulum leo maximus, accumsan nibh. Aliquam in mi dignissim, facilisis urna sit amet, porttitor velit. Ut elit urna, pellentesque eget gravida eu, faucibus eu lacus. Mauris consectetur lectus eu luctus tempus. In placerat nisl enim, at sollicitudin ipsum sodales sit amet. Donec ut ligula nibh. Aenean eget ante lacus. Etiam vitae ipsum hendrerit, interdum purus in, rutrum ligula. Fusce in enim et urna pellentesque vestibulum. Donec ullamcorper ut purus ac condimentum. Nulla facilisi. Morbi tincidunt nunc in dui fringilla, ac consequat justo vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras nec velit congue arcu condimentum congue sit amet vitae ipsum.
                    </p>
                </div>
            </div>
            <div class='card'>
                <h2>How to be a Good Partner</h2>
                <div class='author'>Author: John Doe</div>
                <div class='card-content'>
                    <div class='card-image'>
                        <img class='article-image' src="https://lh3.googleusercontent.com/hwau7OVWx96XaME5KpRuJ0I_MscrerK6SbRH1UwYHYaxIDQQtn7RZK02LDSfBzCreidFgDsJeXyqDct6EZiH6vsV=w640-h400-e365-rj-sc0x00ffffff" alt="article-image">
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quam nibh, feugiat vel auctor id, vulputate at magna. Nulla magna nunc, aliquam at molestie varius, viverra vitae lorem. Aenean lobortis orci laoreet, vestibulum leo maximus, accumsan nibh. Aliquam in mi dignissim, facilisis urna sit amet, porttitor velit. Ut elit urna, pellentesque eget gravida eu, faucibus eu lacus. Mauris consectetur lectus eu luctus tempus. In placerat nisl enim, at sollicitudin ipsum sodales sit amet. Donec ut ligula nibh. Aenean eget ante lacus. Etiam vitae ipsum hendrerit, interdum purus in, rutrum ligula. Fusce in enim et urna pellentesque vestibulum. Donec ullamcorper ut purus ac condimentum. Nulla facilisi. Morbi tincidunt nunc in dui fringilla, ac consequat justo vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras nec velit congue arcu condimentum congue sit amet vitae ipsum.
                    </p>
                </div>
            </div>
            <div class='card'>
                <h2>How to be a Good Partner</h2>
                <div class='author'>Author: John Doe</div>
                <div class='card-content'>
                    <div class='card-image'>
                        <img class='article-image' src="https://lh3.googleusercontent.com/hwau7OVWx96XaME5KpRuJ0I_MscrerK6SbRH1UwYHYaxIDQQtn7RZK02LDSfBzCreidFgDsJeXyqDct6EZiH6vsV=w640-h400-e365-rj-sc0x00ffffff" alt="article-image">
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut quam nibh, feugiat vel auctor id, vulputate at magna. Nulla magna nunc, aliquam at molestie varius, viverra vitae lorem. Aenean lobortis orci laoreet, vestibulum leo maximus, accumsan nibh. Aliquam in mi dignissim, facilisis urna sit amet, porttitor velit. Ut elit urna, pellentesque eget gravida eu, faucibus eu lacus. Mauris consectetur lectus eu luctus tempus. In placerat nisl enim, at sollicitudin ipsum sodales sit amet. Donec ut ligula nibh. Aenean eget ante lacus. Etiam vitae ipsum hendrerit, interdum purus in, rutrum ligula. Fusce in enim et urna pellentesque vestibulum. Donec ullamcorper ut purus ac condimentum. Nulla facilisi. Morbi tincidunt nunc in dui fringilla, ac consequat justo vestibulum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Cras nec velit congue arcu condimentum congue sit amet vitae ipsum.
                    </p>
                </div>
            </div>
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
        echo '<script>const BASE_URL = "' . BASE_URL . '";</script>';
    ?>
    <script src="<?= BASE_URL ?>/js/articles.js"></script>
</body>
</html>