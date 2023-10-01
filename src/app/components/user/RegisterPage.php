<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/register.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <title>CariJodoh</title>
</head>
<body>
    <div class="container">
        <div class="register-outer">
            <div class="register-form-section">
                <div class="register-form">
                    <div class="register-form-container">
                        <h1>CariJodoh</h1>
                        <h2>Daftarkan dirimu segera di sini!</h2>
                        <form class="main-form-register">
                            <input id="username" type="username" placeholder="Username"/>
                            <input id="password" type="password" placeholder="Password"/>
                            <input id="confirmPassword" type="password" placeholder="Confirm Password"/>
                            <button type="button" id="registerButton">DAFTAR</button>
                        </form>
                        <div class="login-register">
                            Sudah punya akun? <a href="/public/user/login">Login</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="register-title-section">
                <div class="register-title">
                    <h1>Selamat</h1>
                    <h1>Dating</h1>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("registerButton").addEventListener("click", function () {
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            // Perform validation
            if (password !== confirmPassword) {
                alert("Password and Confirm Password do not match.");
                return;
            }

            // You can send the registration data to your server here using AJAX or fetch.
            // Example:
            // const formData = { username, password };
            // fetch("/your-registration-endpoint", {
            //     method: "POST",
            //     body: JSON.stringify(formData),
            //     headers: {
            //         "Content-Type": "application/json"
            //     }
            // })
            // .then(response => {
            //     // Handle the response from the server
            //     if (response.status === 200) {
            //         alert("Registration successful!");
            //         // Redirect to login page or perform other actions as needed.
            //     } else {
            //         alert("Registration failed. Please try again.");
            //     }
            // })
            // .catch(error => {
            //     console.error("Error:", error);
            // });
        });
    </script>
</body>
</html>