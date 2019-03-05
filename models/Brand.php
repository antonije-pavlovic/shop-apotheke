<?php
/**
 * Created by PhpStorm.
 * User: antonije
 * Date: 1/20/19
 * Time: 11:19 PM
 */

class Brand
{
    function getBrands(DB $db){
        $q = 'select * from brand';
        return $db->executeQuery($q)->fetchAll();
    }

    function getBrandProducts(DB $db,$id){
        $q = 'select * from product p inner join brand b on p.brand_id = b.id where brand_id = :id';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":id",$id);
        try{
            $result = $statement->execute();
            if($result){
                $products = $statement->fetchAll();
                return $products;
            }else{
                return "Currently there is no product for this brand";
            }
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    function insertBrand(DB $db, $name){
        $q = 'insert into brand(name) values(:name)';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":name",$name);
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