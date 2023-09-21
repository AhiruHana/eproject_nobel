<?php
include_once 'createConnection.php';

function getTable($tableName)
{
    $query = 'select * from ' . $tableName . '';
    if ($tableName == "feedback") {
        $query = $query . ' ORDER BY sending_time DESC';
    }
    $result = executeQuery($query);
    return $result;
}
function getColumnTable($tableName)
{
    $query = 'SHOW COLUMNS FROM ' . $tableName . ' WHERE Field != "password" AND Field != "resetCode" AND Field != "resetCodeTime"';
    $result = executeQuery($query);
    $fields = array_column($result, 'Field');
    return $fields;
}

function getColumnName($tableName)
{
    $query = "
        SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
        WHERE TABLE_NAME = '" . $tableName . "' 
        AND REFERENCED_TABLE_NAME IS NOT NULL
    ";
    $result = executeQuery($query);

    $columnNames = [];
    foreach ($result as $r) {
        $columnNames[] = $r["COLUMN_NAME"];
    }
    return $columnNames;
}
function getReferencedTableName($tableName, $columnName)
{
    $query = "
        SELECT REFERENCED_TABLE_NAME
        FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
        WHERE TABLE_NAME = '" . $tableName . "' 
        AND COLUMN_NAME = '" . $columnName . "'
        AND REFERENCED_TABLE_NAME IS NOT NULL
    ";
    $result = executeQuery($query);
    $referencedTableName = $result[0]["REFERENCED_TABLE_NAME"];
    return $referencedTableName;
}
function getCategorybyIdFK($tableName, $idFK, $referencedTableName, $columnName)
{
    $query = "
        SELECT DISTINCT referencedTable.id, referencedTable.name
        FROM " . $referencedTableName . " as referencedTable LEFT JOIN " . $tableName . " on referencedTable.id = " . $tableName . "." . $columnName . "
    ";
    if ($idFK > 0) {
        $query = $query . "
             WHERE " . $tableName . "." . $columnName . " = " . $idFK . ";
        ";
    }
    // var_dump($query);
    $result = executeQuery($query);
    return $result;
}

