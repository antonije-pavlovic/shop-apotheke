<?php
session_start();
require ('models/DB.php');
$db = new DB();
require 'models/Product.php';
require 'models/User.php';
require 'models/Navigation.php';
require 'models/Brand.php';
require 'models/Cart.php';
$c = new Cart();
require 'php/function.php';
require 'views/head.php';
require 'views/nav.php';


    if(isset($_GET['page'])){
        $page = getPage($_GET['page']);
        include sprintf('views/%s',$page);
    }else
        include "views/home.php";

require ('views/footer.php');

