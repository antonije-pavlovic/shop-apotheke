<?php
    require '../../models/DB.php';
    require '../../models/User.php';
    require '../../models/Brand.php';
    require '../../models/Product.php';
    $db = new DB();
    $u = new User();
    $b = new Brand();
    $p = new Product();

if(isset($_POST['addUser'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $activeStatus = $_POST['activeStatus'];
    $role_id = $_POST['role'];

    $password = md5($password);
    $date=date("Y-m-d H:m:s",time());
    $token = md5(time() . $date);

    $q = 'insert into user(name,username,email,password,token,active,role_id)
    values(:name,:username,:email,:password,:token,:active,:role_id)';

    $statement = $db->prepareQ($q);
    $statement->bindParam(":name",$name);
    $statement->bindParam(":username",$username);
    $statement->bindParam(":email",$email);
    $statement->bindParam(":password",$password);
    $statement->bindParam(":token",$token);
    $statement->bindParam(":active",$activeStatus);
    $statement->bindParam(":role_id",$role_id);
    try{
        $result = $statement->execute();
        if($result){
            echo 'You have successfully added a user';
        }else{
            echo 'Something is not right to contact the programmer';
        }
    }catch (PDOException $e){
        echo $e->getMessage();
    }
}

if(isset($_POST['deleteUser'])){
    $id = $_POST['id'];
    echo $u->deleteUser($db,$id);
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    echo $u->getUser($db,$id);
}

if(isset($_POST['updateUser'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role= $_POST['role'];
    $status= $_POST['status'];
    $uid = $_POST['uid'];
    echo $u->updateUser($db,$uid,$name,$username,$email,$role,$status);
}

if(isset($_POST['brand'])){
    $name = $_POST['name'];
    echo $b->insertBrand($db, $name);
}

if(isset($_POST['deleteProduct'])){
    $id = $_POST['id'];
    echo $p->deleteProduct($db,$id);
}

if(isset($_POST['updateProduct'])){
    $id = $_POST['id'];
    echo $p->getProduct($db,$id);
}
