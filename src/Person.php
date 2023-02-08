<?php

namespace AlexGoal\Person;

use AlexGoal\Person\Traits\HasBirthday;
use AlexGoal\Person\Traits\HasGender;
use AlexGoal\Person\Traits\HasNames;

class Person
{
    use HasNames,
        HasGender,
        HasBirthday;

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