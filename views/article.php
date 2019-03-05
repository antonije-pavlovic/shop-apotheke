<?php require 'php/pagination.php'; ?>
<div class="container">
    <div class="row mt-5 mb-5">
        <?php foreach ($products as $product): ?>

        <div class="col-lg-4 border">
            <div class="row">
                <div class="col-lg-6  p-2 ml-4">
                    <div class="card">
                        <img src="<?= $product->picture ?>" class="card-img-top" alt="...">
                    </div>
                    <a href="?page=product&id=<?= $product->productID?>" class="btn btn-success btn-block my-2 text-light">Read More</a>
                    <?php if(isSession()):?>
                    <button class="btn btn-success btn-block addToCart" data-uid="<?= $_SESSION['user']->userID ?>" data-pid="<?= $product->productID?>">Add to cart <i class="fas fa-shopping-cart"></i></button>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6">
                    <p class="lead"> <?= $product->title ?> <i class="fab fa-adn"></i></p>
                    <p class="lead">Description</p>
                    <p class="lead">Price <span class="badge badge-success"><?= $product->price ?> €</span></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="row pagination mt-5 mb-5 justify-content-center">
        <nav aria-label="Page navigation example mt-5">
            <ul class="pagination mt-5">
                <?php
                    for($i = 0 ; $i < $numOfPages ; $i++):
                ?>
                <li class="page-item"><a class="page-link" href="?page=article&brand=<?= $result[0]->brandID ?>&num=<?= $i ?>&name=<?= $result[0]->name                     ?>"><?= $i + 1 ?></a></li>
                <?php
                    endfor;
                ?>
            </ul>
        </nav>
    </div>
</div>