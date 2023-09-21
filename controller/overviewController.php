<?php
include_once 'repository/headerRepository.php';

function renderOverview($printHtml = true)
{
    $overview = array(
        "aboutNobelPrizes" => getConfig("About Nobel Prizes"),
        "AlfredNobel" => getConfig("The Man Behind The Prize – Alfred Nobel"),
        "NobelFoundation" => getConfig("Nobel Foundation"),
        "Whydoweuseit" => getConfig("Why do we use it?"),
        "Wheredoesitcomefrom" => getConfig("Where does it come from?"),
        "WherecanIgetsome" => getConfig("Where can I get some?"),
        "WhatisLoremIpsum" => getConfig("What is Lorem Ipsum?")
    );

    $html = '';
    $sitemap = '';
    
    foreach ($overview as $key => $value) {
        $html = $html . '
            <h4 id="' . $key . '">' . $value['code'] . '</h4>
            <p class="text-justify">' . $value['value'] . '</p>
        ';
        $sitemap = $sitemap . '<li><a href="#' . $key . '" >' . $value['code'] . '</a></li>';
    }
    if ($printHtml) {
        echo $html;
    }
    return $sitemap;
}

function renderSitemap(){
    $sitemap = renderOverview(false);
    echo $sitemap;
}
