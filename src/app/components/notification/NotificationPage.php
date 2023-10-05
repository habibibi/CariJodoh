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
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <title>Notification</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <main>
        <div class="notification">
            <h1>Notification</h1>
            <div class="notification-container"></div>
            <div class="pagination">
                <div class="pagination-tab">
                    <button id="prevPage"><</button>
                    <div id="button-pagination"></div>
                    <button id="nextPage">></button>
                </div>
            </div>
        </div>
    </main>
    <div class="popup-ignore-notif">
        <h1>Do you wish to ignore?</h1>
        <div class="button-container-popup">
            <button class="no-button-1"><strong>No</strong></button>
            <button class="yes-button-1"><strong>Ignore</strong></button>
        </div>
    </div>
    <div class="popup-like-notif">
        <h1>Do you wish to like back?</h1>
        <div class="button-container-popup">
            <button class="no-button-2"><strong>No</strong></button>
            <button class="yes-button-2"><strong>Like Back!</strong></button>
        </div>
    </div>
    <div class="overlay"></div>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>

    <script>
        let currentPage = 1;
        let totalPages = 1;
        let prevButton = document.getElementById('prevPage');
        let nextButton = document.getElementById('nextPage');
        let pagination = document.getElementById('button-pagination');
        let paginationOffset = 1;
        const noButton = document.querySelector(".no-button-1");
        const noButton2 = document.querySelector(".no-button-2");
        const yesButton = document.querySelector(".yes-button-1");
        const yesButton2 = document.querySelector(".yes-button-2");
        const overlay = document.querySelector(".overlay");
        const popupIgnore = document.querySelector(".popup-ignore-notif");
        const popupLike = document.querySelector(".popup-like-notif");

        function notification_card(notification_id, user_id, isi_notifikasi) {
            const result = `
                <div class="notification-card">
                    <div>
                        <img src="<?= BASE_URL ?>/images/profile/${user_id}.jpg" alt="profile"/>
                    </div>
                    <div class="flex-row">
                        <span>${isi_notifikasi}</span>
                    </div>
                    <div class="button-container">
                        <button class="like-button" data-notification-id="${notification_id}" data-user-id="${user_id}"><strong>Like Back!</strong></button>
                        <button class="ignore-button" data-notification-id="${notification_id}"><strong>Ignore</strong></button>
                    </div>
                </div>
            `

            return result;
        }

        function loadNotifications(pageNumber) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `<?= BASE_URL ?>/notification/fetch?page=${pageNumber}`, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const notificationContainer = document.querySelector('.notification-container');
                    notificationContainer.innerHTML = '';

                    if (response.data.length == 0) {
                        notificationContainer.innerHTML = "<p class='mx-auto'>No notifications are available yet.</p>"
                    }

                    response.data.forEach((notification) => {
                        notificationContainer.innerHTML += notification_card(notification.notification_id, notification.user_id_sender, notification.isi_notifikasi);
                    });
                    
                    document.querySelectorAll(".ignore-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupIgnore.style.display = 'block';
                            overlay.style.display = 'block';

                            const notificationId = button.getAttribute('data-notification-id');
                            yesButton.setAttribute('data-notification-id', notificationId);
                        })
                    })

                    document.querySelectorAll(".like-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupLike.style.display = 'block';
                            overlay.style.display = 'block';

                            const notificationId = button.getAttribute('data-notification-id');
                            const userIdSender = button.getAttribute('data-user-id');

                            yesButton2.setAttribute('data-notification-id', notificationId);
                            yesButton2.setAttribute('data-user-id', userIdSender);
                        })
                    })

                    totalPages = Number(response.pages);

                    updatePaginationButtons();
                } else {
                    showToast("Gagal load notifications!");
                }
            };

            xhr.send();
        }

        loadNotifications(currentPage);

        function updatePaginationButtons(){
            if (currentPage == 1) {
                prevButton.disabled = true;
            } else {
                prevButton.disabled = false;
            }

            if (currentPage == totalPages || totalPages == 0) {
                nextButton.disabled = true;
            } else {
                nextButton.disabled = false;
            }

            if (currentPage <= 5) {
                paginationOffset = 1;
            } else if (currentPage == totalPages){
                paginationOffset = Math.ceil((totalPages - 5) / 3);
            }

            if (totalPages <= 5){
                pagination.innerHTML = '';

                for(let i = 1; i <= totalPages; i++){
                    const button = document.createElement('button');
                    button.id = i;
                    button.textContent = i;

                    button.addEventListener('click', function () {
                        currentPage = i;
                        loadNotifications(currentPage);
                    });

                    pagination.appendChild(button);
                }
            } else {
                pagination.innerHTML = '';

                if (paginationOffset == 1){
                    for(let i = 1; i <= 5; i++){
                        const button = document.createElement('button');
                        button.id = i;
                        button.textContent = i;

                        button.addEventListener('click', function () {
                            currentPage = i;
                            loadNotifications(currentPage);
                        });

                        pagination.appendChild(button);
                    }

                    const buttonDot = document.createElement('button');
                    buttonDot.id = 'buttonNextDot';
                    buttonDot.textContent = '...';

                    buttonDot.addEventListener('click', function () {
                        currentPage = 6;
                        paginationOffset += 1;
                        loadNotifications(currentPage);
                    });

                    pagination.appendChild(buttonDot);

                    const buttonEnd = document.createElement('button');
                    buttonEnd.id = totalPages;
                    buttonEnd.textContent = totalPages;

                    buttonEnd.addEventListener('click', function () {
                        currentPage = totalPages;
                        loadNotifications(currentPage);
                    });

                    pagination.appendChild(buttonEnd);
                } else if((paginationOffset - 1) * 3 + 5 <= totalPages - 3){
                    const buttonStart = document.createElement('button');
                    buttonStart.id = 1;
                    buttonStart.textContent = 1;

                    buttonStart.addEventListener('click', function () {
                        currentPage = 1;
                        loadNotifications(currentPage);
                    });

                    pagination.appendChild(buttonStart);
                    
                    const buttonDotBack = document.createElement('button');
                    buttonDotBack.id = 'buttonBackDot';
                    buttonDotBack.textContent = '...';

                    buttonDotBack.addEventListener('click', function () {
                        paginationOffset -= 1;
                        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
                        loadNotifications(currentPage);
                    });

                    pagination.appendChild(buttonDotBack);

                    for(let i = paginationOffset * 3; i < paginationOffset * 3 + 3; i++){
                        const button = document.createElement('button');
                        button.id = i;
                        button.textContent = i;

                        button.addEventListener('click', function () {
                            currentPage = i;
                            loadNotifications(currentPage);
                        });

                        pagination.appendChild(button);
                    }

                    const buttonDotNext = document.createElement('button');
                    buttonDotNext.id = 'buttonNextDot';
                    buttonDotNext.textContent = '...';

                    buttonDotNext.addEventListener('click', function () {
                        paginationOffset += 1;
                        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
                        loadNotifications(currentPage);
                    });

                    pagination.appendChild(buttonDotNext);

                    const buttonEnd = document.createElement('button');
                    buttonEnd.id = totalPages;
                    buttonEnd.textContent = totalPages;

                    buttonEnd.addEventListener('click', function () {
                        currentPage = totalPages;
                        loadNotifications(currentPage);
                    });

                    pagination.appendChild(buttonEnd);
                } else {
                    const buttonStart = document.createElement('button');
                    buttonStart.id = 1;
                    buttonStart.textContent = 1;

                    buttonStart.addEventListener('click', function () {
                        currentPage = 1;
                        loadNotifications(currentPage);
                    });

                    pagination.appendChild(buttonStart);
                    
                    const buttonDotBack = document.createElement('button');
                    buttonDotBack.id = 'buttonBackDot';
                    buttonDotBack.textContent = '...';

                    buttonDotBack.addEventListener('click', function () {
                        paginationOffset -= 1;
                        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
                        loadNotifications(currentPage);
                    });

                    pagination.appendChild(buttonDotBack);

                    for(let i = totalPages - 4; i <= totalPages; i++){
                        const button = document.createElement('button');
                        button.id = i;
                        button.textContent = i;

                        button.addEventListener('click', function () {
                            currentPage = i;
                            loadNotifications(currentPage);
                        });

                        pagination.appendChild(button);
                    }
                }
            }

            const currentButton = document.getElementById(currentPage);
            if(currentButton){
               currentButton.disabled = true; 
            }
        }

        prevButton.addEventListener('click', () => {
            currentPage -= 1;
            if (paginationOffset * 3 > currentPage){
                paginationOffset -= 1;
            }
            loadNotifications(currentPage);
        });

        nextButton.addEventListener('click', () => {
            currentPage += 1;
            if ((paginationOffset + 1) * 3 <= currentPage) {
                paginationOffset += 1;
            }
            loadNotifications(currentPage);
        });

        noButton.addEventListener('click', () => {
            popupIgnore.style.display = 'none';
            overlay.style.display = 'none';
        });

        noButton2.addEventListener('click', () => {
            popupLike.style.display = 'none';
            overlay.style.display = 'none';
        });

        yesButton.addEventListener('click', () => {
            const xhr = new XMLHttpRequest();
            const notificationId = yesButton.getAttribute('data-notification-id');

            xhr.open('PUT', `<?= BASE_URL ?>/notification/fetch/${notificationId}`, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    currentPage = 1;
                    const notificationContainer = document.querySelector('.notification-container');
                    notificationContainer.innerHTML = '';

                    if (response.data.length == 0) {
                        notificationContainer.innerHTML = "<p class='mx-auto'>No notifications are available yet.</p>"
                    }

                    response.data.forEach((notification) => {
                        notificationContainer.innerHTML += notification_card(notification.notification_id, notification.user_id_sender, notification.isi_notifikasi);
                    });
                    
                    document.querySelectorAll(".ignore-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupIgnore.style.display = 'block';
                            overlay.style.display = 'block';

                            const notificationId = button.getAttribute('data-notification-id');
                            yesButton.setAttribute('data-notification-id', notificationId);
                        })
                    })

                    document.querySelectorAll(".like-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupLike.style.display = 'block';
                            overlay.style.display = 'block';

                            const notificationId = button.getAttribute('data-notification-id');
                            const userIdSender = button.getAttribute('data-user-id');

                            yesButton2.setAttribute('data-notification-id', notificationId);
                            yesButton2.setAttribute('data-user-id', userIdSender);
                        })
                    })

                    totalPages = Number(response.pages);

                    updatePaginationButtons();

                    popupIgnore.style.display = 'none';
                    overlay.style.display = 'none';

                    showToast("Berhasil ignore notifikasi!");
                } else {
                    showToast("Gagal ignore notifikasi!");
                }
            };

            xhr.send();
        })

        yesButton2.addEventListener('click', () => {
            const xhr = new XMLHttpRequest();
            const notificationId = yesButton2.getAttribute('data-notification-id');
            const userId = yesButton2.getAttribute('data-user-id');

            xhr.open('POST', `<?= BASE_URL ?>/notification/likes/${notificationId}`, true);

            const formData = new FormData();
            formData.append("user_id", userId);

            xhr.onload = function () {
                if (xhr.status === 201) {
                    loadNotifications(1);
                    popupLike.style.display = 'none';
                    overlay.style.display = 'none';

                    showToast("Berhasil like back!");
                } else {
                    showToast("Gagal like back!");
                }
            };

            xhr.send(formData);
        })
    </script>
</body>
</html>