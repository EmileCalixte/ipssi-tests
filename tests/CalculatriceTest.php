<?php

namespace Test;


use App\Calculatrice;


class CalculatriceTest extends \PHPUnit\Framework\TestCase
{
    public function testAdd() {
        $a = 10;
        $b = 20;
        $result = 30;
        $calc = new Calculatrice();
        $calc->setA($a)->setB($b);
        $this->assertEquals($result, $calc->add());
    }
}