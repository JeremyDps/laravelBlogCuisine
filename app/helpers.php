<?php

function create_explode($string) {
    $str = "";
    $mots = explode(" ", $string);

    for($i = 0; $i < 20; $i++) {
        $str .= $mots[$i] . " ";
    }

    return $str;
}

function getImage($path) {
    $str = "";
    $mots = explode("/", $path);

    for($i = 1; $i < sizeof($mots); $i++) {
        $str .= $mots[$i] . " ";
    }

    return $str;
}

?>