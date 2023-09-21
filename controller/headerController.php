<?php
include_once('repository/headerRepository.php');


function renderMenu()
{
    $menuParent = getMenuParent();
    $html = '';
    foreach ($menuParent as $parent) {
        $menuChild = getMenuChild($parent['id']);
        $page = explode('.php', $parent['slug'])[0];
        $isActive = (strpos($_SERVER['REQUEST_URI'], $page) == true || strpos($_SERVER['REQUEST_URI'], 'laureate') !== false && strpos($page, 'laureate') !== false || strpos($_SERVER['REQUEST_URI'], 'research') !== false && strpos($page, 'research') !== false) ? 'active' : '';

        if (count($menuChild) > 0) {
            $html = $html . '
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle ' . $isActive . '" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ' . $parent['name'] . '
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        ' . renderMenuChild($menuChild) . '
                    </ul>
                </li>
            ';
        } else {
            $html = $html . '
                <li class="nav-item">
                    <a class="nav-link ' . $isActive . '" aria-current="page" href="' . $parent['slug'] . '">' . $parent['name'] . '</a>
                </li>
            ';
        }
    }
    echo $html;
}

function renderMenuChild($menuChild)
{
    global $parent;
    $html = '';
    foreach ($menuChild as $child) {
        $html = $html . '<li><a class="dropdown-item" href="' .  $child['slug'] . '">' . $child['name'] . '</a></li>';
    }
    return $html;
}

function renderTicker()
{
    $html = '';
    $html = $html . '
        <div id="ticker">
            <table>
                <tr>
                    <td><i class="fa-solid fa-calendar-days"></i></td>
                    <td><span id="date"></span></td>
                </tr>
                <tr>
                    <td><i class="fa-solid fa-clock"></i></td>
                    <td><span id="time"></span></td>
                </tr>
                <tr>
                    <td><i class="fa-solid fa-earth-americas"></i></td>
                    <td><span id="location"></span></td>
                </tr>
            </table>
        </div>
    ';
    echo $html;
}

$logo = getConfig("logo");
$banner = getConfig("banner");
$picture = getConfig("picture");
$title1_banner = getConfig("title1_banner");
$title2_banner = getConfig("title2_banner");
$foundation = getConfig("The Nobel Foundation");
$prize_awarding = getConfig("The prize-awarding institutions");
$outreach = getConfig("Nobel Prize outreach activities");
$facebook = getConfig("facebook");
$email = getConfig("email");
$address = getConfig("address");
$instagram = getConfig("instagram");
$hotline = getConfig("hotline");
$twitter = getConfig("twitter");
