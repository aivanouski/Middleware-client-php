<?php

function bytes32($string) {
    $zeros = '000000000000000000000000000000000000000000000000000000000000000';
    $hex = '';
    for ($i=0; $i<strlen($string); $i++){
        $ord = ord($string[$i]);
        $hexCode = dechex($ord);
        $hex .= substr('0'.$hexCode, -2);
    }
    $hex = substr(strtolower($hex). $zeros, 0, 66);
    return strtolower($hex);

}