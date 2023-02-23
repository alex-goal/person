<?php

namespace AlexGoal\Person\Tests\Traits;

use AlexGoal\Person\Components\Inn;
use AlexGoal\Person\Components\Passport;
use AlexGoal\Person\Person;
use Exception;
use PHPUnit\Framework\TestCase;

class HasDocsTest extends TestCase
{
    /** @test
     * @throws Exception
     */
    public function runTest()
    {
        // -------------------------------------------------
        $person = Person::create();

        $this->assertFalse($person->hasDocs());
        $this->assertTrue($person->getDocs()->isEmpty());

        // -------------------------------------------------
        $person->addDocs([
            Passport::create('1234567890'),
            Passport::create('9876543210'),
            Inn::create('314253648608')
        ]);

        $this->assertCount(3, $person->getDocs()->get());
        $this->assertCount(2, $person->getDocsByType(Passport::class));
        $this->assertCount(1, $person->getDocsByType(Inn::class));
        $this->assertEquals(3, $person->getCountDocs());
        $this->assertEquals('314253648608', $person->getInn()->getNumber());

        $person->getInn()
            ->setNumber('807957352413')
            ->setDate('2000-10-20');

        $this->assertEquals('807957352413', $person->getInn()->getNumber());
        $this->assertEquals('20.10.00', $person->getInn()->getDateByFormat('d.m.y'));
        $this->assertTrue($person->getInn()->isInn());
    }
}
