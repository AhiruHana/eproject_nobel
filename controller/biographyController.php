<?php
include_once 'repository/biographyRepository.php';

$laureateId = $_GET['laureateId'];
$laureate = getBiography($laureateId);

function renderInfobox()
{
    global $laureate;
    $html = "";
    $html = $html . '
        <tr>
            <th>Born</th>
            <td><span>' . $laureate['born'] . '</span></td>
        </tr>';

    if ($laureate['died'] != "") {
        $html = $html . '
        <tr>
            <th>Died</th>
            <td><span>' . $laureate['died'] . '</span></td>
        </tr>';
    }

    $html = $html . '
        <tr>
            <th>Nationality</th>
            <td><span>' . $laureate['nationality'] . '</span></td>
        </tr>
        <tr>
            <th>Fields</th>
            <td><span>' . $laureate['fields'] . '</span></td>
        </tr>
    ';
    echo $html;
}

function renderBiography($printHtml = true)
{
    global $laureateId;
    $html = "";
    $sitemap = "";
    renderBiographyItem('summary', 'Summary', $html, $sitemap);
    renderBiographyItem('education', 'Education', $html, $sitemap);
    renderBiographyItem('career', 'Career', $html, $sitemap);
    renderCareerGraph($html);
    renderResearch('research', 'Researches and Experiments', $laureateId, $html, $sitemap);
    renderBiographyItem('selected_works', 'Selected works', $html, $sitemap);
    renderBiographyItem('awards_and_honors', 'Awards and Honors', $html, $sitemap);
    renderBiographyItem('related_books', 'Related Books', $html, $sitemap);
    renderBiographyItem('references', 'References', $html, $sitemap);
    renderImgList($html, $sitemap);
    if ($printHtml) {
        echo $html;
    }
    return $sitemap;
}

function renderBiographyItem($bioItem, $bioItemName, &$html, &$sitemap)
{
    global $laureate;
    $content = ($laureate[$bioItem]);

    $html = $html . '<div id="' . $bioItem . '">
        <h5 class="bio-title" id="' . $bioItem . '"><span>' . $bioItemName . '</span></h5>
        <hr>
        <p class="text-justify">' . $content . '</p></div>
    ';

    $sitemap = $sitemap . '<li><a onclick="scrollToSection(event)" href="#' . $bioItem . '">' . $bioItemName . '</a></li>';
}

function renderResearch($bioItem, $bioItemName, $laureateId, &$html, &$sitemap)
{
    $research = getResearchById($laureateId);

    if (!empty($research)) {
        $html = $html . '
        <div id="' . $bioItem . '">
        <h5 class="bio-title" ><span>' . $bioItemName . '</span></h5>
        <hr>
        ';

        $sitemap = $sitemap . '<li><a onclick="scrollToSection(event)" href="#' . $bioItem . '">' . $bioItemName . '</a><ul>';
        foreach ($research as $r) {
            $html = $html . '
                <h6 id="' . $bioItem . $r['id'] . '">
                    ' . $r['name'] . ' (' . $r['declaration_date'] . ')
                </h6>
                <ul>
                ';

            $sitemap = $sitemap . '<li><a onclick="scrollToSection(event)" href="#' . $bioItem . $r['id'] . '" >' . $r['name'] . '</a></li>';

            if ($r['partner'] != "") {
                $html = $html . '
                    <li class="text-justify">
                        <i><u>Partner:</u></i> ' . $r['partner'] . '
                    </li>';

            }
            $html = $html . '
                    <li class="text-justify">
                        <i><u>Recap:</u></i> ' . $r["recap"] . '
                    </li>
                    <li class="text-justify">
                    <i><u>Contribute:</u></i> ' . $r["contribute"] . '
                    </li>
                    <li class="text-justify">
                    <i><u>Reference:</u></i> ' . $r["references"] . '
                    </li>
                </ul>
            ';
        }
        $html.='</div>';
        $sitemap = $sitemap . '</ul></li>';
    }
}

function renderCareerGraph(&$html)
{
    global $laureate;
    $career = $laureate['career'];
    $dom = new DOMDocument();
    $dom->loadHTML($career);

    $liElements = $dom->getElementsByTagName('li');
    $resultArray = array();

    foreach ($liElements as $li) {
        //loại bỏ dấu : trong li
        $value = $li->nodeValue;
        $value = str_replace(':', '', $value);

        // Tạo mảng con
        
        $arrayItem = array(
            'year' => trim(explode(' ', $value)[0]),
            'career' => trim(substr($value, strpos($value, ' ') + 1))
        );

        // Thêm mảng con vào mảng chính
        $resultArray[] = $arrayItem;
        $count = count($resultArray);
    }
    $html = $html . '
        <!--career graph-->
            <div id="careergraph">
                <div class="timeline mt-5">
    ';
    foreach ($resultArray as $r) {
        $html = $html . '
            <div class="timeline-item" style="margin: 0 calc(50% / ' . $count . ' - 5px);" data-year="' . $r['year'] . '"></div>
        ';
    }
    $html = $html . '
            <div class="timeline-line"></div>
        </div>
        <div class="carrer">
    ';
    foreach ($resultArray as $r) {
        $html = $html . '
            <div class="carrer-child" style="width: calc(100% /' . $count . ');">' . $r['career'] . '</div>
        ';
    }
    $html = $html . '
            </div>
        </div>
    ';
}
function renderImgList(&$html, &$sitemap)
{
    global $laureate;

    if ($laureate['img_list'] != "" && $laureate['img_list'] != null) {
        $imgList = explode(',', $laureate['img_list']);

        $html = $html . '
            <div id="picture">
                <h5 class="bio-title" ><span>A lot of pictures of ' . $laureate['name'] . '</span></h5>
                <hr>
                <div class="img-list my-5 mx-5">
        ';
        foreach ($imgList as $i) {
            $html = $html . '
                <div class="slide-img">
                    <img class="full-w-h" src="' . $i . '">
                </div>
            ';
        }
        $html = $html . '
                </div>
            </div>
        ';
    }

    $sitemap = $sitemap . '<li><a href="#picture">A lot of pictures of ' . $laureate['name'] . '</a></li>';
}

function renderSitemap()
{
    $sitemap = renderBiography(false);
    echo $sitemap;
}
