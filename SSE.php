<?php
include_once 'repository/SSERepository.php';

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Connection: keep-alive');
//gửi tất cả dữ liệu 
ob_end_flush();

$lastFeedbackId = 0;

while (true) {
    $newFeedback = getNewFeedbackSince($lastFeedbackId);
    if (!empty($newFeedback)) {
        $numOfNewFeedback = getNewFeedback();
        $lastFeedbackId = end($newFeedback)['id'];
        $newFeedback = json_encode(end($newFeedback));
        
        echo "event: feedbackUpdate\n";
        echo "data: {\"numOfNewFeedback\": $numOfNewFeedback, \"newFeedback\":$newFeedback}\n\n";
    }

    //kết nối giữa máy chủ và trình duyệt đã bị ngắt hay chưa.
    if (connection_aborted()) break;

    flush();

    sleep(1);
}
