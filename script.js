function openLoginPopup() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("loginPopup").style.display = "block";
}

function closeLoginPopup() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("loginPopup").style.display = "none";
}

document.getElementById("loginPopup").addEventListener("click", function (event) {
    event.stopPropagation();
})


document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    const message = document.getElementById('message');
    const headerContent = document.getElementById('headerContent');
    const loginButton = document.getElementById('loginButton');

    loginForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        fetch('/verify.php', {
            method: 'POST',
            body: new URLSearchParams({ username, password }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => response.text())
        .then(data => {
            message.innerText = data;
            
            if (data === "Login bem-sucedido!") {
                window.location.reload();
            }
        });
    });
});



document.getElementById("menu-icon").addEventListener("click", openSidebar);

function openSidebar() {
    document.getElementById("sidebar").style.width = "250px"; 
}

function closeSidebar() {
    document.getElementById("sidebar").style.width = "0";
}

document.addEventListener("click", function (event) {
    var sidebar = document.getElementById("sidebar");
    var menuIcon = document.getElementById("menu-icon");

    if (event.target !== sidebar && event.target !== menuIcon && !sidebar.contains(event.target)) {
        closeSidebar();
    }
});

document.getElementById("overlay").addEventListener("click", closeRegisterPopup);

function openRegisterPopup() {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("registerPopup").style.display = "block";
}

function closeRegisterPopup() {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("registerPopup").style.display = "none";
}

document.getElementById("registerPopup").addEventListener("click", function (event) {
    event.stopPropagation();
});

document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('register-form');
    const registerMessage = document.getElementById('registerMessage');

    registerForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const newUsername = document.getElementById('newUsername').value;
        const newPassword = document.getElementById('newPassword').value;

        fetch('/register.php', {
            method: 'POST',
            body: new URLSearchParams({ newUsername, newPassword }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(response => response.text())
        .then(data => {
            registerMessage.innerText = data;
        });
    });
});
