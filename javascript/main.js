const hamburger = document.getElementById("hamburger");
const navLinks = document.getElementById("nav-links");
const dropDown = document.querySelector("dropdown");

hamburger.addEventListener("click" , function() {

    navLinks.classList.toggle("show-menu");
    document.body.classList.toggle("no-scroll");

    if (navLinks.classList.contains("show-menu")) {
        hamburger.innerHTML = "&#10005;" ;
    }else {
        hamburger.innerHTML = "&#9776;" ;
    }
});

dropDown.addEventListener("click", function(e) {

    if (window.innerWidth <= 768) {
        e.preventDefault();
        dropDown.classList.toggle("show-dropdown");
    }
});