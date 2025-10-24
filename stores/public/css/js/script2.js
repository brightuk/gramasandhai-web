const toggleBtn = document.getElementById('menu-toggle');
const sideMenu = document.getElementById('side-menu');
const overlay = document.getElementById('overlay');
const categoryLink = document.querySelector('[data-bs-toggle="offcanvas"]');

toggleBtn.addEventListener('click', () => {
  sideMenu.classList.add('active');
  overlay.style.display = 'block';
});

overlay.addEventListener('click', () => {
  sideMenu.classList.remove('active');
  overlay.style.display = 'none';
});

// when clicking Shop by Category, close side menu
categoryLink.addEventListener('click', () => {
  sideMenu.classList.remove('active');
  overlay.style.display = 'none';
});

categoryLink.addEventListener('click', (e) => {
  e.stopPropagation();
  sideMenu.classList.remove('active');
  overlay.style.display = 'none';
});


// const toggleBtn = document.getElementById('menu-toggle');
// const sideMenu = document.getElementById('side-menu');
// const overlay = document.getElementById('overlay');

// toggleBtn.addEventListener('click', () => {
//   sideMenu.classList.add('active');
//   overlay.style.display = 'block';
// });

// overlay.addEventListener('click', () => {
//   sideMenu.classList.remove('active');
//   overlay.style.display = 'none';
// });



document.addEventListener('DOMContentLoaded', function() {
    // Toggle submenus
    const menuItemsWithSubmenu = document.querySelectorAll('.menu-item.has-submenu');

    menuItemsWithSubmenu.forEach(item => {
        item.addEventListener('click', function(e) {
            // Don't trigger if clicking on submenu or link
            if (e.target.classList.contains('submenu-item') || e.target.tagName === 'A') return;

            // Close other open submenus
            menuItemsWithSubmenu.forEach(otherItem => {
                if (otherItem !== this && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.submenu').classList.remove('active');
                }
            });

            this.classList.toggle('active');
            this.querySelector('.submenu').classList.toggle('active');
        });
    });

    // Close submenus when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.category-menu')) {
            menuItemsWithSubmenu.forEach(item => {
                item.classList.remove('active');
                item.querySelector('.submenu').classList.remove('active');
            });
        }
    });
});


