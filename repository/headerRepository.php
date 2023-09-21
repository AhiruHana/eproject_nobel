<?php
    require_once 'createConnection.php';

    function getMenuParent(){
        $connection = createConnection();
        $query = "select * from menu where parentId = 0";
        $result=executeQuery($query);
        return $result;
    }
    function getMenuChild($parentId){
        $connection = createConnection();
        $query = "select * from menu where parentId = ".$parentId."";
        $result=executeQuery($query);
        return $result;
    }
    function getConfig($code){
        $connection = createConnection();
        $query = "select * from config where code ='".$code."'";
        $result=executeQuery($query);
        return reset($result);
    }

?>