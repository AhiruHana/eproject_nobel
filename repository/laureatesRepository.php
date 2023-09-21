<?php
require_once 'createConnection.php';

function getPrizeCategoryById()
{
    global $idCategory;

    if ($idCategory > 0) {
        $query = '
            select * from prizes_category where id = ' . $idCategory . '
        
        ';
        $result = executeQuery($query);
        // var_dump($query);
        return reset($result);
    }
}

function getLaureatesByCategoryId($idCategory,$skip,$size)
{
    global $keyword;

    $query = '
            select la.id, la.name , la.avatar, la.slug, pl.award_year ,pl.reason_winning,pc.name as categoryname
            from prizes_laureates as pl
            join prizes_category as pc on pc.id = pl.prize_id
            join laureates as la on la.id = pl.laureate_id
            where 1=1 
            AND pl.prize_id !=7
        ';
    if ($idCategory > 0) {
        $query = $query . ' and pc.id =' . $idCategory . '';
    }
    if ($keyword != "") {
        $query = $query . ' and (la.name LIKE "%' . $keyword . '%" OR pl.award_year LIKE "%' . $keyword . '%")';
    }
    $query= $query.' LIMIT '.$skip.', '.$size.'';

    $result = executeQuery($query);
    return $result;
}

function getTotal($idCategory)
{
    global $keyword;

    $query = '
            select count(*) as total
            from prizes_laureates as pl
            join prizes_category as pc on pc.id = pl.prize_id
            join laureates as la on la.id = pl.laureate_id
            where 1=1 
            AND pl.prize_id !=7
        ';
    if ($idCategory > 0) {
        $query = $query . ' and pc.id =' . $idCategory . '';
    }
    if ($keyword != "") {
        $query = $query . ' and (la.name LIKE "%' . $keyword . '%") OR (pl.award_year LIKE "%' . $keyword . '%")';
    }

    $result = executeQuery($query);
    $result = $result[0]["total"];
    return $result;
}
