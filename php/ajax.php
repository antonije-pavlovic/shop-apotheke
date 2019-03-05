<?php
require '../models/DB.php';
require '../models/Brand.php';
require '../models/Survei.php';
require '../models/Cart.php';
$db = new DB();
$b = new Brand();
$s = new Survei();
$c= new Cart();

 if(isset($_GET['brand'])){
     header('Content-Type: application/json');
     $id = $_GET['id'];
     $data = $b->getBrandProducts($db,$id);
     echo json_encode($data);
 }

 if(isset($_GET['survey'])){
     $id = $_GET['userID'];
     $objQ = $_GET['objQ'];
     $objA = $_GET['objA'];

    for($i = 1 ; $i <= 3 ; $i++){
        $response = $s->insertFinalAnswer($db,$id, $objQ['q'.$i], $objA['a'.$i]);
    }
     echo $response;
 }

 if(isset($_GET['add'])){
     $userID = $_GET['userID'];
     $productID = $_GET['productID'];
     return $c->insertProduct($db,$productID,$userID);

 }

 if(isset($_POST['remove'])){
    $userID = $_POST['userID'];
    $productID = $_POST['productID'];
    $c->removeProduct($db,$userID,$productID);
    echo $productID;
 }

 if(isset($_POST['buy'])){
     $products = json_decode(stripslashes($_POST['temp']));
     $userID = $_POST['userID'];
     $flag = false;
     for($i = 0 ; $i < count($products) ; $i++){
         $flag= $c->buyProduct($db,$products[$i],$userID);
     }
     if($flag)
         echo $flag;
     else
         echo $flag;
 }

