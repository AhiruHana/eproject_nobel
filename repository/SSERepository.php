<?php
include_once 'createConnection.php';

function getNewFeedback()
{
    $query = "SELECT COUNT(*) AS numOfNewFeedback FROM feedback WHERE status = 0";
    $result = executeQuery($query);
    
    if ($result && count($result) > 0) {
        $row = $result[0];
        //chuyển giá trị tring trong row thành int
        $numOfNewFeedback = intval($row['numOfNewFeedback']);
        return $numOfNewFeedback;
    }
}

function getNewFeedbackSince($lastFeedbackId) {

    $query = "SELECT * FROM feedback WHERE id > $lastFeedbackId";

    $result= executeQuery($query);
    return $result;
}