<?php

namespace AlexGoal\Person\Tests;

use AlexGoal\Person\Components\Passport;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class PassportTest extends TestCase
{
    /**
     * @test
     */
    public function runTest()
    {
        // -------------------------------------------------
        $passport = new Passport();

        $this->assertFalse($passport->hasFullNumber());
        $this->assertFalse($passport->isValidFullNumber());
        $this->assertFalse($passport->hasNumber());
        $this->assertFalse($passport->hasSeries());
        $this->assertNull($passport->getDateByFormat('d.m.y'));

        // -------------------------------------------------
        $passport = Passport::create('20 30 123456');

        $this->assertEquals('2030123456', $passport->getFullNumber());
        $this->assertEquals('2030', $passport->getSeries());
        $this->assertEquals('123456', $passport->getNumber());
        $this->assertTrue($passport->isValidFullNumber());
        $this->assertFalse($passport->hasDepartment());
        $this->assertFalse($passport->hasDepCode());

        // -------------------------------------------------
        $passport = Passport::create()
            ->setSeries(' 20 30 ')
            ->setNumber(' 40 50 60 +')
            ->setDepCode('1234567');

        $this->assertEquals('2030', $passport->getSeries());
        $this->assertEquals('405060', $passport->getNumber());
        $this->assertEquals('123-456', $passport->getDepCode());
        $this->assertEquals('20 30 405060', $passport->getFullNumberByFormat());
        $this->assertEquals('2030 405 060', $passport->getFullNumberByFormat('xxxx xxx xxx'));
        $this->assertTrue($passport->hasNumber());
        $this->assertTrue($passport->hasSeries());
        $this->assertTrue($passport->hasFullNumber());
        $this->assertTrue($passport->hasDepCode());

        // -------------------------------------------------
        $passport = Passport::create()->setDate('05.10.2005');

        $this->assertTrue($passport->hasDate());
        $this->assertEquals('2005/10/05', $passport->getDateByFormat('Y/m/d'));
        $this->assertEquals(Carbon::create(2005, 10, 5), $passport->getDate());

        // -------------------------------------------------
        $passport = (new Passport)->setDate('10/11/12', 'm/d/y');

        $this->assertEquals(Carbon::parse('2012-10-11'), $passport->getDate());
        $this->assertEquals('12-10-11', $passport->getDateByFormat('y-m-d'));

    }
}
