<?php
session_start();
require ('../models/DB.php');
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo "djes po'so";
}else{
    if(isset($_POST['send'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $data = 0;
        $db = new DB();
        $password = md5($password);
        $q = "select *,u.id as userID from user u inner join role r on u.role_id = r.id where u.email = :email and u.password = :password and u.active = 1";
        $statement = $db->prepareQ($q);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':password',$password);
        try{
            $statement->execute();
            if($statement->rowCount() == 1) {
                $user = $statement->fetch();
                $_SESSION['user'] = $user;
                $data=200;
                echo json_encode($data);
            }else {
                $data = 300;
                echo json_encode($data);
            }
        }catch (PDOException $e){
            echo json_encode('usao u gresku');
            echo $e->getMessage();
        }
    }
}