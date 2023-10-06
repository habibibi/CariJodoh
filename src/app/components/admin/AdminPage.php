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
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <title>Admin's Page</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/NavbarAdmin.php');
    ?>
    <main class="admin flex-col">
        <h1>Admin Dashboard</h1>
        <p>Welcome to admin's dashboard!</p>
        <img src="<?= BASE_URL ?>/images/assets/admin.webp" alt="admin" />
        <button class="logout-admin">Logout</button>
    </main>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>
    <script>
        const logout = document.querySelector(".logout-admin");
        logout.addEventListener("click", async function(e) {
            e.preventDefault();
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/public/user/logout");
            xhr.send();

            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 201) {
                        const data = JSON.parse(this.responseText);
                        location.replace(data.redirect_url);
                    } else {
                        showToast("Gagal logout!");
                    }
                }
            };
        })
    </script>
</body>
</html>