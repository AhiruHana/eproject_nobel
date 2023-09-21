<?php
include_once 'createConnection.php';

function getTableName()
{
    $query = "
        SELECT table_name
        FROM information_schema.tables
        WHERE table_schema = 'eproject_biograph'
        AND table_name NOT in ('users','feedback','menu','config')
    ";
    
    $result = executeQuery($query);
    return $result;
}
