<?php

require_once 'simple_html_dom.php';

$link = 'https://www.avito.ru/rossiya';
$page = file_get_contents($link);

$html = str_get_html($page);

$offers = [];

$names = $html->find('span[itemprop="name"]');
$prices = $html->find('span[data-marker="item-price"]');
$geo = $html->find('.geo-root-1pUZ8');

for($i = 0; $i < count($names); $i++){
    $offers[$i] = [];
    $offers[$i][0] = trim(strip_tags($names[$i]->innertext));
    $offers[$i][1] = trim(strip_tags($prices[$i]->innertext));
    $offers[$i][2] = trim(strip_tags($geo[$i]->innertext));
}

$file = fopen("offers.json", 'w');
fwrite($file, json_encode($offers, JSON_UNESCAPED_UNICODE));
