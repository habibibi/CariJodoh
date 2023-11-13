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
      <a href="${BASE_URL}/admin/view_user/${user_id}" class="a-link">
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

const modal = document.getElementById("myModal");
const addButton = document.querySelector(".add-button");
const cancelButton = document.getElementById("cancelDaftar");
const daftarButton = document.getElementById("realDaftar");

function openModal() {
  modal.style.display = "block";
}

function closeModal() {
  modal.style.display = "none";
}

addButton.addEventListener("click", openModal);
cancelButton.addEventListener("click", closeModal);

function hasUppercase(str) {
  return /[A-Z]/.test(str);
}

function hasLowercase(str) {
  return /[a-z]/.test(str);
}

const registerForm = document.querySelector(".register-form");

registerForm.addEventListener("submit", async function (e) {
  e.preventDefault();
  const section2 = document.getElementById("section2");
  const fullName = section2.querySelector("#form-fullName").value;
  const name = section2.querySelector("#form-name").value;
  const age = section2.querySelector("#form-age").value;
  const contact = section2.querySelector("#form-contact").value;
  const hobby = section2.querySelector("#form-hobby").value;
  const interest = section2.querySelector("#form-interest").value;
  const tinggiBadan = section2.querySelector("#form-tinggiBadan").value;
  const agama = section2.querySelector("#form-agama").value;
  const domisili = section2.querySelector("#form-domisili").value;
  const username = document.getElementById("form-username").value;
  const password = document.getElementById("form-password").value;
  const confirmPassword = document.getElementById("form-confirmPassword").value;
  const loveLanguage = document.getElementById("form-loveLanguage").value;
  const mbti = document.getElementById("form-mbti").value;
  const zodiac = document.getElementById("form-zodiac").value;
  const ketidaksukaan = document.getElementById("form-ketidaksukaan").value;
  const imageFile = document.getElementById("form-imageUpload").files[0];
  const videoFile = document.getElementById("form-videoUpload").files[0];
  const gender = document.getElementById("form-gender").value;

  // Validasi
  if (!username || username.length < 5) {
    showToast("Username minimal 5 karakter.");
    return;
  }

  if (!password || password.length < 5) {
    showToast("Password minimal 5 karakter.");
    return;
  } else if (!hasUppercase(password) || !hasLowercase(password)) {
    showToast("Password harus terdapat huruf besar dan huruf kecil.");
    return;
  }

  if (password !== confirmPassword) {
    showToast("Password dan Confirm Password tidak sama.");
    return;
  }

  if (!fullName || fullName.length < 2) {
    showToast("Nama Lengkap minimal 3 karakter.");
    return;
  }

  if (!name || name.length < 2) {
    showToast("Nama Panggilan minimal 3 karakter.");
    return;
  }

  if (!age || age < 12 || age > 100) {
    showToast("Umur tidak valid!");
    return;
  }

  if (!contact || contact.length < 5) {
    showToast("Contact minimal 5 karakter. (Bisa berupa id line, no WA, dll)");
    return;
  }

  if (!hobby || hobby.length < 5) {
    showToast("Hobby minimal 5 karakter.");
    return;
  }

  if (!interest || interest.length < 5) {
    showToast("Interest minimal 5 karakter.");
    return;
  }

  if (!tinggiBadan || tinggiBadan < 100 || tinggiBadan > 300) {
    showToast("Tinggi badan tidak valid!");
    return;
  }

  if (!agama) {
    showToast("Pilih agama terlebih dahulu.");
    return;
  }

  if (!gender) {
    showToast("Pilih jenis kelamin terlebih dahulu.");
    return;
  }

  if (!domisili) {
    showToast("Masukkan domisili terlebih dahulu.");
    return;
  }

  if (!loveLanguage) {
    showToast("Pilih love language terlebih dahulu.");
    return;
  }

  if (!mbti) {
    showToast("Pilih MBTI terlebih dahulu.");
    return;
  }

  if (!zodiac) {
    showToast("Pilih zodiac terlebih dahulu.");
    return;
  }

  if (!ketidaksukaan) {
    showToast("Masukkan ketidaksukaan terlebih dahulu.");
    return;
  }

  if (!imageFile) {
    showToast("Masukkan gambar muka anda terlebih dahulu.");
    return;
  }

  // AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/public/user/register");

  const formData = new FormData();
  formData.append("fullName", fullName);
  formData.append("name", name);
  formData.append("age", age);
  formData.append("contact", contact);
  formData.append("hobby", hobby);
  formData.append("interest", interest);
  formData.append("tinggiBadan", tinggiBadan);
  formData.append("agama", agama);
  formData.append("domisili", domisili);
  formData.append("username", username);
  formData.append("password", password);
  formData.append("loveLanguage", loveLanguage);
  formData.append("mbti", mbti);
  formData.append("zodiac", zodiac);
  formData.append("ketidaksukaan", ketidaksukaan);
  formData.append("imageFile", imageFile);
  formData.append("videoFile", videoFile);
  formData.append("gender", gender);

  xhr.send(formData);
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      if (this.status === 201) {
        showToast("Berhasil buat user!");
        window.location.reload();
        modal.style.display = "none";
      } else if (this.status == 409) {
        showToast("Username sudah ada!");
      } else {
        showToast("Gagal register!");
      }
    }
  };
});
