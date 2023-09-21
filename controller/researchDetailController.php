<?php
include_once 'repository/researchDetailRepository.php';

$researchId = $_GET['researchId'];
$researchDetail = getResearchDetail($researchId);

function renderResearchDetail()
{
    global $researchDetail;

    $html = "";
    $html = $html . '
            <h2>' . $researchDetail['name'] . '</h2>
            <span class="view"><i class="fa-solid fa-eye"> </i> ' . $researchDetail['view'] . ' views</span>
            <div class= "row my-5">
                <div class="col-md-5 ">
                    <img class="full-w-h" src="' . $researchDetail['img'] . '">
                </div>
                <div class="col-md-7">
                    <h6>Laureate: </h6> ' . $researchDetail['laureate'] . '<br>';

    if ($researchDetail['partner'] != "") {
        $html = $html . '
                <br>
                <h6>Partner: </h6> ' . $researchDetail['partner'] . '<br>';
    }

    $html = $html . '
                    <br><h6>Declaration Date: </h6> ' . $researchDetail['declaration_date'] . '<br>
                    <br><h6>Award Year: </h6> ' . $researchDetail['award_year'] . '<br>
                    <br><h6>Recap: </h6> ' . $researchDetail['recap'] . '<br>
                    <br><h6>Contribute: </h6> ' . $researchDetail['contribute'] . '<br>
                    <br><h6>References: </h6> ' . $researchDetail['references'] . '<br>
                </div>
            </div>
        ';

    echo $html;
}

function renderSimilarResearch()
{
    global $researchId;
    $similar = getSimilarResearch($researchId);

    $html = "";
    foreach ($similar as $s) {
        echo '
            <div class="text-center">
                <div class="similar-img">
                    <img class="full-w-h" src="' . $s['img'] . '">
                    <br>
                    <div class="">
                        <h6><a href="' . $s['slug'] . '' . $s['id'] . '">' . $s['name'] . '</a>
                        </h6>
                    </div>
                </div>
            </div>
        ';
    }

    echo $html;
}
