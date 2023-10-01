let menu = document.getElementById('menu-btn'); //querySelector
let navbar = document.querySelector('.header .navbar');

menu.onclick = () => {
   menu.classList.toggle('fa-times');
   navbar.classList.toggle("active");
}