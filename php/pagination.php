<?php

$b = new Brand();
//$brandID=null;
    if(isset($_GET['name'])){
        $brandName = $_GET['name'];
        $q = "select  *, brand_id as brandID from brand b inner join product p on b.id = p.brand_id where b.name ="."'".$brandName."'";
       // echo $q;
        $result = $db->executeQuery($q)->fetchAll();
        $numOfPages = ceil(count($result) / 3);
        $brandID = $result[0]->brandID;
    }
        $perPage = 3;


        //pagination
        if (isset($_GET['num'])) {
            $page = $_GET['num'];
        } else {
            $page = 0;

        }

        $startPosition = $page + ($page * 2);
        $q = "select *,p.id as productID from product p inner  join brand b on p.brand_id = b.id where p.brand_id=".$brandID." limit ".$startPosition .",".$perPage . ";";
       // $q = 'select * from product where brand_id="' . $brandID . '" limit ' . $startPosition . ',' . $numOfPages . ' ';

        $products = $db->executeQuery($q)->fetchAll();
?>