<?php

namespace AlexGoal\Person\Tests;

use AlexGoal\Person\Components\Period;
use Carbon\Carbon;
use DateTime;
use PHPUnit\Framework\TestCase;

class PeriodTest extends TestCase
{
    /** @test  */
    public function runTest()
    {
        // -------------------------------------------------
        $period = Period::create();

        $this->assertFalse($period->hasStart() && $period->hasEnd());
        $this->assertTrue($period->isValid('2000-01-01'));

        // -------------------------------------------------
        $period = new Period('2000-01-01', '31.12.2020');

        $this->assertFalse($period->isValid());
        $this->assertFalse($period->isValid(Carbon::now()));
        $this->assertFalse($period->isValid('1999-12-31'));
        $this->assertFalse($period->isValid('01.01.2021'));
        $this->assertTrue($period->isValid(new DateTime('2010-10-10')));

        // -------------------------------------------------
        $period = Period::create(Carbon::now());

        $this->assertTrue($period->isValid(Carbon::now()));
        $this->assertFalse($period->isValid(Carbon::now()->subSecond()));
        $this->assertFalse($period->isValid('2000-01-01'));

        // -------------------------------------------------
        $period = Period::create(null)->setEnd(Carbon::now());

        $this->assertFalse($period->isValid(Carbon::now()));
        $this->assertTrue($period->isValid(Carbon::now()->subSecond()));
        $this->assertTrue($period->isValid('2000-01-01'));
    }
}
