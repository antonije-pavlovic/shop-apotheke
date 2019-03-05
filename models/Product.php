<?php
/**
 * Created by PhpStorm.
 * User: antonije
 * Date: 1/20/19
 * Time: 4:12 PM
 */

class Product
{
    function getLatest(DB $db){
        $q = "select *,p.id as productID from product p inner join brand b on p.brand_id=b.id limit 9";
        return $db->executeQuery($q)->fetchAll();
    }

    function getProduct(DB $db,$id){
        $q = 'select *,p.id as productID from product p inner join brand b on p.brand_id=b.id where p.id = :id';
        $statement = $db->prepareQ($q);
        $statement->bindParam(":id",$id);
        try{
            $result = $statement->execute();
            if($result)
                return json_encode($statement->fetch());
            else
                return 'You are looking for product that doesn\'t exist';
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    function getProducts(DB $db){
        $q = "select * from product";
        return $db->executeQuery($q)->fetchAll();
    }

    function insertProduct(DB $db,$title,$desc,$ingrd,$brend,$price,$imgNAme,$imgType,$imgSize,$imgPath){

        $formats = array("image/jpg", "image/jpeg", "image/png");
        if(!in_array($imgType,$formats))
            return 'image type not ok';
        if(!$imgSize > 5000000)
            return'img too large';
        $newPath = 'public/images/'.time().$imgNAme;
        if(move_uploaded_file($imgPath,$newPath)){
            $q = 'insert into product(title,picture,description,active_ingrd,price,brand_id) values(:title,:picture,:description,:ingrd,:price,:brand)';
            $statement = $db->prepareQ($q);
            $statement->bindParam(":title",$title);
            $statement->bindParam(":picture",$newPath);
            $statement->bindParam(":description",$desc);
            $statement->bindParam(":ingrd",$ingrd);
            $statement->bindParam(":price",$price);
            $statement->bindParam(":brand",$brend);
            try{
                $result = $statement->execute();
                if($result)
                    return true;
                else
                    return false;
            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }else
            return 'nesto nije ok';
    }

    function deleteProduct(DB $db,$id){
        $q = 'delete from product where id = :id';
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

    function updateProduct(DB $db,$title,$description,$ingrd,$price,$imgName,$imgType,$imgSize,$imgPath,$id){

        if($imgSize){
            $formats = array("image/jpg", "image/jpeg", "image/png");
            if(!in_array($imgType,$formats))
                return 'image type not ok';
            if(!$imgSize > 5000000)
                return'img too large';
            $newPath = 'public/images/'.$imgName;
            if(move_uploaded_file($imgPath,$newPath)){
                $q = 'update product set title = :title, picture = :pic, description = :description, active_ingrd = :ingrd, price = :price where id = :id';
                $statement = $db->prepareQ($q);
                $statement->bindParam(":title",$title);
                $statement->bindParam(":pic",$newPath);
                $statement->bindParam(":description",$description);
                $statement->bindParam(":ingrd",$ingrd);
                $statement->bindParam(":price",$price);
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
            }else
                return 'nesto nije ok';
        }else{
            $q = 'update product set title = :title, description = :description, active_ingrd = :ingrd, price = :price where id = :id';
            $statement = $db->prepareQ($q);
            $statement->bindParam(":title",$title);
            $statement->bindParam(":description",$description);
            $statement->bindParam(":ingrd",$ingrd);
            $statement->bindParam(":price",$price);
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
}