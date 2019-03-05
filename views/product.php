<?php
    $id = $_GET['id'];
    $p = new Product();
    $res = $p->getProduct($db,$id);
    $product = json_decode($res);
?>
<div class="container">
<div class="row m-5">
    <div class="col-ls-6 p-3">
        <div class="card">
            <img src="<?= $product->picture ?>" class="card-img-top" alt="...">
        </div>
    </div>
    <div class="col-ls-6 p-3">
        <p class="lead"> <?= $product->title ?> <i class="fab fa-adn"></i></p>
        <p class="lead">Active ingridients: <?= $product->active_ingrd ?></p>
        <p class="lead">Price :<span class="badge badge-info"><?= $product->price ?> €</span></p>
        <?php if (isSession()): ?>
            <button class="btn btn-success btn-block">Add to cart <i class="fas fa-shopping-cart"></i></button>
        <?php endif; ?>
    </div>
</div>
    <div class="row m-5" >
        <p class="lead">Description:</p>
            <hr>
        <p class="lead mb-5"><?= $product->description ?></p>
    </div>
</div>