<?php

class User
{

    function getAllUsers(DB $db){
        $q = 'select * from user';
        return $db->executeQuery($q)->fetchAll();
    }

    function getRoles(DB $db){
        $q = 'select * from role';
        return $db->executeQuery($q)->fetchAll();
    }

    function deleteUser(DB $db, $id){
        $q = 'delete from user where id = :id';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":id",$id);
        try{
            $result = $statement->execute();
            if($result)
                return true;
            else
                return false;
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    function getUser(DB $db, $id){
        $q = 'select *,u.name as userName,u.id as userID from user u inner join role r on u.role_id = r.id where u.id = :id';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":id",$id);
        try {
            $result = $statement->execute();
            if($result){
                $user = $statement->fetch();
                $roles = $this->getRoles($db);
                $data = [$user,$roles];
                return json_encode($data);
            }

            else
                return 'Error';
        }catch (PDOException $e){
            $e->getMessage();
        }
    }

    function updateUser(DB $db,$id,$name,$username,$email,$role,$status){
        $q = 'update user set name = :name,username = :username,email = :email,role_id = :role, active = :status where id = :id';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":name",$name);
        $statement->bindParam(":username",$username);
        $statement->bindParam(":email",$email);
        $statement->bindParam(":role",$role);
        $statement->bindParam(":status",$status);
        $statement->bindParam(":id",$id);
        try{
            $result = $statement->execute();
            if($result)
                return true;
            else
                return false;
        }catch (PDOException $e){
            echo $e->getMessage();
        }

    }


}