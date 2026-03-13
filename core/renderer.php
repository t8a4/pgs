<?php

function renderSection($section){

$type = $section['type'];

$data = json_decode($section['data'], true) ?? [];

$path = __DIR__."/../sections/$type/$type.php";

if(file_exists($path)){

include $path;

}

}