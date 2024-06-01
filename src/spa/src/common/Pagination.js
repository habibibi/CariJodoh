const updatePaginationButtons = (paginationConfig, load) => {
  if (paginationConfig.currentPage == 1 || paginationConfig.totalPages == 0) {
    paginationConfig.prevButton.disabled = true;
  } else {
    paginationConfig.prevButton.disabled = false;
  }

  if (
    paginationConfig.currentPage == paginationConfig.totalPages ||
    paginationConfig.totalPages == 0
  ) {
    paginationConfig.nextButton.disabled = true;
  } else {
    paginationConfig.nextButton.disabled = false;
  }

  if (paginationConfig.currentPage <= 5) {
    paginationConfig.paginationOffset = 1;
  } else if (paginationConfig.currentPage == paginationConfig.totalPages) {
    paginationConfig.paginationOffset = Math.ceil(
      (paginationConfig.totalPages - 5) / 3
    );
  }

  if (paginationConfig.totalPages <= 5) {
    paginationConfig.pagination.innerHTML = "";

    for (let i = 1; i <= paginationConfig.totalPages; i++) {
      const button = document.createElement("button");
      button.id = i;
      button.textContent = i;
      button.className =
        "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

      button.addEventListener("click", function () {
        paginationConfig.currentPage = i;
        load(paginationConfig);
      });

      paginationConfig.pagination.appendChild(button);
    }
  } else {
    paginationConfig.pagination.innerHTML = "";

    if (paginationConfig.paginationOffset == 1) {
      for (let i = 1; i <= 5; i++) {
        const button = document.createElement("button");
        button.id = i;
        button.textContent = i;
        button.className =
          "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

        button.addEventListener("click", function () {
          paginationConfig.currentPage = i;
          load(paginationConfig);
        });

        paginationConfig.pagination.appendChild(button);
      }

      const buttonDot = document.createElement("button");
      buttonDot.id = "buttonNextDot";
      buttonDot.textContent = "...";
      buttonDot.className =
        "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

      buttonDot.addEventListener("click", function () {
        paginationConfig.currentPage = 6;
        paginationConfig.paginationOffset += 1;
        load(paginationConfig);
      });

      paginationConfig.pagination.appendChild(buttonDot);

      const buttonEnd = document.createElement("button");
      buttonEnd.id = paginationConfig.totalPages;
      buttonEnd.textContent = paginationConfig.totalPages;
      buttonEnd.className =
        "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

      buttonEnd.addEventListener("click", function () {
        paginationConfig.currentPage = paginationConfig.totalPages;
        load(paginationConfig);
      });

      paginationConfig.pagination.appendChild(buttonEnd);
    } else if (
      (paginationConfig.paginationOffset - 1) * 3 + 5 <=
      paginationConfig.totalPages - 3
    ) {
      const buttonStart = document.createElement("button");
      buttonStart.id = 1;
      buttonStart.textContent = 1;
      buttonStart.className =
        "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

      buttonStart.addEventListener("click", function () {
        paginationConfig.currentPage = 1;
        load(paginationConfig);
      });

      paginationConfig.pagination.appendChild(buttonStart);

      const buttonDotBack = document.createElement("button");
      buttonDotBack.id = "buttonBackDot";
      buttonDotBack.textContent = "...";
      buttonDotBack.className =
        "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

      buttonDotBack.addEventListener("click", function () {
        paginationConfig.paginationOffset -= 1;
        paginationConfig.currentPage =
          paginationConfig.paginationOffset == 1
            ? 1
            : paginationConfig.paginationOffset * 3;
        load(paginationConfig);
      });

      paginationConfig.pagination.appendChild(buttonDotBack);

      for (
        let i = paginationConfig.paginationOffset * 3;
        i < paginationConfig.paginationOffset * 3 + 3;
        i++
      ) {
        const button = document.createElement("button");
        button.id = i;
        button.textContent = i;
        button.className =
          "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

        button.addEventListener("click", function () {
          paginationConfig.currentPage = i;
          load(paginationConfig);
        });

        paginationConfig.pagination.appendChild(button);
      }

      const buttonDotNext = document.createElement("button");
      buttonDotNext.id = "buttonNextDot";
      buttonDotNext.textContent = "...";
      buttonDotNext.className =
        "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

      buttonDotNext.addEventListener("click", function () {
        paginationConfig.paginationOffset += 1;
        paginationConfig.currentPage =
          paginationConfig.paginationOffset == 1
            ? 1
            : paginationConfig.paginationOffset * 3;
        load(paginationConfig);
      });

      paginationConfig.pagination.appendChild(buttonDotNext);

      const buttonEnd = document.createElement("button");
      buttonEnd.id = paginationConfig.totalPages;
      buttonEnd.textContent = paginationConfig.totalPages;
      buttonEnd.className =
        "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

      buttonEnd.addEventListener("click", function () {
        paginationConfig.currentPage = paginationConfig.totalPages;
        load(paginationConfig);
      });

      paginationConfig.pagination.appendChild(buttonEnd);
    } else {
      const buttonStart = document.createElement("button");
      buttonStart.id = 1;
      buttonStart.textContent = 1;
      buttonStart.className =
        "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

      buttonStart.addEventListener("click", function () {
        paginationConfig.currentPage = 1;
        load(paginationConfig);
      });

      paginationConfig.pagination.appendChild(buttonStart);

      const buttonDotBack = document.createElement("button");
      buttonDotBack.id = "buttonBackDot";
      buttonDotBack.textContent = "...";
      buttonDotBack.className =
        "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

      buttonDotBack.addEventListener("click", function () {
        paginationConfig.paginationOffset -= 1;
        paginationConfig.currentPage =
          paginationConfig.paginationOffset == 1
            ? 1
            : paginationConfig.paginationOffset * 3;
        load(paginationConfig);
      });

      paginationConfig.pagination.appendChild(buttonDotBack);

      for (
        let i = paginationConfig.totalPages - 4;
        i <= paginationConfig.totalPages;
        i++
      ) {
        const button = document.createElement("button");
        button.id = i;
        button.textContent = i;
        button.className =
          "p-1 bg-white border-2 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed";

        button.addEventListener("click", function () {
          paginationConfig.currentPage = i;
          load(paginationConfig);
        });

        paginationConfig.pagination.appendChild(button);
      }
    }
  }

  const currentButton = document.getElementById(paginationConfig.currentPage);
  if (currentButton) {
    currentButton.disabled = true;
  }
};

export { updatePaginationButtons };
