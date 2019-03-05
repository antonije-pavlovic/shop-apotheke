<?php
    //$c = new Cart();
    if(isSession())
        $results = $c->getProduct($db,$_SESSION['user']->userID);
?>
<div class="container cart">
    <?php
        if(count($results) === 0):
    ?>
        <div class="row justify-content-center">
            <p class="lead">You have not bought anything yet</p>
        </div>

    <?php
        else:
    ?>
    <?php
        foreach ($results as $result):
    ?>
    <div class="row justify-content-center" >
        <div class="col-lg-4">
            <img src="<?= $result->picture ?>" class="card-img-top" alt="...">
        </div>
        <div class="col-lg-8">
            <div class="row mt-3">
                <?= $result->title?>
            </div>
            <div class="row mt-3">
                Active ingridients: <?= $result->active_ingrd?>
            </div>
            <div class="row mt-3">
                Description: <br/><?= $result->description?>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-lg-12">
                    <button class="btn btn-success btn-block remove" data-uid="<?= $_SESSION['user']->userID?>" data-pid="<?= $result->product_id?>">Remove</button>
                </div>
            </div>
        </div>
    </div>
    <?php
        endforeach;
    ?>
    <?php
        endif;
    ?>
    <?php
        if(count($results) !== 0):
    ?>
    <div class="row justify-content-center">
       <div class="col-lg-2">
           <button class="btn btn-success btn-block buy" data-uid="<?= $_SESSION['user']->userID ?>">Buy</button>
       </div>
    </div>
    <?php
        endif;
    ?>
</div>