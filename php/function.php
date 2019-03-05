<?php
function getPage($page){
    switch ($page) {
        case 'author':
            return 'author.php';
            break;
        case 'contact':
            return 'contact.php';
            break;
        case 'login':
            return 'login.php';
            break;
        case 'article':
            return 'article.php';
            break;
        case 'register':
            return 'register.php';
            break;
        case 'product':
            return 'product.php';
            break;
        case 'cart':
            return 'cart.php';
            break;
        case 'admin':
            return 'admin.php';
            break;
        case 'addUser':
            return 'admin/addUser.php';
            break;
        case 'addProduct':
            return 'admin/addProduct.php';
            break;
        case 'addBrand':
            return 'admin/addBrand.php';
            break;
        case 'update':
            return 'admin/update.php';
            break;
        case 'updateProduct':
            return 'admin/updateProduct.php';
            break;
        default:
            return 'home.php';
    }
}

function isSession(){
    if(isset($_SESSION['user']))
        return true;
    else
        return false;
}
