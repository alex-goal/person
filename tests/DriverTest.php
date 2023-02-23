<?php

namespace AlexGoal\Person\Tests;

use AlexGoal\Person\Components\Driver;
use PHPUnit\Framework\TestCase;

class DriverTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function runTest(): void
    {
        // -------------------------------------------------
        $driver = (new Driver)
            ->setFullNumber('1234567890')
            ->setPeriod('2016-06-05', '2026-06-05');

        $this->assertEquals('1234 567890', $driver->getFullNumberByFormat());
        $this->assertEquals('12 34 567 890', $driver->getFullNumberByFormat('XX XX XXX XXX'));
        $this->assertEquals('1234', $driver->getSeries());
        $this->assertEquals('567890', $driver->getNumber());
        $this->assertEquals('05.06.16', $driver->getStartDateByFormat('d.m.y'));
        $this->assertEquals('05.06.26', $driver->getEndDateByFormat('d.m.y'));
        $this->assertTrue($driver->isValidPeriod('2022-02-03'));
        $this->assertFalse($driver->isValidPeriod('2032-02-03'));
        $this->assertTrue($driver->hasFullNumber());
        $this->assertTrue($driver->hasStartDate());
        $this->assertTrue($driver->hasEndDate());
        $this->assertTrue($driver->isDriver());

        // -------------------------------------------------
        $driver = new Driver;

        $this->assertFalse($driver->hasFullNumber());
        $this->assertFalse($driver->hasSeries());
        $this->assertFalse($driver->hasNumber());
        $this->assertFalse($driver->hasStartDate());
        $this->assertFalse($driver->hasEndDate());
        $this->assertNull($driver->getFullNumber());
        $this->assertNull($driver->getStartDate());
        $this->assertNull($driver->getEndDate());
    }
}
