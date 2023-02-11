<?php

namespace AlexGoal\Person\Tests;

use AlexGoal\Person\Collections\DocCollection;
use AlexGoal\Person\Components\Passport;
use AlexGoal\Person\Person;
use Exception;
use PHPUnit\Framework\TestCase;

class DocCollectionTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function runTest()
    {
        // -------------------------------------------------
        $docs = new DocCollection();

        $this->assertTrue($docs->isEmpty());
        $this->assertTrue($docs->canPush(new Passport()));
        $this->assertTrue($docs->canPush(Passport::class));
        $this->assertFalse($docs->canPush(Person::class));
        $this->assertEquals([], $docs->get());

        // -------------------------------------------------
        $docs = DocCollection::create()->push(
            Passport::create('2030405060')
        );

        $this->assertFalse($docs->isEmpty());
        $this->assertFalse($docs->has(Person::class));
        $this->assertTrue($docs->has(Passport::class));
        $this->assertEquals(1, $docs->count());
        $this->assertEquals(1, $docs->count(Passport::class));
        $this->assertEquals(0, $docs->count(Person::class));

        $docs->push(new Passport());

        $this->assertEquals(2, $docs->count());
        $this->assertEquals(2, $docs->count(Passport::class));
        $this->assertCount(2, $docs->getPassports());
    }
}
