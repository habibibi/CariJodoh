<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/notification.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <title>Notification</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <main>
        <div class="notification">
            <h1>Notification</h1>
            <div class="notification-container">
                <div class="notification-card">
                    <div>
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="flex-row">
                        <span>Jonathan Cole</span>
                        <span>likes you.</span>
                    </div>
                    <div class="button-container">
                        <button class="like-button"><strong>Like Back!</strong></button>
                        <button class="ignore-button"><strong>Ignore</strong></button>
                    </div>
                </div>
                <div class="notification-card">
                    <div>
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="flex-row">
                        <span>Jonathan Cole</span>
                        <span>likes you.</span>
                    </div>
                    <div class="button-container">
                        <button class="like-button"><strong>Like Back!</strong></button>
                        <button class="ignore-button"><strong>Ignore</strong></button>
                    </div>
                </div>
                <div class="notification-card">
                    <div>
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="flex-row">
                        <span>Jonathan Cole</span>
                        <span>likes you.</span>
                    </div>
                    <div class="button-container">
                        <button class="like-button"><strong>Like Back!</strong></button>
                        <button class="ignore-button"><strong>Ignore</strong></button>
                    </div>
                </div>
                <div class="notification-card">
                    <div>
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="flex-row">
                        <span>Jonathan Cole</span>
                        <span>likes you.</span>
                    </div>
                    <div class="button-container">
                        <button class="like-button"><strong>Like Back!</strong></button>
                        <button class="ignore-button"><strong>Ignore</strong></button>
                    </div>
                </div>
                <div class="notification-card">
                    <div>
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="flex-row">
                        <span>Jonathan Cole</span>
                        <span>likes you.</span>
                    </div>
                    <div class="button-container">
                        <button class="like-button"><strong>Like Back!</strong></button>
                        <button class="ignore-button"><strong>Ignore</strong></button>
                    </div>
                </div>
                <div class="notification-card">
                    <div>
                        <img src="<?= BASE_URL ?>/images/icons/profile.png" alt="profile"/>
                    </div>
                    <div class="flex-row">
                        <span>Jonathan Cole</span>
                        <span>likes you.</span>
                    </div>
                    <div class="button-container">
                        <button class="like-button"><strong>Like Back!</strong></button>
                        <button class="ignore-button"><strong>Ignore</strong></button>
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
    </main>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>
</body>
</html>