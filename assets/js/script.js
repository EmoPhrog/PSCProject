'use strict';

/* ================================
   1. NAVBAR TOGGLE & OVERLAY
================================ */
const overlay = document.querySelector("[data-overlay]");
const navbar = document.querySelector("[data-navbar]");
const navToggleBtn = document.querySelector("[data-nav-toggle-btn]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");

function toggleNavbar() {
  navToggleBtn?.classList.toggle("active");
  navbar?.classList.toggle("active");
  overlay?.classList.toggle("active");
}

if (navToggleBtn && navbar && overlay) {
  navToggleBtn.addEventListener("click", toggleNavbar);
  overlay.addEventListener("click", toggleNavbar);
  navbarLinks.forEach(link => link.addEventListener("click", toggleNavbar));
}



/* ================================
   2. HEADER ACTIVE ON SCROLL
================================ */
const header = document.querySelector("[data-header]");
if (header) {
  window.addEventListener("scroll", () => {
    header.classList.toggle("active", window.scrollY >= 10);
  });
}



/* ================================
   3. RENT NOW BUTTON CHECK
================================ */
const rentButtons = document.querySelectorAll('.rent-btn');
if (rentButtons.length) {
  rentButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      if (!localStorage.getItem('loggedInUser')) {
        window.location.href = 'login.html';
      } else {
        alert('Proceeding to booking page...');
      }
    });
  });
}



/* ================================
   4. LIFESTYLE RENTALS TABS
================================ */
const tabBtns = document.querySelectorAll('.tab-btn');
const tabSections = document.querySelectorAll('.rental-section');

if (tabBtns.length && tabSections.length) {
  tabBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      tabBtns.forEach(b => b.classList.remove('active'));
      tabSections.forEach(s => s.classList.remove('active-tab'));
      btn.classList.add('active');
      document.getElementById(btn.dataset.tab)?.classList.add('active-tab');
    });
  });
}



/* ================================
   5. VEHICLE FILTERS
================================ */
const typeFilter = document.getElementById('vehicleTypeFilter');
const priceFilter = document.getElementById('priceFilter');
const carCards = document.querySelectorAll('.featured-car-card');

if ((typeFilter || priceFilter) && carCards.length) {
  function filterCars() {
    const typeVal = typeFilter?.value || 'all';
    const priceVal = priceFilter?.value || 'all';

    carCards.forEach(card => {
      const matchesType = typeVal === 'all' || card.dataset.type === typeVal;
      const matchesPrice = priceVal === 'all' || card.dataset.price === priceVal;
      card.style.display = (matchesType && matchesPrice) ? '' : 'none';
    });
    if (document.getElementById('pageInfo')) updatePagination();
  }

  typeFilter?.addEventListener('change', filterCars);
  priceFilter?.addEventListener('change', filterCars);
}



/* ================================
   6. PAGINATION (Safe Version)
================================ */
let currentPage = 1;
const carsPerPage = 6;

function updatePagination() {
  const visibleCars = Array.from(carCards).filter(c => c.style.display !== 'none');
  const totalPages = Math.ceil(visibleCars.length / carsPerPage);

  visibleCars.forEach((card, index) => {
    card.style.display = (index >= (currentPage - 1) * carsPerPage && index < currentPage * carsPerPage) ? '' : 'none';
  });

  const pageInfo = document.getElementById('pageInfo');
  if (pageInfo) pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;
}

if (document.getElementById('pageInfo')) {
  updatePagination();

  document.getElementById('prevPage')?.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      updatePagination();
    }
  });

  document.getElementById('nextPage')?.addEventListener('click', () => {
    const visibleCars = Array.from(carCards).filter(c => c.style.display !== 'none');
    if (currentPage < Math.ceil(visibleCars.length / carsPerPage)) {
      currentPage++;
      updatePagination();
    }
  });
}



/* ================================
   7. PASSWORD TOGGLE (Login/Signup)
================================ */
const passwordToggles = document.querySelectorAll('.password-toggle');
if (passwordToggles.length) {
  passwordToggles.forEach(toggle => {
    toggle.addEventListener('click', () => {
      const input = toggle.previousElementSibling;
      if (!input) return;
      const type = input.type === 'password' ? 'text' : 'password';
      input.type = type;
      toggle.innerHTML = type === 'password'
        ? '<i class="fas fa-eye"></i>'
        : '<i class="fas fa-eye-slash"></i>';
    });
  });
}



/* ================================
   8. SIGNUP/LOGIN SIMULATION
================================ */
const signupForm = document.getElementById('signup-form');
if (signupForm) {
  signupForm.addEventListener('submit', e => {
    e.preventDefault();
    const email = document.getElementById('signup-email')?.value;
    const password = document.getElementById('signup-password')?.value;
    if (email && password) {
      localStorage.setItem('loggedInUser', JSON.stringify({ email, password }));
      alert('Account created! You are now logged in.');
      window.location.href = 'index.html';
    }
  });
}

const loginForm = document.getElementById('login-form');
if (loginForm) {
  loginForm.addEventListener('submit', e => {
    e.preventDefault();
    const email = document.getElementById('email')?.value;
    const password = document.getElementById('password')?.value;
    const user = JSON.parse(localStorage.getItem('loggedInUser') || '{}');

    if (user.email === email && user.password === password) {
      alert('Login successful!');
      window.location.href = 'index.html';
    } else {
      alert('Invalid credentials!');
    }
  });
}

const slider = document.querySelector('.featured-car-list');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
  isDown = true;
  slider.classList.add('active');
  startX = e.pageX - slider.offsetLeft;
  scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', () => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mouseup', () => {
  isDown = false;
  slider.classList.remove('active');
});
slider.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX - slider.offsetLeft;
  const walk = (x - startX) * 2; // scroll speed
  slider.scrollLeft = scrollLeft - walk;
});

function toggleMenu() {
    var menu = document.getElementById("dropdownMenu");
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
}
