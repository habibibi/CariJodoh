<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/index.css">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/styles/likes.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Blinker:wght@300&family=Poppins:wght@400;600;700&family=Sofadi+One&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/images/icons/loveicon.png">
    <title>Likes</title>
</head>
<body>
    <?php
        include(__DIR__ . '/../main/navbar/Navbar.php');
    ?>
    <main>
        <div class="likes">
            <h1>Likes</h1>
            <div class="likes-container"></div>
            <div class="pagination">
                <div class="pagination-tab">
                    <button id="prevPage"><</button>
                    <div id="button-pagination"></div>
                    <button id="nextPage">></button>
                </div>
            </div>
        </div>
    </main>
    <?php
        include(__DIR__ . '/../main/Footer/Footer.php');
    ?>

    <script>
        function likes_card(user_id, nama_lengkap, user_contact) {
            const result = `
                <div class="likes-card">
                    <div>
                        <img src="<?= BASE_URL ?>/images/profile/${user_id}.jpg" alt="profile"/>
                    </div>
                    <div class="flex-col">
                        <span>${nama_lengkap}</span>
                        <span>Kontak: ${user_contact}</span>
                    </div>
                    <div class="button-container">
                        <a href="<?= BASE_URL ?>/user/profile/${user_id}">
                            <button class="view-button"><strong>View Profile</strong></button>
                        </a>
                    </div>
                </div>
            `

            return result;
        }

        let currentPage = 1;
        let totalPages = 1;
        let prevButton = document.getElementById('prevPage');
        let nextButton = document.getElementById('nextPage');
        let pagination = document.getElementById('button-pagination');
        let paginationOffset = 1;

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
                        likesContainer.innerHTML += likes_card(likes.user_id_2, likes.nama_lengkap, likes.contact_person);
                    });

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
    </script>
</body>
</html>