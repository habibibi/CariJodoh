function showToast(message) {
  const toastContainer = document.createElement("div");
  toastContainer.className = "toast-container";
  const toast = document.createElement("div");
  toast.className = "toast";

  const progressBar = document.createElement("div");
  progressBar.className = "toast-progress";
  toast.appendChild(progressBar);

  const messageElement = document.createElement("div");
  messageElement.innerText = message;
  toast.appendChild(messageElement);
  toastContainer.appendChild(toast);
  document.body.appendChild(toastContainer);

  animateProgressBar(progressBar, 3000);

  setTimeout(function () {
    toast.remove();
    toastContainer.remove();
  }, 3000);
}

function animateProgressBar(progressBar, duration) {
  let width = 0;
  const interval = 10;
  const increment = (interval / duration) * 100;

  const progressBarInterval = setInterval(function () {
    if (width >= 100) {
      clearInterval(progressBarInterval);
    } else {
      width += increment;
      progressBar.style.width = width + "%";
    }
  }, interval);
}
