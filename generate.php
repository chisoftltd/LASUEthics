<?php
/**
 * Created by PhpStorm.
 * User: 1609963
 * Date: 04/05/2017
 * Time: 21:09
 */

generate();
function generate(){
    $alphaNumeric = array();

    $v = 'A';
    for($i = 0; $i<=25;$i++){
        $alphaNumeric[$i] = $v;
        $v++;
    }
    $v = 'a';
    for($i = 26; $i<=51;$i++){
        $alphaNumeric[$i] = $v;
        $v++;
    }
    $v = '0';
    for($i = 52; $i<=61;$i++){
        $alphaNumeric[$i] = $v;
        $v++;
    }
    // print_r($alphaNumeric);
    return $alphaNumeric;
}