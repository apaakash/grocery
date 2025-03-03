<?php
include 'config.php';
$categories = $conn->query("SELECT * FROM parent_categories");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Navbar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="style2.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark px-3">
        <a class="navbar-brand fw-bold text-white" href="#"><em>Grocery</em></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="search-box d-flex mx-auto">
                <input type="text" class="form-control search-input" placeholder="Search grocery products" />
                <button class="search-btn px-2">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            <div class="ms-auto d-flex align-items-center flex-column flex-lg-row mt-3 mt-lg-0">
                <div class="dropdown mx-3">
                    <a href="#" class="nav-item dropdown-toggle" id="accountDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">My Account</a>
                    <ul class="dropdown-menu" aria-labelledby="accountDropdown">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">Order</a></li>
                        <li><a class="dropdown-item" href="#">Wishlist</a></li>
                        <li><a class="dropdown-item" href="#">Notifications</a></li>
                        <li><a class="dropdown-item" href="#">Logout</a></li>
                    </ul>
                </div>
                <div class="dropdown mx-3">
                    <a href="#" class="nav-item dropdown-toggle" id="moreDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">More</a>
                    <ul class="dropdown-menu" aria-labelledby="moreDropdown">
                        <li><a class="dropdown-item" href="#">Become a Seller</a></li>
                        <li><a class="dropdown-item" href="#">24*7 Customer Care</a></li>
                    </ul>
                </div>
                <a href="#" class="nav-item mx-3"><i class="bi bi-bag-check"></i></a>
                <a href="#" class="nav-item mx-3"><img id="logo" src="logo1.png" alt="" /></a>
            </div>
        </div>
    </nav>

    <!-- Line after navbar -->
    <hr style="border: 1px solid #ccc; margin: 0;">
    <!-- Content of the page can go here -->

    <!--Catigiry-->
    <div class="container">
        <div class="category full-width">
            <img src="Group-33704.webp" alt="Paan Corner" class="category-image">
            <!--<div class="category-content">
                <h3>Paan Corner</h3>
                <p>Your favorite paan shop is now online</p>
                <button>Shop Now</button>
            </div>-->
        </div>
    </div>
    <div class="parent-div">
        <div class="child-div">
            <img src="Pet-Care_WEB.avif" alt="Pet-Care">
        </div>
        <div class="child-div">
            <img src="pharmacy-WEB.avif" alt="pharmacy">
        </div>
        <div class="child-div">
            <img src="babycare-WEB.avif" alt="babycare">
        </div>
    </div>
    <!--End-->
    <div class="category-section">
        <?php while ($parent = $categories->fetch_assoc()) : ?>
            <div class="category-item">
                <a href="Child_Product.php?parent_id=<?= $parent['id'] ?>">
                    <img src="./C-items/<?= $parent['image'] ?>" alt="<?= $parent['name'] ?>">
                </a>
            </div>
        <?php endwhile; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>