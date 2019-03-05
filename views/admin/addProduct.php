<?php

if(isset($_POST['product'])){
    $title = $_POST['title'];
    $desc = $_POST['desc'];
    $ingrd = $_POST['ingrd'];
    $brend = $_POST['brend'];
    $price = $_POST['price'];
    $image = $_FILES['file'];

    /****R E G U L A R  E X P R E S S I O N*****/
    $imgName = $image['name'];
    $imgType = $image['type'];
    $imgSize = $image['size'];
    $imgPath = $image['tmp_name'];

    $p = new Product();
    $response = $p->insertProduct($db,$title,$desc,$ingrd,$brend,$price,$imgName,$imgType,$imgSize,$imgPath);
    if($response)
        header('Location: index.php?page=addProduct');
    else
        echo 'Something is not good my dear friend';
}
    $b = new Brand();
    $brands = $b->getBrands($db);
?>
<?php
if(isSession() && $_SESSION['user']->role_id === '2'):
?>
<div class="container">
    <form class="form-horizontal mt-5 mb-5" enctype="multipart/form-data" action = "index.php?page=addProduct" method="POST">
        <fieldset>
            <legend>PRODUCTS</legend>
            <div class="form-group">
                <label class="col-md-4 control-label">PRODUCT TITLE</label>
                <div class="col-md-4">
                    <input id="title" name="title" placeholder="PRODUCT TITLE" class="form-control input-md" type="text"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" >PRODUCT DESCRIPTION</label>
                <div class="col-md-4">
                    <input id="desc" name="desc" placeholder="PRODUCT DESCRIPTION" class="form-control input-md" type="text"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" >ACTIVE INGRIDIENTS</label>
                <div class="col-md-4">
                    <input id="ingrd" name="ingrd" placeholder="ACTIVE INGRIDIENTS" class="form-control input-md" type="text"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" >PRODUCT BREND</label>
                <div class="col-md-4">
                    <select id="brend" name="brend" class="form-control"/>
                        <option value="0">Choose brand</option>
                        <?php
                            for($i = 0 ; $i < count($brands) ; $i++):
                        ?>
                            <option value="<?= $i+1 ?>"> <?= $brands[$i]->name ?> </option>
                        <?php
                            endfor;
                        ?>
                    </select>
                </div>
                <label class="col-md-4 control-label">If there is no looking brand click <a href="?page=addBrand">here to add one</a></label>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">PRODUCT IMAGE</label>
                <div class="col-md-4">
                    <input name="file" class="input-file" type="file"  id="file"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">PRODUCT PRICE</label>
                <div class="col-md-4">
                    <input id="price" name="price"  type="number"/>
                </div>
            </div>
        </fieldset>
        <input type="submit" name="product" class="btn btn-danger text-white" value="Submit"/>
    </form>
</div>
<?php
else:
    ?>
    <div class="container my-5">
        <img src="public/images/admin.jpg" alt="blaa">
    </div>
<?php
endif;
?>