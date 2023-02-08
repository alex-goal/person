<?php

namespace AlexGoal\Person\Tests;

use AlexGoal\Person\Components\Birthday;
use AlexGoal\Person\Components\Gender;
use AlexGoal\Person\Person;
use Carbon\Carbon;
use DateTime;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    /**
     * @test
     */
    public function runTest()
    {
        $fullName = ' Иванова-сидорова   санта-Люсия  
            Петровна  Иван';

        $person = Person::create($fullName);
        $this->testPerson($person);

        $person = new Person($fullName);
        $this->testPerson($person);

        $person->setGender('жен.');
        $this->testGender($person);

        $person->setGender(new Gender('Ж'));
        $this->testGender($person);

        $person->setGender(Gender::create()->setFemaleGender());
        $this->testGender($person);

        $person->setBirthday('21/10/84', 'd/m/y');
        $this->testBirthday($person);

        $person->setBirthday(new Birthday('21.10.84'));
        $this->testBirthday($person);
    }

    /**
     * @param Person $person
     * @return void
     */
    public function testPerson(Person $person)
    {
        $this->assertEquals('Иванова-сидорова', $person->getLastname());
        $this->assertEquals('санта-Люсия', $person->getFirstname());
        $this->assertEquals('Петровна', $person->getMiddlename());

        $this->assertTrue($person->hasAnyName());
        $this->assertFalse(!$person->hasFullName());

        $this->assertEquals('Иванова-Сидорова С.П.', $person->getShortName());
        $this->assertEquals('Иванова-сидорова санта-Люсия Петровна', $person->getFullName());
        $this->assertEquals('Санта-Люсия петровна И.', $person->getFullName('%Ff %mm %L1.'));
        $this->assertEquals('Иванова-Сидорова Санта-Люсия Петровна', $person->getFullNameUcFirst());
        $this->assertEquals('ИВАНОВА-СИДОРОВА САНТА-ЛЮСИЯ ПЕТРОВНА', $person->getFullNameUpper());
        $this->assertEquals('иванова-сидорова санта-люсия петровна', $person->getFullNameLower());

        $this->assertFalse($person->hasGender());
        $this->assertNull($person->getGender());
        $this->assertNull($person->getBirthday());
    }

    /**
     * @param Person $person
     * @return void
     */
    public function testGender(Person $person)
    {
        $this->assertTrue($person->hasGender());
        $this->assertFalse($person->isMaleGender());
        $this->assertTrue($person->isFemaleGender());

        $this->assertEquals('female', $person->getGenderName());
        $this->assertEquals('Ж', $person->getGenderName('М', 'Ж'));
    }

    /**
     * @param Person $person
     * @return void
     */
    public function testBirthday(Person $person)
    {
        $this->assertTrue($person->hasBirthday());
        $this->assertEquals('1984-10-21', $person->getBirthdayByFormat());
        $this->assertEquals('21.10.1984', $person->getBirthdayByFormat('21.10.1984'));
        $this->assertEquals('19841021', $person->getBirthday()->getDate()->format('Ymd'));

        $this->assertEquals(38, $person->getAge('2023-02-08'));
        $this->assertEquals(38, $person->getAge(new DateTime('2023-02-08')));
        $this->assertEquals(38, $person->getAge(Carbon::parse('2023-02-08')));

        $this->assertTrue($person->isAdult());
        $this->assertFalse($person->isAdult('01.01.2000'));
    }
}
