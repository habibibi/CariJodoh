let drop = false;
const buttonDropdown = document.querySelector(".dropbtn");
const dropdownNAV = document.querySelector(".dropdown-content");
buttonDropdown.addEventListener("click", function () {
  drop = !drop;
  if (drop) {
    dropdownNAV.style.display = "block";
  } else {
    dropdownNAV.style.display = "none";
  }
});
