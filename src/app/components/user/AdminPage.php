<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <title>Admin's Page</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/NavbarAdmin.php');
    ?>
    <main class="admin">
        <h1>Admin Dashboard</h1>
        <p>Welcome to admin's dashboard!</p>
        <img src="<?= BASE_URL ?>/images/assets/admin.png" alt="admin" />
    </main>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>
</body>
</html>