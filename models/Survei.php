<?php
/**
 * Created by PhpStorm.
 * User: antonije
 * Date: 1/26/19
 * Time: 11:37 AM
 */

class Survei
{
    function getQuestions(DB $db){
        $q = 'select * from question';
        return $db->executeQuery($q)->fetchAll();
    }

    function getAnswers(DB $db,$id){
        $q = 'select * from answer where question_id = :id';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":id",$id);
        try{
            $result = $statement->execute();
            if($result){
                return $statement->fetchAll();
            }else{
                return "Currently there is no any survei";
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    function insertFinalAnswer(DB $db,$user,$question,$answer){
        $q = 'insert into finalAnswer(question_id,answer_id,user_id) values(:question,:answer,:user)';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":question",$question);
        $statement->bindParam(":answer",$answer);
        $statement->bindParam(":user",$user);
        try{
            $result = $statement->execute();
            if($result){
                return "Thanks";
            }else{
                return "Somethings went wrong try another time, sorry";
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    function checkUser(DB $db,$id){
        $q = 'select * from finalAnswer where user_id = :id';
        $statement = $db->prepareQ($q);
        $statement->bindParam(':id',$id);
        try{
             $statement->execute();
                if($statement->rowCount() !== 0)
                    return true;
                else
                    return false;
        }catch (PDOException $e){
            echo $e->getMessage();
        }

    }
}