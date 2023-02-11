<?php

namespace AlexGoal\Person\Tests\Traits;

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
        ]);

        $this->assertCount(2, $person->getDocs()->get());
        $this->assertCount(2, $person->getDocsByType(Passport::class));
        $this->assertEquals(2, $person->getCountDocs());
    }
}
