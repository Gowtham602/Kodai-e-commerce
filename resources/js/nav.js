// alert('js');
console.log("js working");
document.addEventListener('DOMContentLoaded', () => {
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('navbar-menu');

    if (btn && menu) {
        btn.addEventListener('click', () => {
            menu.classList.toggle('show');
        });
    }
});
/*
const btn = document.getElementById('mobile-menu-button');
const menu = document.getElementById('navbar-menu');

btn.addEventListener('click', () => {
    menu.classList.toggle('show');
});*/