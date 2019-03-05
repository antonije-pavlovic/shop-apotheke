<?php
 require '../models/DB.php';
 $db = new DB();
 if(isset($_GET['token'])){
 echo $_GET['token'];

     $token = $_GET['token'];

     $q = "select * from user where token = :token";
     $statement = $db->prepareQ($q);
     $statement->bindParam(":token",$token);
     $result = $statement->execute();

     $res = $statement->fetch();
     try{
         $result = $statement->execute();
         if($result){
             $user = $statement->fetch();
             if(empty($user)){
                 echo "You are not registered";
             }else{
                 $updateUser = "update user set active = 1 where token = :token";
                 $updateStatement = $db->prepareQ($updateUser);
                 $updateStatement->bindParam(":token",$token);
                 $resultUpdate = $updateStatement->execute();
                 if($resultUpdate){
                     header("Location: http://192.168.0.101/site/index.php");
                 }else{
                     echo 'Sorry, there was mistake';
                 }
             }
         }else{
             echo 'query is not ok';
         }
     }catch (PDOException $e){
         echo $e->getMessage();
     }
 }