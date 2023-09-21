<?php
require_once 'createConnection.php';

function getBiography($laureateId)
{
    $queryUpdate = "UPDATE laureates SET view = view + 1 WHERE id = " . $laureateId;
    $updateView = mysqli_query(createConnection(), $queryUpdate);

    $querySelect = "SELECT * FROM laureates WHERE id = " . $laureateId;
    $result = executeQuery($querySelect);
    return reset($result);
}
function getResearchById($laureateId)
{
    $query = "
        SELECT r.*, lr.partner FROM laureates as l JOIN laureates_researches_and_achievements as lr on l.id = lr.laureate_id JOIN researches_achievements as r on lr.research_and_achievement_id = r.id WHERE l.id ='".$laureateId."'
    ";
    $result = executeQuery($query);
    return $result;
}
