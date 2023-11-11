
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/article.css">
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
    <div class='container'>
        <div class='main-container'>
            <h1>Browse Articles</h1>
            <input class='search' type="text" name="search" id="search" placeholder="Search..">
            <div class='card-list'>
                <div class='card' href="<?= BASE_URL ?>/recommendation">
                    <div class='card-content'>
                        <h2>How to be a Good Partner</h2>
                        <p>Lorem ip</p>
                    </div>
                    <div class='card-image'>
                        <img class='article-image' src="https://images.unsplash.com/photo-1615966650071-855b15f29ad1?auto=format&fit=crop&q=80&w=1000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8Y291cGxlJTIwaW4lMjBsb3ZlfGVufDB8fDB8fHww" alt="article-image">
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
        </div>
    </div>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>
    <?php
        echo '<script>const BASE_URL = "' . BASE_URL . '";</script>';
    ?>

</body>
</html>