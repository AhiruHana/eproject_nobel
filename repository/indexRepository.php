<?php
include_once 'createConnection.php';

function getEminent()
{
    $query = 'SELECT l.id, l.slug, l.name, l.avatar FROM laureates as l join prizes_laureates as pl on l.id = pl.laureate_id join prizes_category as p on pl.prize_id = p.id WHERE p.id = 7';
    $result = executeQuery($query);
    return $result;
}
function getResearchEminert()
{
    $query = 'SELECT r.id,r.name, r.slug,r.img,r.recap FROM laureates as l join laureates_researches_and_achievements as lr on l.id = lr.laureate_id join researches_achievements as r on lr.research_and_achievement_id = r.id WHERE lr.winning_nobel=1 and l.id in (SELECT l.id FROM laureates as l join prizes_laureates as pl on l.id = pl.laureate_id join prizes_category as p on pl.prize_id = p.id WHERE p.id = 7)';
    $result = executeQuery($query);
    return $result;
}
