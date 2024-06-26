let currentPage = 1;
let totalPages = 1;
let prevButton = document.getElementById("prevPage");
let nextButton = document.getElementById("nextPage");
let pagination = document.getElementById("button-pagination");
let nameSearch = document.getElementById("name_search");
let interestSearch = document.getElementById("interest_search");
let agamaSelect = document.getElementById("agama");
let mbtiSelect = document.getElementById("mbti");
let sortSelect = document.getElementById("sort");
let paginationOffset = 1;

function profile_card(
  user_id,
  photo_name,
  nama,
  domisili,
  hobi,
  interest,
  umur,
  tinggi,
  agama,
  mbti
) {
  const result = `
      <a href="${BASE_URL}/view/profile/${user_id}" class="a-link">
        <div class="profile-card">
            <div class="img-profile">
                <img src="/public/images/profile/${photo_name}" alt="profile"/>
            </div>
            <div class="desc-profile">
                <p class="card-nama">${nama}</p>
                <p>Domisili: ${domisili}</p>
                <p>Hobi: ${hobi}</p>
                <p>Interest: ${interest}</p>
                <div class="detail-info">
                    <span>Umur: ${umur} Tahun</span>
                    <span>Tinggi: ${tinggi} cm</span>
                    <span>Agama: ${agama}</span>
                    <span>MBTI: ${mbti}</span>
                </div>
            </div>
        </div>
      </a>
    `;
  return result;
}

function getOptionsValue() {
  const name = nameSearch.value;
  const interest = interestSearch.value;
  const agama = agamaSelect.value;
  const mbti = mbtiSelect.value;
  const sort = sortSelect.value;
  return {
    name: name,
    interest: interest,
    agama: agama,
    mbti: mbti,
    sort: sort,
  };
}

