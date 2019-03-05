<?php
/**
 * Created by PhpStorm.
 * User: antonije
 * Date: 1/20/19
 * Time: 11:21 PM
 */

class Navigation
{
    function getLinks(DB $db){
        $q = 'select * from navigation';
        return $db->executeQuery($q)->fetchAll();
    }
}