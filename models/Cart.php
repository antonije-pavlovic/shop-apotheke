<?php
/**
 * Created by PhpStorm.
 * User: antonije
 * Date: 1/26/19
 * Time: 8:58 PM
 */

class Cart
{
    function insertProduct(DB $db , $product,$user){
        $q = 'insert into cart(user_id,product_id) values(:user,:product)';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":product",$product);
        $statement->bindParam(":user",$user);
        try{
            $result = $statement->execute();
            if($result){
                return 'You have successfully add product to cart';
            }else{
                return 'There is some mistake please try later';
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    function getProduct(DB $db,$user){
        $q = 'select * from cart c inner join product p on c.product_id = p.id where c.user_id = :id and buy = 0';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":id",$user);
        try{
            $result = $statement->execute();
            if($result){
                return $statement->fetchAll();
            }else{
                echo 'There was mistake';
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    function removeProduct(DB $db,$user,$product){
        $q = 'delete from cart where user_id = :user and product_id = :product and buy = 0';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":user",$user);
        $statement->bindParam(":product",$product);
        try{
            $result = $statement->execute();
            if($result){
                return true;
            }else{
                return 'Try later';
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    function buyProduct(DB $db,$product,$user){
        $q = 'update cart set buy = 1 where product_id = :product and user_id = :user';
        $statement = $db->prepareQ($q);
        $statement->bindParam("product",$product);
        $statement->bindParam("user",$user);
        try{
            $result = $statement->execute();
            if($result){
                $num = $statement->rowCount();

                return $num;
            }else{
                return false;
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    function getCartProducts(DB $db, $user){
        $q = 'select count(*) as number from cart where buy = 0 and user_id = :user';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":user",$user);
        try{
            $result = $statement->execute();
            if($result)
                return $statement->fetch();
            return false;

        }catch (PDOException $e){
            echo $e->getMessage();

        }
    }
}