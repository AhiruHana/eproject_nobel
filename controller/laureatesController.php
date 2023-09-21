<?php
require 'repository/laureatesRepository.php';
echo php_ini_loaded_file();
$idCategory = 0;
if (isset($_GET['idCategory'])) {
    $idCategory = $_GET['idCategory'];
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $keyword = "";
    if (isset($_GET["keyword"])) {
        $keyword = $_GET["keyword"];
    }
}

$cate = getPrizeCategoryById($idCategory);

function renderLaureatesByCategory()
{
    global $idCategory;

    //tính tổng số bản ghi, số trang, số size khi phân trang
    $total = getTotal($idCategory);
    $index = $_GET["index"] ?? 1;
    $size = 3;
    $skip = ($index - 1) * $size;
    $result = getLaureatesByCategoryId($idCategory, $skip, $size);
    $count = ceil($total / $size);
    //kiểm tra url có chưa tham số hay không
    $current_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $current_url .= "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    //xóa index khi load 
    $current_url = preg_replace('/&index=[0-9]+/', '', $current_url);

    //kiểm tra url có chứa tham số hay và nối tham số index
    $parsed_url = parse_url($current_url);
    if (isset($parsed_url['query'])) {
        $current_url .= "&index=";
    } else {
        $current_url .= "?index=";
    }

    $pagination = '';
    if ($count > 1) {
        $pagination = $pagination . '<ul id="pagination">';
        if ($index > 1) {
            $pagination = $pagination . '<li class="page-item"><b><a class="page-link" href="' . $current_url . ($index - 1) . '">Previous</a></b></li>';
        }
        for ($i = 1; $i <= $count; $i++) {
            $active_class = ($i == $index) ? 'active' : '';
            $pagination = $pagination . '<li class="page-item"><b><a class="page-link ' . $active_class . '" href="' . $current_url . $i . '">' . $i . '</a></b></li>';
        }
        if ($index < $count) {
            $pagination = $pagination . '<li class="page-item"><b><a class="page-link" href="' . $current_url . ($index + 1) . '">Next</a></b></li>';
        }
        $pagination = $pagination . '</ul>';
    }

    $html = '';
    foreach ($result as $r) {
        $html = $html . '
            <div class="col-sm-6 mb-3 mb-sm-0 mt-5 lg-12 mb-5">
                <div class="card">
                    <div class="card-body bl-common">
                        <div class="row">
                            <div class=" card-img col-md-4 lg-4">
                                <div class="bl-img " >
                                    <a href="' . $r['slug'] . $r['id'] . '">
                                        <img src="' . $r['avatar'] . '" style="width:200px;height:300px">
                                    </a>
                                </div>
                            </div>
                            <div class="card-body col-md-8 lg-8">
                                <div class="text-content">
                                    <div class="name">
                                        <div>
                                            <h5><b><a href="' . $r['slug'] . $r['id'] . '">' . $r['name'] . '</a></b></h5> 
                                        </div>
                                        
                                    </div>
                                    <div class="year">
                                
                                        <div>
                                            <b>' . $r['categoryname'] . ' in ' . $r['award_year'] . '</b>
                                        </div>
                                    </div>
                                    <div class="ly-do">
                                        <div>
                                            ' . $r['reason_winning'] . '
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>   
        ';
    }
    echo $html;
    echo $pagination;
}
