const loginModal = document.getElementById("loginModal");
const loginBtn = document.getElementById("loginBtn");
const registerModal = document.getElementById("registerModal");
const  showRegister= document.getElementById("showRegister");

loginBtn.onclick = function() {
    loginModal.style.display = "flex";
}

showRegister.onclick = function() {
    registerModal.style.display = "flex";
}

window.onclick = function(event) {
    if(event.target === loginModal) {
        openLogin();
    }
    if (event.target === registerModal) {
        openRegister();
    }
}
document.querySelector(".close").onclick = function () {
    loginModal.style.display = "none";
};
document.querySelector(".close-register").onclick = function () {
    registerModal.style.display = "none";
};

function openLogin() {
    registerModal.style.display = "none";
    loginModal.style.display = "flex";
}

function openRegister() {
    loginModal.style.display = "none";
    registerModal.style.display = "flex";
}