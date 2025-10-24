<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <title>Bootstrap Example</title>
</head>

<body>



    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
    }

    /* body {
      padding: 20px;
      background: #f9f9f9;
    } */

    .search-bar {
        margin-bottom: 20px;
    }

    .search-bar input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    .auth-links {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-bottom: 20px;
    }

    .auth-links a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
    }

    .category-menu {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .menu-items {
        height: auto;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }

    .menu-item {
        padding: 12px 20px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        position: relative;
    }

    .menu-item.has-submenu {
        padding-right: 35px;
        /* Add space for the arrow */
    }

    .menu-item.has-submenu::after {
        content: "▶";
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        color: #666;
        transition: transform 0.2s;
    }

    .menu-item.has-submenu.active::after {
        content: "▼";
        transform: translateY(-50%);
    }

    .submenu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        padding-left: 15px;
        background: #f5f5f5;
    }

    .submenu.active {
        max-height: 300px;
    }

    .submenu-item {
        padding: 10px 15px;
        border-bottom: 1px solid #e0e0e0;
    }

    .submenu-item:last-child {
        border-bottom: none;
    }

    .css-fp37z4 {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        -webkit-align-items: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        gap: 0.5rem;
        background: var(--chakra-colors-primary-base);
        padding: var(--chakra-space-4);
        position: relative;
    }
    </style>

    <!-- Example: Add Auth Links and Search Bar if needed
  <div class="auth-links">
    <a href="/login">Login</a>
    <a href="/register">Register</a>
  </div>
  <div class="search-bar">
    <input type="text" placeholder="Search products or categories...">
  </div>
  -->

    <div>
        <div class="w-100 bg-success text-white d-flex justify-content-between p-3 mb-4">
            <h2 class="text-center">Categories</h2>
            <a href="<?=base_url('/')?>" class="btn btn-outline-light">X</a>
        </div>

        <div class="category-menu">
            <div class="menu-items active">
                <?php foreach ($categories as $category): ?>
                <div class="menu-item has-submenu">
                    <?= esc($category['category_name']) ?>
                    <div class="submenu">
                        <?php foreach ($subcategories as $subcategory): ?>
                        <?php if ($subcategory['main_category'] == $category['category_name']): ?>
                        <div class="submenu-item"><a
                                href="<?= base_url('index.php/productShow/'.$category['id'].'/'.$subcategory['id']) ?>"><?= esc($subcategory['sub_category_name']) ?>
                            </a></div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle submenus
        const menuItemsWithSubmenu = document.querySelectorAll('.menu-item.has-submenu');

        menuItemsWithSubmenu.forEach(item => {
            item.addEventListener('click', function(e) {
                // Don't trigger if clicking on submenu
                if (e.target.classList.contains('submenu-item')) return;

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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>