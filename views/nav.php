<?php
    if(isSession())
        $num = $c->getCartProducts($db,$_SESSION['user']->userID);
  $nl= new Navigation();
  $links = $nl->getLinks($db);
  $b = new Brand();
  $brands = $b->getBrands($db);
?>

<body>
<nav class="navbar navbar-expand-lg dark bg-dark">
    <a class="navbar-brand" href="#">
        <i class="fas fa-pills fa-3x" ></i>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <?php foreach ($links as $link):?>
            <?php if($link->id === "2"):?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $link->name ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($brands as $brand):?>
                            <a class="dropdown-item brandItem" href="?page=article&name=<?= $brand->name ?>" data-id="<?=$brand->id ?>"> <?= $brand->name?> </a>
                        <?php endforeach;?>
                    </div>
                </li>
            <?php else:?>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?<?= $link->link ?>"><?= $link->name ?> <span class="sr-only">(current)</span></a>
                </li>
            <?php
                endif;
                endforeach;
            ?>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <?php if(isSession()):?>

                <span class="mx-2 text-white">Welcome back, <?php $u = $_SESSION['user']->username; echo ucfirst($u); ?></span>
                <a href="?page=cart" type="button" class="btn btn-primary">
                    Cart <span class="badge badge-light"><?= $num->number ?></span>
                </a>
                <a href="" class="btn btn-primary my-2 my-sm-0 logout ml-3">Logout</a>
                <?php
                if($_SESSION['user']->role_id === '2'):
                    ?>
                    <a href="index.php?page=admin" class="btn btn-primary my-2 my-sm-0 ml-3">Admin</a>
                <?php
                endif;
                ?>
            <?php endif;?>

            <?php if(!isSession()):?>
                <a href="index.php?page=login" class="btn btn-primary my-2 my-sm-0">Login</a>
                <span class="mx-2 text-white">or</span>
                <a href="index.php?page=register" class="btn btn-primary my-2 my-sm-0">Register</a>
            <?php endif;?>

        </form>
    </div>
</nav>