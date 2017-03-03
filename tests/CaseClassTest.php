<?php
declare(strict_types=1);

require './vendor/autoload.php';

use PHPUnit\Framework\TestCase;

use FPHP\CaseClass;
use FPHP\NoSuchPropertyException;

class Point extends CaseClass {
    protected $data;

    function __construct(int $x, int $y) {
        $this->data = [
            'x' => $x,
            'y' => $y,
        ];
    }
}

class CaseClassTest extends TestCase {
    public function testCaseClass() {
        $x = 3;
        $y = 4;

        $point = new Point($x, $y);

        list($x_1, $y_1) = $point;

        $this->assertEquals($x, $x_1);
        $this->assertEquals($y, $y_1);

        $this->assertEquals($x, $point->x());
        $this->assertEquals($y, $point->y());
    }

    public function testCaseClass_noSuchProperty() {
        $point = new Point(1, 2);

        $this->expectException(NoSuchPropertyException::class);

        $point->foo();
    }
}
