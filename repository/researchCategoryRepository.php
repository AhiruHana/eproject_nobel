<?php
include_once 'createConnection.php';


function getCategory($id)
{
    global $idCategory;
    if ($idCategory > 0) {
        $query = "select * from prizes_category where id = " . $id . "";
        $result = executeQuery($query);
        return reset($result);
    }
}

function getResearchByCategory($idCategory,$skip,$size)
{

    $query = '
        SELECT DISTINCT r.id, r.name, r.img, r.slug, pl.award_year, p.name as prizeName FROM researches_achievements as r 
        JOIN laureates_researches_and_achievements as lr on r.id = lr.research_and_achievement_id 
        JOIN laureates as l on lr.laureate_id = l.id 
        JOIN prizes_laureates as pl on pl.laureate_id = l.id
        JOIN prizes_category as p on p.id = pl.prize_id
        WHERE lr.winning_nobel= 1 and not p.id = 7
    ';

    if ($idCategory > 0) {
        $query = $query . ' and pl.prize_id = ' . $idCategory . '';
    }

    $query= $query.' LIMIT '.$skip.', '.$size.'';
    $result = executeQuery($query);
    return $result;
}


function getTotal($idCategory)
{
    $query = '
        SELECT count(*) as total 
        FROM researches_achievements as r 
        JOIN laureates_researches_and_achievements as lr on r.id = lr.research_and_achievement_id 
        JOIN laureates as l on lr.laureate_id = l.id 
        JOIN prizes_laureates as pl on pl.laureate_id = l.id
        JOIN prizes_category as p on p.id = pl.prize_id
        WHERE lr.winning_nobel= 1 and not p.id = 7
    ';
    if ($idCategory > 0) {
        $query = $query . ' and pl.prize_id =' . $idCategory . '';
    }
    
    $result = executeQuery($query);
    $result = $result[0]["total"];
    return $result;
}
