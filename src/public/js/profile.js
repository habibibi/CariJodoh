function loadDetail() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/public/user/profile", true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);
      console.log(data);
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
  if (!fullName || fullName.length < 2) {
    alert("Nama Lengkap minimal 3 karakter.");
    return;
  }

  if (!name || name.length < 2) {
    alert("Nama Panggilan minimal 3 karakter.");
    return;
  }

  if (!age || age < 12 || age > 100) {
    alert("Umur tidak valid!");
    return;
  }

  if (!contact || contact.length < 5) {
    alert("Contact minimal 5 karakter. (Bisa berupa id line, no WA, dll)");
  }

  if (!hobby || hobby.length < 5) {
    alert("Hobby minimal 5 karakter.");
    return;
  }

  if (!interest || interest.length < 5) {
    alert("Hobby minimal 5 karakter.");
    return;
  }

  if (!tinggiBadan || tinggiBadan < 100 || tinggiBadan > 300) {
    alert("Tinggi badan tidak valid!");
    return;
  }

  if (!domisili) {
    alert("Masukkan domisili terlebih dahulu.");
    return;
  }

  if (!ketidaksukaan) {
    alert("Masukkan ketidaksukaan terlebih dahulu.");
    return;
  }

  // AJAX
  const formData = new FormData();
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

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/public/user/profile", true);

  xhr.send(formData);
  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      if (this.status !== 201) {
        alert("An error occured, please try again!");
        return;
      }
      location.reload();
    }
  };
});

const logout = document.querySelector(".logout-user");
logout.addEventListener("click", async function (e) {
  e.preventDefault();
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/public/user/logout");
  xhr.send();

  xhr.onreadystatechange = function () {
    if (this.readyState === XMLHttpRequest.DONE) {
      if (this.status === 201) {
        const data = JSON.parse(this.responseText);
        location.replace(data.redirect_url);
      } else {
        showToast("Gagal logout!");
      }
    }
  };
});
