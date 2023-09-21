<?php
include_once 'repository/indexRepository.php';

function renderEminent()
{
    $eminent = getEminent();
    $html = "";

    foreach ($eminent as $e) {
        $html = $html . '
            <div class="col-md-4 mt-5">
                <div class="anh-sci">
                    <a href= "' . $e['slug'] . $e['id'] . '">
                        <img src="' . $e['avatar'] . '" alt=" " style="width:300px;height:400px">
                    </a>
                </div>
                <div class="khoi-text mt-4">
                    <p class="name-sci text-center"><a href="' . $e['slug'] . $e['id'] . '"><b>' . $e['name'] . '</b></a></p>
                </div>
            </div>
        ';
    }
    echo $html;
}

function renderResearchEminert()
{
    $resreach = getResearchEminert();
    $html = "";

    foreach ($resreach as $r) {
        $html = $html . '
            <div class="col-md-6 my-4 ">
                <div class="row">    
                    <div class="col-md-6 ">
                        <div class="khoi-image ">
                            <a href="' . $r['slug'] . $r['id'] . '">
                                <img src="' . $r['img'] . '" alt=" " style="width: 100%; height: 200px; max-width:100%">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <p class="name-sci"><a href="' . $r['slug'] . $r['id'] . '"><b>' . $r['name'] . '</b></a></p>
                        <div class="recap text-justify">
                            <p>' . mb_substr($r['recap'], 0, 150, 'UTF-8') . '</p>
                        </div>
                    </div>
                </div>  
            
            </div>
        ';
    }
    echo $html;
}
