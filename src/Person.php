<?php

namespace AlexGoal\Person;

use AlexGoal\Person\Traits\HasBirthday;
use AlexGoal\Person\Traits\HasDocs;
use AlexGoal\Person\Traits\HasGender;
use AlexGoal\Person\Traits\HasNames;
use AlexGoal\Person\Traits\HasPhones;

class Person
{
    use HasNames,
        HasGender,
        HasBirthday,
        HasDocs,
        HasPhones;

    /**
     * Person Constructor.
     *
     * @param string $fullName
     */
    public function __construct(string $fullName = '')
    {
        $this->setFullName($fullName);
    }

    /**
     * Create Person.
     *
     * @param string $fullName
     * @return Person
     */
    public static function create(string $fullName = ''): Person
    {
        return new Person($fullName);
    }
}