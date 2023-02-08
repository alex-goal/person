<?php

namespace AlexGoal\Person\Components;

class Gender
{
    const
        GENDER_MALE_NAME = 'male',
        GENDER_FEMALE_NAME = 'female';

    /** @var string */
    protected $name;

    /**
     * Gender Constructor.
     *
     * @param string|null $genderName
     */
    public function __construct(string $genderName = null)
    {
        if (! empty($genderName)) {
            $this->setName($genderName);
        }
    }

    /**
     * Create Gender.
     *
     * @param string|null $genderName
     * @return Gender
     */
    public static function create(string $genderName = null): Gender
    {
        return new Gender($genderName);
    }

    /**
     * Название пола.
     *
     * @param string|null $maleName Название мужского пола
     * @param string|null $femaleName Название женского пола
     * @return string|null
     */
    public function getName(string $maleName = null, string $femaleName = null): ?string
    {
        if (! $this->hasName()) {
            return null;
        }

        return $this->isMale()
            ? ($maleName ?? self::GENDER_MALE_NAME)
            : ($femaleName ?? self::GENDER_FEMALE_NAME);
    }

    /**
     * Установить пол по его названию.
     *
     * Метод по полученному названию определяет и устанавливает пол.
     * В качестве альтернативы лучше использовать методы
     * setMaleGender() и setFemaleGender().
     *
     * @param string $genderName Название пола
     * @return $this
     */
    public function setName(string $genderName): Gender
    {
        if (empty($genderName)) {
            return $this;
        }

        if (mb_stripos($genderName, 'муж') !== false) {
            $this->setMale();
        } elseif (mb_stripos($genderName, 'жен') !== false) {
            $this->setFemale();
        } else {
            $genderName = mb_strtolower($genderName);

            switch ($genderName) {
                case 'м':
                case 'm':
                case 'man':
                case 'male':
                    $this->setMale();
                    break;
                case 'ж':
                case 'f':
                case 'woman':
                case 'female':
                    $this->setFemale();
                    break;
            }
        }

        return $this;
    }

    /**
     * Установлен ли пол?
     *
     * @return bool
     */
    public function hasName(): bool
    {
        return ! empty($this->name);
    }

    /**
     * Установить мужской пол.
     *
     * @return $this
     */
    public function setMale(): Gender
    {
        $this->name = self::GENDER_MALE_NAME;

        return $this;
    }

    /**
     * Установить женский пол.
     *
     * @return $this
     */
    public function setFemale(): Gender
    {
        $this->name = self::GENDER_FEMALE_NAME;

        return $this;
    }

    /**
     * Является ли установленный пол мужским?
     *
     * @return bool
     */
    public function isMale(): bool
    {
        return $this->name == self::GENDER_MALE_NAME;
    }

    /**
     * Является ли установленный пол женским?
     *
     * @return bool
     */
    public function isFemale(): bool
    {
        return $this->name == self::GENDER_FEMALE_NAME;
    }
}