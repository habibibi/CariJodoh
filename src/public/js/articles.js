let currentPage = 1;
let totalPages = 0;
let prevButton = document.getElementById("prevPage");
let nextButton = document.getElementById("nextPage");
let pagination = document.getElementById("button-pagination");
let cardList = document.querySelector(".card-list");

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
        </div>`;
  return result;
}

function xmlNodesToObject(node) {
  const obj = {};

  if (node.nodeType === 1) {
    // element node
    if (node.attributes.length > 0) {
      obj["attributes"] = {};
      for (let i = 0; i < node.attributes.length; i++) {
        const attribute = node.attributes[i];
        obj["attributes"][attribute.nodeName] = attribute.nodeValue;
      }
    }
  } else if (node.nodeType === 3) {
    // text node
    return node.nodeValue.trim();
  }

  if (node.hasChildNodes()) {
    for (let i = 0; i < node.childNodes.length; i++) {
      const childNode = node.childNodes[i];
      const nodeName = childNode.nodeName;

      if (!obj[nodeName]) {
        obj[nodeName] = xmlNodesToObject(childNode);
      } else {
        if (!obj[nodeName].push) {
          obj[nodeName] = [obj[nodeName]];
        }
        obj[nodeName].push(xmlNodesToObject(childNode));
      }
    }
  }

  return obj;
}

function loadArticles() {
  const xhr = new XMLHttpRequest();
  const url = "http://localhost:8001/article";

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "text/xml; charset=utf-8");

  let body = `<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/">
    <Body>
      <getAllArticles xmlns="http://service.carijodoh/">
        <page xmlns="">${currentPage}</page>
        <apiKey xmlns="">${API_KEY_SOAP}</apiKey>
      </getAllArticles>
    </Body>
  </Envelope>`;

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xhr.responseText, "text/xml");
        const data = xmlNodesToObject(xmlDoc.getElementsByTagName("return")[0]);
        totalPages = data.pageCount["#text"];
        cardList.innerHTML = ``;
        if (totalPages == 0) {
          cardList.innerHTML += `<h1 class="no-data">Maaf ya, gaada yg cocok :(</h1>`;
        } else {
          if (data && data.data && data.data instanceof Array) {
            data.data.forEach((article) => {
              // Decode base64 string to binary
              var binaryString = atob(article.image["#text"]);

              // Create a Uint8Array from the binary data
              var uint8Array = new Uint8Array(binaryString.length);
              for (var i = 0; i < binaryString.length; i++) {
                uint8Array[i] = binaryString.charCodeAt(i);
              }

              // Create a Blob from the Uint8Array
              var blob = new Blob([uint8Array], { type: "image/png" });

              // Create a data URL from the Blob
              const dataURL = URL.createObjectURL(blob);

              cardList.innerHTML += articleCard(
                article.title["#text"],
                article.author["#text"],
                dataURL,
                article.content["#text"]
              );
            });
          } else if (data && data.data) {
            const article = data.data;
            // Decode base64 string to binary
            var binaryString = atob(article.image["#text"]);

            // Create a Uint8Array from the binary data
            var uint8Array = new Uint8Array(binaryString.length);
            for (var i = 0; i < binaryString.length; i++) {
              uint8Array[i] = binaryString.charCodeAt(i);
            }

            // Create a Blob from the Uint8Array
            var blob = new Blob([uint8Array], { type: "image/png" });

            // Create a data URL from the Blob
            const dataURL = URL.createObjectURL(blob);

            cardList.innerHTML += articleCard(
              article.title["#text"],
              article.author["#text"],
              dataURL,
              article.content["#text"]
            );
          }
        }

        updatePaginationButtons();
      } else {
        console.error("Error:", xhr.status, xhr.statusText);
      }
    }
  };

  xhr.send(body);
}

// Call the function to make the SOAP request
loadArticles();
updatePaginationButtons();

function updatePaginationButtons() {
  if (currentPage == 1 || totalPages == 0) {
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
