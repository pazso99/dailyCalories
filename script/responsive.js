const togglebutton = document.querySelector(".togglebutton");
const navbarLinks = document.querySelectorAll(".nav-links");

togglebutton.addEventListener("click", () => {
    navbarLinks.forEach((link) => {
        link.classList.toggle("responsive");
    });
});