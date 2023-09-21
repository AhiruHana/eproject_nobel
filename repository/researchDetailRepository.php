<?php
include_once 'createConnection.php';

function getResearchDetail($researchId)
{
    $queryUpdate = "UPDATE researches_achievements SET view = view + 1 WHERE id = " . $researchId;
    $updateView = mysqli_query(createConnection(), $queryUpdate);

    $query = '
        SELECT r.*, l.name as laureate, lr.partner, pl.award_year 
        FROM `researches_achievements` as r 
        JOIN laureates_researches_and_achievements as lr on r.id = lr.research_and_achievement_id 
        JOIN laureates as l on lr.laureate_id = l.id 
        JOIN prizes_laureates as pl on l.id=pl.laureate_id 
        WHERE r.id = ' . $researchId . ' limit 1
    ';
    $result = executeQuery($query);
    return reset($result);
}

function getSimilarResearch($researchId)
{
    $query = '
        SELECT DISTINCT r.* from researches_achievements as r 
        join laureates_researches_and_achievements as lr on r.id = lr.research_and_achievement_id 
        join laureates as l on l.id = lr.laureate_id
        JOIN prizes_laureates as pl on pl.laureate_id = l.id
        where pl.prize_id in (
            select DISTINCT pl.prize_id 
            FROM prizes_laureates as pl
            join laureates as l on l.id = pl.laureate_id
            where l.id = (
                SELECT l.id FROM laureates as l
                JOIN laureates_researches_and_achievements as lr on l.id = lr.laureate_id
                JOIN researches_achievements as r on lr.research_and_achievement_id = r.id
                WHERE r.id = '.$researchId.'
                ) and not pl.prize_id =7
        ) and lr.winning_nobel=1 and not r.id = ' . $researchId . '
    ';
    $result = executeQuery($query);
    return ($result);
}
