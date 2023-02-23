<?php

namespace AlexGoal\Person\Tests;

use AlexGoal\Person\Components\Snils;
use PHPUnit\Framework\TestCase;

class SnilsTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function runTest(): void
    {
        // -------------------------------------------------
        $snils = Snils::create('123 456 789 09');

        $this->assertEquals('123-456-789 09', $snils->getNumberFormat());
        $this->assertEquals('12345678909', $snils->getNumber());
        $this->assertTrue($snils->hasNumber());
    }
}
