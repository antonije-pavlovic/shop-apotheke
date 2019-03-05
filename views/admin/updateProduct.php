<?php
$p = new Product();
$products = $p->getProducts($db);

if(isset($_POST['updateProduct'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingrd = $_POST['ingrd'];
    $price = $_POST['price'];
    $image = $_FILES['file'];
    $id = $_POST['id'];

        /****R E G U L A R  E X P R E S S I O N*****/
    $imgName = $image['name'];
    $imgType = $image['type'];
    $imgSize = $image['size'];
    $imgPath = $image['tmp_name'];

    $response = $p->updateProduct($db,$title,$description,$ingrd,$price,$imgName,$imgType,$imgSize,$imgPath,$id);
    if($response)
        header('Location: index.php?page=admin');
    else
        echo 'Something is not good my dear friend';
}
if(isSession() && $_SESSION['user']->role_id === '2'):
?>
<div class="container">
    <div class="row showProduct">
        <table class="table mt-5">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">picture</th>
                <th scope="col">Handle</th>
                <th scope="col">Delete</th>
                <th scope="col">Update</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $flag = 0;
            foreach ($products as $product):
                $flag++;
                ?>
                <tr>
                    <th scope="row"><?= $flag ?></th>
                    <td><?= $product->title ?></td>
                    <td><img src="<?= $product->picture ?>" width="100px"/></td>
                    <td><?= $product->brand_id ?></td>
                    <td><button type="button" class="btn btn-danger deleteProduct" data-id="<?= $product->id?>">Delete</button></td>
                    <td><button type="button" class="btn btn-primary updateProduct" data-id="<?= $product->id?>">Update</button></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
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