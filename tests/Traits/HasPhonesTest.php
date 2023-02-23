<?php

namespace AlexGoal\Person\Tests\Traits;

use AlexGoal\Person\Components\Phone;
use AlexGoal\Person\Person;
use Exception;
use PHPUnit\Framework\TestCase;

class HasPhonesTest extends TestCase
{
    /**
     * @return void
     * @test
     * @throws Exception
     */
    public function runTest()
    {
        // -------------------------------------------------
        $phone = Phone::create('89204567890', '+7 (XXX) XXX-XX-XX');

        $this->assertEquals('+7 (920) 456-78-90', $phone->getNumber());
        $this->assertEquals('9204567890', $phone->getNumber('XXXXXXXXXX'));
        $this->assertEquals('+79204567890', $phone->getNumber('+7XXXXXXXXXX'));

        // -------------------------------------------------
        $person = Person::create()->addPhones([
            new Phone('9204567890'),
            new Phone('9101234567'),
            Phone::create('999 444 5555'),
        ]);

        $this->assertCount(3, $person->getPhones());
        $this->assertEquals(
            '+7 920 456 78 90',
            $person->getFirstPhone()->getNumber('+7 XXX XXX XX XX')
        );
    }
}
