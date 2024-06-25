const body = document.querySelector("body"),
    sidebar = document.querySelector(".sidebar"),
    toggle = document.querySelector(".toggle"),
    btn_search = document.querySelector(".search-box");

    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });