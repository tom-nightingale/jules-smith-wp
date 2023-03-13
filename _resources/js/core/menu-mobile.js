const isMenuOpen = false;
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');
const mobileMenuIcon = document.querySelector('.btn-mobile-menu');

mobileMenuButton.addEventListener('click', (e) => {
    e.preventDefault();
    mobileMenuIcon.classList.toggle('open');
    mobileMenu.classList.toggle('active');
});
