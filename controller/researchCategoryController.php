<?php
include_once 'repository/researchCategoryRepository.php';

$idCategory = 0;

if (isset($_GET['idCategory'])) {
    $idCategory = $_GET['idCategory'];
}

$category = getCategory($idCategory);

function renderResearchByCategory()
{
    global $idCategory;
    //tính tổng số bản ghi, số trang, số size khi phân trang
    $total = getTotal($idCategory);
    $index = $_GET["index"] ?? 1;
    $size = 3;
    $skip = ($index - 1) * $size;
    $result = getResearchByCategory($idCategory, $skip, $size);
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
        <div class="col-md-4  mt-5">
            <div class="similar-img">
                <a href="' . $r['slug'] . $r['id'] . '">
                    <img class="full-w-h" src="' . $r['img'] . '">
                </a>
            </div>
            <div class="name-sci text-center">
                <h5 class="bold"><a href="' . $r['slug'] . $r['id'] . '">' . $r['name'] . '</a></h5>
                <h6>' . $r['prizeName'] . ' ' . $r['award_year'] . '</h6>
            </div>
        </div>
    ';
    }
    echo $html;
    echo $pagination;
}
