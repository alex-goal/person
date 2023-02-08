<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Components\Gender;
use AlexGoal\Person\Person;

trait HasGender
{
    /** @var Gender|null */
    protected $gender;

    /**
     * Получить пол.
     *
     * @return Gender|null
     */
    public function getGender(): ?Gender
    {
        return $this->gender;
    }


    /**
     * Получить название пола.
     *
     * @param string|null $maleName Название женского пола
     * @param string|null $femaleName Название мужского пола
     * @return string|null
     */
    public function getGenderName(string $maleName = null, string $femaleName = null): ?string
    {
        return $this->hasGender()
            ? $this->gender->getName($maleName, $femaleName)
            : null;
    }

    /**
     * Установить пол.
     *
     * @param Gender|string $gender
     * @return Person
     */
    public function setGender($gender): Person
    {
        $this->gender = $gender instanceof Gender
            ? $gender
            : Gender::create($gender);

        return $this;
    }

    /**
     * Установлен ли пол?
     *
     * @return bool
     */
    public function hasGender(): bool
    {
        return $this->gender && ! empty($this->gender->hasName());
    }

    /**
     * Установить мужской пол.
     *
     * @return self
     */
    public function setMale(): self
    {
        $this->gender = Gender::create('male');

        return $this;
    }

    /**
     * Установить женский пол.
     *
     * @return self
     */
    public function setFemale(): self
    {
        $this->gender = Gender::create('female');

        return $this;
    }

    /**
     * Является ли установленный пол мужским?
     *
     * @return bool
     */
    public function isMale(): bool
    {
        return $this->gender && $this->gender->isMale();
    }

    /**
     * Является ли установленный пол женским?
     *
     * @return bool
     */
    public function isFemale(): bool
    {
        return $this->gender && $this->gender->isFemale();
    }
}