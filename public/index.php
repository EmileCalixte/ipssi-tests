<?php

require('../vendor/autoload.php');
require('../Calculatrice.php');
require('../CalculatriceTest.php');

function d(...$values) {
    foreach($values as $value) {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
    }
}

function dd(...$values) {
    d(...$values);
    die;
}



$calc = new Calculatrice();

d($calc->setA(12)->setB(5)->add());
d($calc->setA(76)->setB(3)->div());

$test = new CalculatriceTest();
$test->testAdd();
?>