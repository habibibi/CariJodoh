let currentPage = 0;
let totalPages = 0;
let prevButton = document.getElementById("prevPage");
let nextButton = document.getElementById("nextPage");
let pagination = document.getElementById("button-pagination");

function articleCard(title, author, imageDir, content) {
    let result = `
        <div class='card'>
            <h2>${title}</h2>
            <div class='author'>Author: ${author}</div>
            <div class='card-content'>
                <div class='card-image'>
                    <img class='article-image' src="${imageDir}" alt="article-image">
                </div>
                <p>
                    ${content}
                </p>
            </div>
        </div>`
    return  result;
}

function loadArticle() {
//     const xhr = new XMLHttpRequest();
//     xhr.open('POST', , true);
//     xhr.setRequestHeader("Content-Type", "text/xml; charset=utf-8");
//     xhr.add
//     let body = 
//     xhr.onload = function(){
//         if (this.status == 200) {
//             console.log(this.responseText);
//         } else {
//             console.log("Error");
//         }
//     }
//     xhr.send(body);
}

loadArticle();
updatePaginationButtons();

function updatePaginationButtons() {
  if (currentPage == 1 || totalPages == 0) {
    prevButton.disabled = true;
  } else {
    prevButton.disabled = false;
  }
  console.log(currentPage, totalPages); 

  if (currentPage == totalPages || totalPages == 0) {
    nextButton.disabled = true;
  } else {
    nextButton.disabled = false;
  }

  if (currentPage <= 5) {
    paginationOffset = 1;
  } else if (currentPage == totalPages) {
    paginationOffset = Math.ceil((totalPages - 5) / 3);
  }

  if (totalPages <= 5) {
    pagination.innerHTML = "";

    for (let i = 1; i <= totalPages; i++) {
      const button = document.createElement("button");
      button.id = i;
      button.textContent = i;

      button.addEventListener("click", function () {
        currentPage = i;
        loadArticles(currentPage);
      });

      pagination.appendChild(button);
    }
  } else {
    pagination.innerHTML = "";

    if (paginationOffset == 1) {
      for (let i = 1; i <= 5; i++) {
        const button = document.createElement("button");
        button.id = i;
        button.textContent = i;

        button.addEventListener("click", function () {
          currentPage = i;
          loadArticles(currentPage);
        });

        pagination.appendChild(button);
      }

      const buttonDot = document.createElement("button");
      buttonDot.id = "buttonNextDot";
      buttonDot.textContent = "...";

      buttonDot.addEventListener("click", function () {
        currentPage = 6;
        paginationOffset += 1;
        loadArticles(currentPage);
      });

      pagination.appendChild(buttonDot);

      const buttonEnd = document.createElement("button");
      buttonEnd.id = totalPages;
      buttonEnd.textContent = totalPages;

      buttonEnd.addEventListener("click", function () {
        currentPage = totalPages;
        loadArticles(currentPage);
      });

      pagination.appendChild(buttonEnd);
    } else if ((paginationOffset - 1) * 3 + 5 <= totalPages - 3) {
      const buttonStart = document.createElement("button");
      buttonStart.id = 1;
      buttonStart.textContent = 1;

      buttonStart.addEventListener("click", function () {
        currentPage = 1;
        loadArticles(currentPage);
      });

      pagination.appendChild(buttonStart);

      const buttonDotBack = document.createElement("button");
      buttonDotBack.id = "buttonBackDot";
      buttonDotBack.textContent = "...";

      buttonDotBack.addEventListener("click", function () {
        paginationOffset -= 1;
        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
        loadArticles(currentPage);
      });

      pagination.appendChild(buttonDotBack);

      for (let i = paginationOffset * 3; i < paginationOffset * 3 + 3; i++) {
        const button = document.createElement("button");
        button.id = i;
        button.textContent = i;

        button.addEventListener("click", function () {
          currentPage = i;
          loadArticles(currentPage);
        });

        pagination.appendChild(button);
      }

      const buttonDotNext = document.createElement("button");
      buttonDotNext.id = "buttonNextDot";
      buttonDotNext.textContent = "...";

      buttonDotNext.addEventListener("click", function () {
        paginationOffset += 1;
        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
        loadArticles(currentPage);
      });

      pagination.appendChild(buttonDotNext);

      const buttonEnd = document.createElement("button");
      buttonEnd.id = totalPages;
      buttonEnd.textContent = totalPages;

      buttonEnd.addEventListener("click", function () {
        currentPage = totalPages;
        loadArticles(currentPage);
      });

      pagination.appendChild(buttonEnd);
    } else {
      const buttonStart = document.createElement("button");
      buttonStart.id = 1;
      buttonStart.textContent = 1;

      buttonStart.addEventListener("click", function () {
        currentPage = 1;
        loadArticles(currentPage);
      });

      pagination.appendChild(buttonStart);

      const buttonDotBack = document.createElement("button");
      buttonDotBack.id = "buttonBackDot";
      buttonDotBack.textContent = "...";

      buttonDotBack.addEventListener("click", function () {
        paginationOffset -= 1;
        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
        loadArticles(currentPage);
      });

      pagination.appendChild(buttonDotBack);

      for (let i = totalPages - 4; i <= totalPages; i++) {
        const button = document.createElement("button");
        button.id = i;
        button.textContent = i;

        button.addEventListener("click", function () {
          currentPage = i;
          loadArticles(currentPage);
        });

        pagination.appendChild(button);
      }
    }
  }
}

prevButton.addEventListener("click", () => {
  currentPage -= 1;
  if (paginationOffset * 3 > currentPage) {
    paginationOffset -= 1;
  }
  loadArticles(currentPage);
});

nextButton.addEventListener("click", () => {
  currentPage += 1;
  if ((paginationOffset + 1) * 3 <= currentPage) {
    paginationOffset += 1;
  }
  loadArticles(currentPage);
});