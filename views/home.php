<?php
  $latestProducts = new Product();
  $products = $latestProducts->getLatest($db);
?>

<section id="home-view">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="public/images/slika1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="public/images/slika2.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="public/images/slika3.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <div class="container my-5">
        <h1 class="text-center my-5">Latest Products</h1>

        <?php
          $flag = 0;
          foreach ($products as $product):
        ?>
        <?php if($flag === 0 || $flag === 3 || $flag === 6): ?>
          <div class="row mt-4" >
        <?php endif;?>
        <?php $flag++ ?>
            <div class="col-lg-3 border p-5 ml-4">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <img src="<?= $product->picture ?>" class="card-img-top" alt="...">
                        </div>
                        <a href="?page=product&id=<?= $product->productID?>" class="btn btn-success btn-block my-2 text-light">Read More</a>
                        <?php if(isSession()):?>
                        <button class="btn btn-success btn-block addToCart" data-uid="<?= $_SESSION['user']->userID ?>" data-pid="<?= $product->productID?>">Add to cart <i class="fas fa-shopping-cart"></i></button>
                        <?php endif;?>
                    </div>
                    <div class="col-lg-6">
                        <p class="lead"> <?= $product->title ?> <i class="fab fa-adn"></i></p>
                        <p class="lead">Description</p>
                        <p class="lead">Price <span class="badge badge-success"><?= $product->price ?> €</span></p>
                    </div>
                </div>
            </div>
        <?php if($flag === 0 || $flag === 3 || $flag === 6): ?>
            </div>
        <?php endif;?>
        <?php endforeach; ?>
    </div>
</section>