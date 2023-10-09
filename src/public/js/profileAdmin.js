const popUpConfirm = document.querySelector(".popup-confirm");

function loadDetail() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", `/public/user/profile/${user_id}`, true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);
      document.getElementById("fullName").innerHTML = data.nama_lengkap;
      document.getElementById("fullNameInput").value = data.nama_lengkap;
      document.getElementById("name").innerHTML = data.nama_panggilan;
      document.getElementById("nameInput").value = data.nama_panggilan;
      document.getElementById("age").innerHTML = data.umur + " tahun";
      document.getElementById("ageInput").value = data.umur;
      document.getElementById("contact").innerHTML = data.contact_person;
      document.getElementById("contactInput").value = data.contact_person;
      document.getElementById("hobby").innerHTML = data.hobi;
      document.getElementById("hobbyInput").value = data.hobi;
      document.getElementById("interest").innerHTML = data.interest;
      document.getElementById("interestInput").value = data.interest;
      document.getElementById("tinggiBadan").innerHTML =
        data.tinggi_badan + " cm";
      document.getElementById("tinggiBadanInput").value = data.tinggi_badan;
      document.getElementById("agama").innerHTML = data.agama;
      document.getElementById("agamaInput").value = data.agama;
      document.getElementById("domisili").innerHTML = data.domisili;
      document.getElementById("domisiliInput").value = data.domisili;
      document.getElementById("loveLanguage").innerHTML = data.love_language;
      document.getElementById("loveLanguageInput").value = data.love_language;
      document.getElementById("mbti").innerHTML = data.mbti;
      document.getElementById("mbtiInput").value = data.mbti;
      document.getElementById("zodiac").innerHTML = data.zodiak;
      document.getElementById("zodiacInput").value = data.zodiak;
      document.getElementById("ketidaksukaan").innerHTML = data.ketidaksukaan;
      document.getElementById("ketidaksukaanInput").value = data.ketidaksukaan;
      document.getElementById("gender").innerHTML = data.gender;
      document.getElementById("genderInput").value = data.gender;
    }
  };

  xhr.send();
}

loadDetail();

let editMode = false;

function switchMode() {
  editMode = !editMode;
  document.getElementById("editButton").style.display = editMode
    ? "none"
    : "block";
  const p = document.querySelectorAll("p");
  for (let i = 0; i < p.length; i++) {
    p[i].style.display = editMode ? "none" : "block";
  }
  const input = document.querySelectorAll("input");
  for (let i = 0; i < input.length; i++) {
    input[i].style.display = editMode ? "block" : "none";
  }
  const select = document.querySelectorAll("select");
  for (let i = 0; i < select.length; i++) {
    select[i].style.display = editMode ? "block" : "none";
  }
  const formButtons = document.querySelectorAll(".form-buttons");
  for (let i = 0; i < formButtons.length; i++) {
    formButtons[i].style.display = editMode ? "block" : "none";
  }
}

document.getElementById("editButton").addEventListener("click", function () {
  switchMode();
});

document.getElementById("cancelButton").addEventListener("click", function () {
  switchMode();
});

var formData = new FormData();

document.getElementById("saveButton").addEventListener("click", function () {
  const fullName = document.getElementById("fullNameInput").value;
  const name = document.getElementById("nameInput").value;
  const age = document.getElementById("ageInput").value;
  const contact = document.getElementById("contactInput").value;
  const hobby = document.getElementById("hobbyInput").value;
  const interest = document.getElementById("interestInput").value;
  const tinggiBadan = document.getElementById("tinggiBadanInput").value;
  const agama = document.getElementById("agamaInput").value;
  const domisili = document.getElementById("domisiliInput").value;
  const loveLanguage = document.getElementById("loveLanguageInput").value;
  const mbti = document.getElementById("mbtiInput").value;
  const zodiac = document.getElementById("zodiacInput").value;
  const ketidaksukaan = document.getElementById("ketidaksukaanInput").value;
  const imageFile = document.getElementById("imageInput").files[0];
  const videoFile = document.getElementById("videoInput").files[0];
  const gender = document.getElementById("genderInput").value;

  // Validasi
  if (!loveLanguage) {
    showToast("Masukkan love language terlebih dahulu.");
    return;
  }

  if (!mbti) {
    showToast("Masukkan MBTI terlebih dahulu.");
    return;
  }

  if (!zodiac) {
    showToast("Masukkan Zodiak terlebih dahulu.");
    return;
  }

  if (!gender) {
    showToast("Masukkan Gender terlebih dahulu.");
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

  if (!domisili) {
    showToast("Masukkan domisili terlebih dahulu.");
    return;
  }

  if (!ketidaksukaan) {
    showToast("Masukkan ketidaksukaan terlebih dahulu.");
    return;
  }

  if (!agama) {
    showToast("Masukkan agama terlebih dahulu.");
    return;
  }

  if (imageFile && imageFile.size > 10000000) {
    showToast("Ukuran file foto maksimal 10 MB.");
    return;
  }

  if (videoFile && videoFile.size > 10000000) {
    showToast("Ukuran file video maksimal 10 MB.");
    return;
  }

  // AJAX
  formData.append("fullName", fullName);
  formData.append("name", name);
  formData.append("age", age);
  formData.append("contact_person", contact);
  formData.append("hobby", hobby);
  formData.append("interest", interest);
  formData.append("tinggiBadan", tinggiBadan);
  formData.append("agama", agama);
  formData.append("domisili", domisili);
  formData.append("loveLanguage", loveLanguage);
  formData.append("mbti", mbti);
  formData.append("zodiac", zodiac);
  formData.append("ketidaksukaan", ketidaksukaan);
  formData.append("imageFile", imageFile);
  formData.append("videoFile", videoFile);
  formData.append("gender", gender);

  popUpConfirm.style.display = "block";
  overlay.style.display = "block";
});

var submitForm = () => {
  // AJAX
  const xhr = new XMLHttpRequest();
  xhr.open("POST", `/public/user/profile/${user_id}`, true);

  xhr.onload = function () {
    if (xhr.status !== 201) {
      showToast("Update User Gagal!");
      return;
    } else {
      location.reload();
    }
  };

  xhr.send(formData);
};

const noButton = document.querySelector(".no-confirm-button");
noButton.addEventListener("click", function () {
  popUpConfirm.style.display = "none";
  overlay.style.display = "none";
});

const yesButton = document.querySelector(".yes-confirm-button");
yesButton.addEventListener("click", function () {
  popUpConfirm.style.display = "none";
  overlay.style.display = "none";
  submitForm();
});

const deleteButton = document.querySelector(".delete-user");
const popupDelete = document.querySelector(".popup-delete-user");
const overlay = document.querySelector(".overlay");
const confirmDelete = document.querySelector(".yes-button");
const cancelButton = document.querySelector(".no-button");

deleteButton.addEventListener("click", () => {
  popupDelete.style.display = "block";
  overlay.style.display = "block";
});

cancelButton.addEventListener("click", () => {
  popupDelete.style.display = "none";
  overlay.style.display = "none";
});

confirmDelete.addEventListener("click", async function (e) {
  e.preventDefault();
  const xhr = new XMLHttpRequest();
  xhr.open("DELETE", `/public/user/delete/${user_id}`);
  xhr.send();

  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      if (this.status === 202) {
        const data = JSON.parse(this.responseText);
        showToast("Delete User Berhasil!");
        setTimeout(function () {
          location.replace(data.redirect_url);
        }, 1000);
      } else {
        showToast("Gagal Delete User!");
      }
    }
  };
});
