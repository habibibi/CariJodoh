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
    <title>Admin's Likes</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/NavbarAdmin.php');
    ?>
    <main class="admin">
        <div class="admin-likes-outer">
            <div class="admin-sidebar">
                <h1>Admin Dashboard</h1>
                <h3>Likes</h3>
                <img src="<?= BASE_URL ?>/images/assets/admin.png" alt="admin" />
            </div>
            <div class="admin-likes">
                <div class="flex-row header">
                    <h1>Likes</h1>
                    <button class="add-button"><strong>Add</strong></button>
                </div>
                <div class="likes-container"></div>
                <div class="pagination">
                    <div class="pagination-tab">
                        <button id="prevPage"><</button>
                        <div id="button-pagination"></div>
                        <button id="nextPage">></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup-delete-likes">
            <h1>Do you wish to delete?</h1>
            <div class="button-container-popup">
                <button class="no-button"><strong>No</strong></button>
                <button class="yes-button"><strong>Delete</strong></button>
            </div>
        </div>
        <div class="popup-add-likes">
            <h1>Add Likes</h1>
            <div class="flex-col gap-2">
                <input type="number" placeholder="User ID Sender" name="user_id_1" id="user_id_1">
                <input type="number" placeholder="User ID Receiver" name="user_id_2" id="user_id_2">
            </div>
            <div class="button-container-popup">
                <button class="cancel-button"><strong>Cancel</strong></button>
                <button class="add-button-2"><strong>Add</strong></button>
            </div>
        </div>
        <div class="popup-edit-likes">
            <h1>Edit Likes</h1>
            <div class="flex-col gap-2">
                <input type="number" placeholder="User ID Sender" name="user_id_1_2" id="user_id_1_2">
                <input type="number" placeholder="User ID Receiver" name="user_id_2_2" id="user_id_2_2">
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

    <script>
        let currentPage = 1;
        let totalPages = 1;
        let prevButton = document.getElementById('prevPage');
        let nextButton = document.getElementById('nextPage');
        let pagination = document.getElementById('button-pagination');
        let paginationOffset = 1;
        const popupDelete = document.querySelector(".popup-delete-likes");
        const popupAdd = document.querySelector(".popup-add-likes");
        const popupEdit = document.querySelector(".popup-edit-likes");
        const noButton = document.querySelector(".no-button");
        const yesButton = document.querySelector(".yes-button");
        const overlay = document.querySelector(".overlay");
        const cancelButton = document.querySelector(".cancel-button");
        const addButton = document.querySelector(".add-button");
        const addButton2 = document.querySelector(".add-button-2");
        const cancelButton2 = document.querySelector(".cancel-button-2");
        const editButton = document.querySelector(".edit-button"); 

        function likes_card(userId1, userId2, dateId){
            const result = `
                <div class="likes-card">
                    <div>
                        <img src="<?= BASE_URL ?>/images/profile/${userId1}.jpg" alt="profile"/>
                    </div>
                    <div>
                        <span>${userId1}</span>
                        <span>Menyukai ${userId2}</span>
                    </div>
                    <div class="button-container">
                        <button class="like-button" data-date-id="${dateId}" data-user-id-1="${userId1}" data-user-id-2="${userId2}"><strong>Edit</strong></button>
                        <button class="ignore-button" data-date-id="${dateId}"><strong>Delete</strong></button>
                    </div>
                </div>
            `

            return result;
        }

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
            const dateId = yesButton.getAttribute('data-date-id');

            xhr.open('DELETE', `<?= BASE_URL ?>/likes/fetch/${dateId}`, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    currentPage = 1;
                    const likesContainer = document.querySelector('.likes-container');
                    likesContainer.innerHTML = '';

                    if (response.data.length == 0) {
                        likesContainer.innerHTML = "<p>No likes are available yet.</p>"
                    }

                    response.data.forEach((likes) => {
                        likesContainer.innerHTML += likes_card(likes.user_id_1, likes.user_id_2, likes.date_id);
                    });
                    
                    document.querySelectorAll(".ignore-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupDelete.style.display = 'block';
                            overlay.style.display = 'block';

                            const dateId = button.getAttribute('data-date-id');
                            yesButton.setAttribute('data-date-id', dateId);
                        })
                    })

                    document.querySelectorAll(".like-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupEdit.style.display = 'block';
                            overlay.style.display = 'block';

                            const dateId = button.getAttribute('data-date-id');
                            const userId1 = button.getAttribute('data-user-id-1');
                            const userId2 = button.getAttribute('data-user-id-2');

                            editButton.setAttribute('data-date-id', dateId);
                            editButton.setAttribute('data-user-id-1', userId1);
                            editButton.setAttribute('data-user-id-2', userId2);

                            document.getElementById("user_id_1_2").value = userId1;
                            document.getElementById("user_id_2_2").value = userId2;
                        })
                    })

                    totalPages = Number(response.pages);

                    updatePaginationButtons();

                    popupDelete.style.display = 'none';
                    overlay.style.display = 'none';
                } else {
                    console.error('XHR request failed');
                }
            };

            xhr.send();
        })

        function loadLikes(pageNumber) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `<?= BASE_URL ?>/likes/fetch?page=${pageNumber}`, true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    const likesContainer = document.querySelector('.likes-container');
                    likesContainer.innerHTML = '';

                    if (response.data.length == 0) {
                        likesContainer.innerHTML = "<p>No likes are available yet.</p>"
                    }

                    response.data.forEach((likes) => {
                        likesContainer.innerHTML += likes_card(likes.user_id_1, likes.user_id_2, likes.date_id);
                    });
                    
                    document.querySelectorAll(".ignore-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupDelete.style.display = 'block';
                            overlay.style.display = 'block';

                            const dateId = button.getAttribute('data-date-id');
                            yesButton.setAttribute('data-date-id', dateId);
                        })
                    })

                    document.querySelectorAll(".like-button").forEach((button) => {
                        button.addEventListener('click', () => {
                            popupEdit.style.display = 'block';
                            overlay.style.display = 'block';

                            const dateId = button.getAttribute('data-date-id');
                            const userId1 = button.getAttribute('data-user-id-1');
                            const userId2 = button.getAttribute('data-user-id-2');

                            editButton.setAttribute('data-date-id', dateId);
                            editButton.setAttribute('data-user-id-1', userId1);
                            editButton.setAttribute('data-user-id-2', userId2);

                            document.getElementById("user_id_1_2").value = userId1;
                            document.getElementById("user_id_2_2").value = userId2;
                        })
                    })

                    totalPages = Number(response.pages);

                    updatePaginationButtons();
                } else {
                    console.error('XHR request failed');
                }
            };

            xhr.send();
        }

        loadLikes(currentPage);

        function updatePaginationButtons(){
            if (currentPage == 1) {
                prevButton.disabled = true;
            } else {
                prevButton.disabled = false;
            }

            if (currentPage == totalPages) {
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
                        loadLikes(currentPage);
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
                            loadLikes(currentPage);
                        });

                        pagination.appendChild(button);
                    }

                    const buttonDot = document.createElement('button');
                    buttonDot.id = 'buttonNextDot';
                    buttonDot.textContent = '...';

                    buttonDot.addEventListener('click', function () {
                        currentPage = 6;
                        paginationOffset += 1;
                        loadLikes(currentPage);
                    });

                    pagination.appendChild(buttonDot);

                    const buttonEnd = document.createElement('button');
                    buttonEnd.id = totalPages;
                    buttonEnd.textContent = totalPages;

                    buttonEnd.addEventListener('click', function () {
                        currentPage = totalPages;
                        loadLikes(currentPage);
                    });

                    pagination.appendChild(buttonEnd);
                } else if((paginationOffset - 1) * 3 + 5 <= totalPages - 3){
                    const buttonStart = document.createElement('button');
                    buttonStart.id = 1;
                    buttonStart.textContent = 1;

                    buttonStart.addEventListener('click', function () {
                        currentPage = 1;
                        loadLikes(currentPage);
                    });

                    pagination.appendChild(buttonStart);
                    
                    const buttonDotBack = document.createElement('button');
                    buttonDotBack.id = 'buttonBackDot';
                    buttonDotBack.textContent = '...';

                    buttonDotBack.addEventListener('click', function () {
                        paginationOffset -= 1;
                        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
                        loadLikes(currentPage);
                    });

                    pagination.appendChild(buttonDotBack);

                    for(let i = paginationOffset * 3; i < paginationOffset * 3 + 3; i++){
                        const button = document.createElement('button');
                        button.id = i;
                        button.textContent = i;

                        button.addEventListener('click', function () {
                            currentPage = i;
                            loadLikes(currentPage);
                        });

                        pagination.appendChild(button);
                    }

                    const buttonDotNext = document.createElement('button');
                    buttonDotNext.id = 'buttonNextDot';
                    buttonDotNext.textContent = '...';

                    buttonDotNext.addEventListener('click', function () {
                        paginationOffset += 1;
                        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
                        loadLikes(currentPage);
                    });

                    pagination.appendChild(buttonDotNext);

                    const buttonEnd = document.createElement('button');
                    buttonEnd.id = totalPages;
                    buttonEnd.textContent = totalPages;

                    buttonEnd.addEventListener('click', function () {
                        currentPage = totalPages;
                        loadLikes(currentPage);
                    });

                    pagination.appendChild(buttonEnd);
                } else {
                    const buttonStart = document.createElement('button');
                    buttonStart.id = 1;
                    buttonStart.textContent = 1;

                    buttonStart.addEventListener('click', function () {
                        currentPage = 1;
                        loadLikes(currentPage);
                    });

                    pagination.appendChild(buttonStart);
                    
                    const buttonDotBack = document.createElement('button');
                    buttonDotBack.id = 'buttonBackDot';
                    buttonDotBack.textContent = '...';

                    buttonDotBack.addEventListener('click', function () {
                        paginationOffset -= 1;
                        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
                        loadLikes(currentPage);
                    });

                    pagination.appendChild(buttonDotBack);

                    for(let i = totalPages - 4; i <= totalPages; i++){
                        const button = document.createElement('button');
                        button.id = i;
                        button.textContent = i;

                        button.addEventListener('click', function () {
                            currentPage = i;
                            loadLikes(currentPage);
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
            loadLikes(currentPage);
        });

        nextButton.addEventListener('click', () => {
            currentPage += 1;
            if ((paginationOffset + 1) * 3 <= currentPage) {
                paginationOffset += 1;
            }
            loadLikes(currentPage);
        });

        addButton2.addEventListener('click', async () => {
            const userId1 = document.getElementById("user_id_1").value;
            const userId2 = document.getElementById("user_id_2").value;
            
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/public/likes/fetch");

            const formData = new FormData();
            formData.append("user_id_1", userId1);
            formData.append("user_id_2", userId2);

            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 201) {
                        const response = JSON.parse(this.responseText);
                        currentPage = response.pages;
                        loadLikes(response.pages);
                        popupAdd.style.display = 'none';
                        overlay.style.display = 'none';
                    } else {
                        alert("An error occured, please try again!");
                    }
                }
            };
        })

        editButton.addEventListener('click', async () => {
            const idDate = editButton.getAttribute('data-date-id');
            const userId1 = document.getElementById("user_id_1_2").value;
            const userId2 = document.getElementById("user_id_2_2").value;
            
            const xhr = new XMLHttpRequest();
            xhr.open("POST", `/public/likes/update/${idDate}`);

            const formData = new FormData();
            formData.append("user_id_1", userId1);
            formData.append("user_id_2", userId2);

            xhr.send(formData);
            xhr.onreadystatechange = function () {
                if (this.readyState === XMLHttpRequest.DONE) {
                    if (this.status === 201) {
                        loadLikes(1);
                        popupEdit.style.display = 'none';
                        overlay.style.display = 'none';
                    } else {
                        alert("An error occured, please try again!");
                    }
                }
            };
        })
    </script>
</body>
</html>