function loadProfiles(pageNumber) {
  const xhr = new XMLHttpRequest();
  let options = getOptionsValue();
  link = `/public/user/profiles?page=${pageNumber}`;
  if (options.name != "") {
    link += `&name=${options.name}`;
  }
  if (options.interest != "") {
    link += `&interest=${options.interest}`;
  }
  if (options.agama != "") {
    link += `&agama=${options.agama}`;
  }
  if (options.mbti != "") {
    link += `&mbti=${options.mbti}`;
  }
  if (options.sort == "name_asc") {
    link += `&sort=nama_lengkap&isdesc=false`;
  } else if (options.sort == "name_desc") {
    link += `&sort=nama_lengkap&isdesc=true`;
  } else if (options.sort == "height_asc") {
    link += `&sort=tinggi_badan&isdesc=false`;
  } else if (options.sort == "height_desc") {
    link += `&sort=tinggi_badan&isdesc=true`;
  } else if (options.sort == "umur_asc") {
    link += `&sort=umur&isdesc=false`;
  } else if (options.sort == "umur_desc") {
    link += `&sort=umur&isdesc=true`;
  }

  xhr.open("GET", link, true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      let profilesGrid = document.querySelector(".profiles-grid");
      profilesGrid.innerHTML = "";
      let browserContainer = document.querySelector(".browser-container");
      if (response.pageCount == 0) {
        if (!browserContainer.querySelector(".no-data")) {
          browserContainer.innerHTML +=
            '<h1 class="no-data">Maaf ya, gaada yg cocok :(</h1>';
        }
      } else {
        if (browserContainer.querySelector(".no-data")) {
          browserContainer.querySelector(".no-data").remove();
        }
      }

      response.profiles.forEach((profile) => {
        profilesGrid.innerHTML += profile_card(
          profile.user_id,
          profile.gambar_profile,
          profile.nama_lengkap,
          profile.domisili,
          profile.hobi,
          profile.interest,
          profile.umur,
          profile.tinggi_badan,
          profile.agama,
          profile.mbti
        );
      });

      totalPages = response.pageCount;

      updatePaginationButtons();
    } else {
      showToast("Gagal load profiles!");
    }
  };

  xhr.send();
}

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
        loadProfiles(currentPage);
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
          loadProfiles(currentPage);
        });

        pagination.appendChild(button);
      }

      const buttonDot = document.createElement("button");
      buttonDot.id = "buttonNextDot";
      buttonDot.textContent = "...";

      buttonDot.addEventListener("click", function () {
        currentPage = 6;
        paginationOffset += 1;
        loadProfiles(currentPage);
      });

      pagination.appendChild(buttonDot);

      const buttonEnd = document.createElement("button");
      buttonEnd.id = totalPages;
      buttonEnd.textContent = totalPages;

      buttonEnd.addEventListener("click", function () {
        currentPage = totalPages;
        loadProfiles(currentPage);
      });

      pagination.appendChild(buttonEnd);
    } else if ((paginationOffset - 1) * 3 + 5 <= totalPages - 3) {
      const buttonStart = document.createElement("button");
      buttonStart.id = 1;
      buttonStart.textContent = 1;

      buttonStart.addEventListener("click", function () {
        currentPage = 1;
        loadProfiles(currentPage);
      });

      pagination.appendChild(buttonStart);

      const buttonDotBack = document.createElement("button");
      buttonDotBack.id = "buttonBackDot";
      buttonDotBack.textContent = "...";

      buttonDotBack.addEventListener("click", function () {
        paginationOffset -= 1;
        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
        loadProfiles(currentPage);
      });

      pagination.appendChild(buttonDotBack);

      for (let i = paginationOffset * 3; i < paginationOffset * 3 + 3; i++) {
        const button = document.createElement("button");
        button.id = i;
        button.textContent = i;

        button.addEventListener("click", function () {
          currentPage = i;
          loadProfiles(currentPage);
        });

        pagination.appendChild(button);
      }

      const buttonDotNext = document.createElement("button");
      buttonDotNext.id = "buttonNextDot";
      buttonDotNext.textContent = "...";

      buttonDotNext.addEventListener("click", function () {
        paginationOffset += 1;
        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
        loadProfiles(currentPage);
      });

      pagination.appendChild(buttonDotNext);

      const buttonEnd = document.createElement("button");
      buttonEnd.id = totalPages;
      buttonEnd.textContent = totalPages;

      buttonEnd.addEventListener("click", function () {
        currentPage = totalPages;
        loadProfiles(currentPage);
      });

      pagination.appendChild(buttonEnd);
    } else {
      const buttonStart = document.createElement("button");
      buttonStart.id = 1;
      buttonStart.textContent = 1;

      buttonStart.addEventListener("click", function () {
        currentPage = 1;
        loadProfiles(currentPage);
      });

      pagination.appendChild(buttonStart);

      const buttonDotBack = document.createElement("button");
      buttonDotBack.id = "buttonBackDot";
      buttonDotBack.textContent = "...";

      buttonDotBack.addEventListener("click", function () {
        paginationOffset -= 1;
        currentPage = paginationOffset == 1 ? 1 : paginationOffset * 3;
        loadProfiles(currentPage);
      });

      pagination.appendChild(buttonDotBack);

      for (let i = totalPages - 4; i <= totalPages; i++) {
        const button = document.createElement("button");
        button.id = i;
        button.textContent = i;

        button.addEventListener("click", function () {
          currentPage = i;
          loadProfiles(currentPage);
        });

        pagination.appendChild(button);
      }
    }
  }

  const currentButton = document.getElementById(currentPage);
  if (currentButton) {
    currentButton.disabled = true;
  }
}

loadProfiles(currentPage);

function debounce(func, timeout = 300) {
  let timer;
  return (...args) => {
    clearTimeout(timer);
    timer = setTimeout(() => {
      func.apply(this, args);
    }, timeout);
  };
}
let debouncedLoadProfiles = debounce(() => loadProfiles(currentPage));

nameSearch.addEventListener("input", function () {
  currentPage = 1;
  debouncedLoadProfiles();
});

interestSearch.addEventListener("input", function () {
  currentPage = 1;
  debouncedLoadProfiles();
});

agamaSelect.addEventListener("change", function () {
  currentPage = 1;
  debouncedLoadProfiles();
});

mbtiSelect.addEventListener("change", function () {
  currentPage = 1;
  debouncedLoadProfiles();
});

sortSelect.addEventListener("change", function () {
  currentPage = 1;
  debouncedLoadProfiles();
});

prevButton.addEventListener("click", () => {
  currentPage -= 1;
  if (paginationOffset * 3 > currentPage) {
    paginationOffset -= 1;
  }
  loadProfiles(currentPage);
});

nextButton.addEventListener("click", () => {
  currentPage += 1;
  if ((paginationOffset + 1) * 3 <= currentPage) {
    paginationOffset += 1;
  }
  loadProfiles(currentPage);
});
