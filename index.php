<?php

include "./Nav/Manu.php";

?>
<!--Catigiry-->
<div class="container">
    <div class="category full-width">
        <img src="./img/Group-33704.webp" alt="Paan Corner" class="category-image">
        <!--<div class="category-content">
                <h3>Paan Corner</h3>
                <p>Your favorite paan shop is now online</p>
                <button>Shop Now</button>
            </div>-->
    </div>
</div>
<div class="parent-div">
    <div class="child-div">
        <img src="./img/Pet-Care_WEB.avif" alt="Pet-Care">
    </div>
    <div class="child-div">
        <img src="./img/pharmacy-WEB.avif" alt="pharmacy">
    </div>
    <div class="child-div">
        <img src="./img/babycare-WEB.avif" alt="babycare">
    </div>
</div>
<!--End-->
<div class="category-section">
    <?php while ($parent = $categories->fetch_assoc()) : ?>
        <div class="category-item">
            <a href="Child_products.php?parent_id=<?= $parent['id'] ?>">
                <img src="./C-items/<?= $parent['image'] ?>" alt="<?= $parent['name'] ?>">
            </a>
        </div>
    <?php endwhile; ?>
</div>

<?php

include "./Nav/footer.php";

?>