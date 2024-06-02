<?php
    $nonce = bin2hex(random_bytes(16));
?>

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
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'nonce-<?= $nonce ?>'; style-src 'self' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; object-src 'none'; form-action 'self'; base-uri 'self';">
    <title>Admin's Notifications</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/NavbarAdmin.php');
    ?>
    <main class="admin">
        <div class="admin-notif-outer">
            <div class="admin-sidebar">
                <h1>Admin Dashboard</h1>
                <h3>Notifications</h3>
                <img src="<?= BASE_URL ?>/images/assets/admin.webp" alt="admin" />
            </div>
            <div class="admin-notification">
                <div class="flex-row header add-header">
                    <h1>Notification</h1>
                    <button class="add-button"><strong>Add</strong></button>
                </div>
                <div class="notification-container"></div>
                <div class="pagination">
                    <div class="pagination-tab">
                        <button id="prevPage"><</button>
                        <div id="button-pagination"></div>
                        <button id="nextPage">></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-delete-notif">
            <h1>Do you wish to delete?</h1>
            <div class="button-container-popup">
                <button class="no-button"><strong>No</strong></button>
                <button class="yes-button"><strong>Delete</strong></button>
            </div>
        </div>
        <div class="popup-add-notif">
            <h1>Add Notification</h1>
            <div class="flex-col gap-2">
                <select id="jenis_notifikasi">
                    <option value="date">Date</option>
                </select>
                <input type="text" placeholder="Isi Notifikasi" name="isi_notifikasi" id="isi_notifikasi">
                <input type="number" placeholder="User ID Sender" name="user_id_sender" id="user_id_sender">
                <input type="number" placeholder="User ID Receiver" name="user_id_receiver" id="user_id_receiver">
            </div>
            <div class="button-container-popup">
                <button class="cancel-button"><strong>Cancel</strong></button>
                <button class="add-button-2"><strong>Add</strong></button>
            </div>
        </div>
        <div class="popup-edit-notif">
            <h1>Edit Notification</h1>
            <div class="flex-col gap-2">
                <select id="jenis_notifikasi_2">
                    <option value="date">Date</option>
                </select>
                <input type="text" placeholder="Isi Notifikasi" name="isi_notifikasi_2" id="isi_notifikasi_2">
                <input type="number" placeholder="User ID Sender" name="user_id_sender_2" id="user_id_sender_2">
                <input type="number" placeholder="User ID Receiver" name="user_id_receiver_2" id="user_id_receiver_2">
            </div>
            <div class="flex-row items-center mt-2">
                <label for="sudah_dibaca">Sudah dibaca: </label>
                <input type="checkbox" name="sudah_dibaca" id="sudah_dibaca">
            </div>
            <div class="button-container-popup">
                <button class="cancel-button-2"><strong>Cancel</strong></button>
                <button class="edit-button"><strong>Edit</strong></button>
            </div>
        </div>
        <div class="overlay"></div>
    </main>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>

    <script nonce="<?= $nonce ?>">
        let currentPage = 1;
        let totalPages = 1;
        let prevButton = document.getElementById('prevPage');
        let nextButton = document.getElementById('nextPage');
        let pagination = document.getElementById('button-pagination');
        let paginationOffset = 1;
        const popupDelete = document.querySelector(".popup-delete-notif");
        const popupAdd = document.querySelector(".popup-add-notif");
        const popupEdit = document.querySelector(".popup-edit-notif");
        const noButton = document.querySelector(".no-button");
        const yesButton = document.querySelector(".yes-button");
        const overlay = document.querySelector(".overlay");
        const cancelButton = document.querySelector(".cancel-button");
        const addButton = document.querySelector(".add-button");
        const addButton2 = document.querySelector(".add-button-2");
        const cancelButton2 = document.querySelector(".cancel-button-2");
        const editButton = document.querySelector(".edit-button"); 

        noButton.addEventListener('click', () => {
            popupDelete.style.display = 'none';
            overlay.style.display = 'none';
        });

        cancelButton.addEventListener('click', () => {
            popupAdd.style.display = 'none';
            overlay.style.display = 'none';
        });

        cancelButton2.addEventListener('click', () => {
            popupEdit.style.display = 'none';
            overlay.style.display = 'none';
        });

        addButton.addEventListener('click', () => {
            popupAdd.style.display = 'block';
            overlay.style.display = 'block';
        });

        yesButton.addEventListener('click', async () => {
            const xhr = new XMLHttpRequest();
            const notificationId = yesButton.getAttribute('data-notification-id');

            xhr.open('DELETE', `<?= BASE_URL ?>/notification/fetch/${notificationId}`, true);

            xhr.onload = function () {
                if (xhr.status === 202) {
                    const response = JSON.parse(xhr.responseText);
                    currentPage = 1;
                    const notificationContainer = document.querySelector('.notification-container');
                    notificationContainer.innerHTML = '';

                    if (response.data.length == 0) {
                        notificationContainer.innerHTML = "<p class='mx-auto'>No notifications are available yet.</p>"
                    }

                    response.data.forEach((notification) => {
                        notificationContainer.innerHTML += notification_card(notification.user_id_sender, notification.isi_notifikasi, notification.user_id_receiver, notification.user_id_sender, notification.notification_id, notification.sudah_dibaca);
                    });
                    
                    document.querySelectorAll(".ignore-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupDelete.style.display = 'block';
                            overlay.style.display = 'block';

                            const notificationId = button.getAttribute('data-notification-id');
                            yesButton.setAttribute('data-notification-id', notificationId);
                        })
                    })

                    document.querySelectorAll(".like-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupEdit.style.display = 'block';
                            overlay.style.display = 'block';

                            const notificationId = button.getAttribute('data-notification-id');
                            const isiNotifikasi = button.getAttribute('data-isi-notifikasi');
                            const userIdReceiver = button.getAttribute('data-user-id-receiver');
                            const userIdSender = button.getAttribute('data-user-id-sender');
                            const sudahDibaca = button.getAttribute('data-sudah-dibaca');
                            const jenisNotifikasi = button.getAttribute('data-jenis-notifikasi');

                            editButton.setAttribute('data-notification-id', notificationId);
                            editButton.setAttribute('data-isi-notifikasi', isiNotifikasi);
                            editButton.setAttribute('data-user-id-receiver', userIdReceiver);
                            editButton.setAttribute('data-user-id-sender', userIdSender);
                            editButton.setAttribute('data-sudah-dibaca', sudahDibaca);

                            document.getElementById("jenis_notifikasi_2").value = jenisNotifikasi;
                            document.getElementById("isi_notifikasi_2").value = isiNotifikasi;
                            document.getElementById("user_id_sender_2").value = userIdSender;
                            document.getElementById("user_id_receiver_2").value = userIdReceiver;
                            document.getElementById("sudah_dibaca").checked = sudahDibaca == 0 ? false : true;
                        })
                    })

                    totalPages = Number(response.pages);

                    updatePaginationButtons();

                    popupDelete.style.display = 'none';
                    overlay.style.display = 'none';

                    showToast("Berhasil delete notification!");
                } else {
                    showToast("Gagal delete notification!");
                }
            };

            xhr.send();
        })

        function notification_card(image, isiNotifikasi, userIdReceiver, userIdSender, notificationId, sudahDibaca, jenisNotifikasi){
            const result = `
            <div class="notification-card">
                <div class="notification-card-img">
                    <img src="<?= BASE_URL ?>/images/profile/${image}.jpg" alt="profile" class="profile-img"/>
                </div>
                <div class="flex-col">
                    <span>${isiNotifikasi}</span>
                    <span>Owner: ${userIdReceiver}</span>
                </div>
                <div class="button-container">
                    <button class="like-button" data-notification-id="${notificationId}" data-isi-notifikasi="${isiNotifikasi}" data-user-id-receiver="${userIdReceiver}" data-user-id-sender="${userIdSender}" data-sudah-dibaca="${sudahDibaca}" data-jenis-notifikasi="${jenisNotifikasi}"><strong>Edit</strong></button>
                    <button class="ignore-button" data-notification-id="${notificationId}"><strong>Delete</strong></button>
                </div>
            </div>
            `

            return result
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
                        notificationContainer.innerHTML += notification_card(notification.user_id_sender, notification.isi_notifikasi, notification.user_id_receiver, notification.user_id_sender, notification.notification_id, notification.sudah_dibaca, notification.jenis_notifikasi);
                    });
                    
                    document.querySelectorAll(".ignore-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupDelete.style.display = 'block';
                            overlay.style.display = 'block';

                            const notificationId = button.getAttribute('data-notification-id');
                            yesButton.setAttribute('data-notification-id', notificationId);
                        })
                    })

                    document.querySelectorAll(".like-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupEdit.style.display = 'block';
                            overlay.style.display = 'block';

                            const notificationId = button.getAttribute('data-notification-id');
                            const isiNotifikasi = button.getAttribute('data-isi-notifikasi');
                            const userIdReceiver = button.getAttribute('data-user-id-receiver');
                            const userIdSender = button.getAttribute('data-user-id-sender');
                            const sudahDibaca = button.getAttribute('data-sudah-dibaca');
                            const jenisNotifikasi = button.getAttribute('data-jenis-notifikasi');

                            editButton.setAttribute('data-notification-id', notificationId);
                            editButton.setAttribute('data-isi-notifikasi', isiNotifikasi);
                            editButton.setAttribute('data-user-id-receiver', userIdReceiver);
                            editButton.setAttribute('data-user-id-sender', userIdSender);
                            editButton.setAttribute('data-sudah-dibaca', sudahDibaca);

                            document.getElementById("jenis_notifikasi_2").value = jenisNotifikasi;
                            document.getElementById("isi_notifikasi_2").value = isiNotifikasi;
                            document.getElementById("user_id_sender_2").value = userIdSender;
                            document.getElementById("user_id_receiver_2").value = userIdReceiver;
                            document.getElementById("sudah_dibaca").checked = sudahDibaca == 0 ? false : true;
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

        addButton2.addEventListener('click', async () => {
            const jenisNotifikasi = document.getElementById("jenis_notifikasi").value;
            const isiNotifikasi = document.getElementById("isi_notifikasi").value;
            const userId1 = document.getElementById("user_id_sender").value;
            const userId2 = document.getElementById("user_id_receiver").value;
            
            if(isiNotifikasi && jenisNotifikasi && userId1 && userId2) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "/public/notification/fetch");

                const formData = new FormData();
                formData.append("jenis_notifikasi", jenisNotifikasi);
                formData.append("isi_notifikasi", isiNotifikasi);
                formData.append("user_id_sender", userId1);
                formData.append("user_id_receiver", userId2);

                xhr.send(formData);
                xhr.onreadystatechange = function () {
                    if (this.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 201) {
                            const response = JSON.parse(this.responseText);
                            currentPage = response.pages;
                            loadNotifications(response.pages);
                            popupAdd.style.display = 'none';
                            overlay.style.display = 'none';

                            showToast("Berhasil tambah notification!");
                        } else {
                            showToast("Gagal tambah notification!");
                        }
                    }
                };
            } else {
                showToast("Lengkapi Form!");
            }
        })

        editButton.addEventListener('click', async () => {
            const idNotifikasi = editButton.getAttribute('data-notification-id');
            const jenisNotifikasi = document.getElementById("jenis_notifikasi_2").value;
            const isiNotifikasi = document.getElementById("isi_notifikasi_2").value;
            const userId1 = document.getElementById("user_id_sender_2").value;
            const userId2 = document.getElementById("user_id_receiver_2").value;
            const sudahDibaca = document.getElementById("sudah_dibaca").checked;

            if(isiNotifikasi && jenisNotifikasi && userId1 && userId2){
                const xhr = new XMLHttpRequest();
                xhr.open("POST", `/public/notification/update/${idNotifikasi}`);

                const formData = new FormData();
                formData.append("jenis_notifikasi", jenisNotifikasi);
                formData.append("isi_notifikasi", isiNotifikasi);
                formData.append("user_id_sender", userId1);
                formData.append("user_id_receiver", userId2);
                formData.append("sudah_dibaca", sudahDibaca ? 1 : 0);

                xhr.send(formData);
                xhr.onreadystatechange = function () {
                    if (this.readyState === XMLHttpRequest.DONE) {
                        if (this.status === 201) {
                            loadNotifications(1);
                            popupEdit.style.display = 'none';
                            overlay.style.display = 'none';
                            showToast("Berhasil update notification!");
                        } else {
                            showToast("Gagal update notification!");
                        }
                    }
                };
            } else {
                showToast("Lengkapi Form!");
            }
        })
    </script>
</body>
</html>