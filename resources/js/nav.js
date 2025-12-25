console.log("js working");

document.addEventListener('DOMContentLoaded', () => {

    /* MOBILE MENU */
    const mobileBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('navbar-menu');

    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('show');
        });
    }

    /* PROFILE DROPDOWN */
    const dropBtn = document.querySelector('.dropbtn');
    const dropMenu = document.querySelector('.dropdown-content');

    if (dropBtn && dropMenu) {
        dropBtn.addEventListener('click', (e) => {
            e.stopPropagation(); // prevent body click
            dropMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            dropMenu.classList.remove('show');
        });
    }

});
