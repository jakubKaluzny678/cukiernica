import "../node_modules/bootstrap/scss/bootstrap.scss";
import "bootstrap";
import "./src/style.scss";
function scrollToClass(t) {
    let e = document.querySelector("." + t);
    e && e.scrollIntoView({ behavior: "smooth" });
}
document.addEventListener("DOMContentLoaded", function () {
    let t = document.getElementById("mainPage");
    "/index.html" === window.location.pathname && t.classList.add("active");
}),
    document.addEventListener("DOMContentLoaded", () => {
        let t = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        [...t].map((t) => new bootstrap.Tooltip(t));
    });
  document.addEventListener('DOMContentLoaded', function () {
    const scrollToTopButton = document.getElementById('btn-back-to-top');
window.onscroll = function() {
  scrollFunction();
};
function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) 
  {
    scrollToTopButton.style.display = 'inline-block';
  } else {
    scrollToTopButton.style.display = 'none';
  }
}
function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
};
scrollToTopButton.addEventListener("click", backToTop)
    
    // skrypt działa po załadowaniu całego DOM'u

  const trigger = document.getElementById('toggleSideBar');
  const sidebar = document.getElementById('scrollSideBar');

  function showSidebarDesktop() {
    trigger.style.display = 'none';
    sidebar.style.visibility = 'visible';
    sidebar.style.width = '3.75rem';
    sidebar.style.padding = '1rem 0';
  }

  function hideSidebarDesktop() {
    setTimeout(() => {
      if (!sidebar.matches(':hover') && !trigger.matches(':hover')) {
        sidebar.style.width = '0';
        sidebar.style.padding = '0';
        trigger.style.display = 'block';
      }
    }, 100);
  }

  function showSidebarMobile() {
    trigger.style.display = 'none';
    sidebar.style.visibility = 'visible';
    sidebar.style.width = '3.75rem';
    sidebar.style.padding = '1rem 0';
  }

  function hideSidebarMobile() {
    sidebar.style.width = '0';
    sidebar.style.padding = '0';
    trigger.style.display = 'block';
  }

  if (window.innerWidth >= 768) {
    // Desktop
    trigger.addEventListener('mouseenter', showSidebarDesktop);
    trigger.addEventListener('mouseleave', hideSidebarDesktop);
    sidebar.addEventListener('mouseleave', hideSidebarDesktop);
  } else {
    // Mobile
    trigger.addEventListener('click', function (e) {
      e.stopPropagation(); // zapobiega zamknięciu sidebaru od razu
      showSidebarMobile();
    });

    document.body.addEventListener('click', function (e) {
      if (
        !sidebar.contains(e.target) &&
        !trigger.contains(e.target)
      ) {
        hideSidebarMobile();
      }
    });

    // Zapobiegaj zamknięciu przy kliknięciu wewnątrz sidebaru
    sidebar.addEventListener('click', function (e) {
      e.stopPropagation();
    });
  }
});
// JavaScript - prosty i działający
document.addEventListener('DOMContentLoaded', function () {
  const trigger = document.getElementById('toggleSideBar');
  const sidebar = document.getElementById('scrollSideBar');

  function showSidebarMobile() {
    sidebar.style.visibility = 'visible';
    sidebar.style.width = '4rem'; // dowolna szerokość
    trigger.style.display = 'none';
  }

  function hideSidebarMobile() {
    sidebar.style.width = '0';
    sidebar.style.visibility = 'hidden';
    trigger.style.display = 'block';
  }

  // Pokaż sidebar po kliknięciu w trigger
  trigger.addEventListener('click', function (e) {
    e.stopPropagation(); // zapobiega natychmiastowemu zamknięciu
    showSidebarMobile();
  });

  // Kliknięcie poza sidebar — ukryj go
  document.addEventListener('click', function (e) {
    if (!sidebar.contains(e.target) && !trigger.contains(e.target)) {
      hideSidebarMobile();
    }
  });
  // Kliknięcia w środku sidebaru nie zamykają go
  sidebar.addEventListener('click', function (e) {
    e.stopPropagation();
  });
});
