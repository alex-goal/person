<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Helpers\Str;
use AlexGoal\Person\Person;

trait HasNames
{
    /** @var string */
    protected $lastname;

    /** @var string */
    protected $firstname;

    /** @var string */
    protected $middlename;

    /**
     * Получить фамилию.
     *
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * Установить фамилию.
     *
     * @param string $lastname
     * @return self
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Фамилия установлена?
     *
     * @return bool
     */
    public function hasLastname(): bool
    {
        return ! empty($this->lastname);
    }

    /**
     * Получить имя.
     *
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Установить имя.
     *
     * @param string $firstname
     * @return self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Имя установлено?
     *
     * @return bool
     */
    public function hasFirstname(): bool
    {
        return ! empty($this->firstname);
    }

    /**
     * Получить отчество.
     *
     * @return string|null
     */
    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    /**
     * Установить отчество.
     *
     * @param string $middlename
     * @return void
     */
    public function setMiddlename(string $middlename): Person
    {
        $this->middlename = $middlename;

        return $this;
    }

    /**
     * Отчество установлено?
     *
     * @return bool
     */
    public function hasMiddlename(): bool
    {
        return ! empty($this->middlename);
    }

    /**
     * Получить полное имя в формате "Фамилия Имя Отчество".
     * Есть возможность указать свой формат.
     *
     * @param string|null $format
     * @return string
     */
    public function getFullName(string $format = null): string
    {
        if (empty($format)) {
            return trim("$this->lastname $this->firstname $this->middlename");
        }

        $formats = $this->getFormatValues();

        return trim(str_replace(array_keys($formats), array_values($formats), $format));
    }

    /**
     * Установить фамилию, имя и отчество из формата "Фамилия Имя Отчество"
     *
     * @param string $fullName
     * @return Person
     */
    public function setFullName(string $fullName): Person
    {
        $fullName = explode(' ', Str::onlyFioLetters($fullName));

        if (! empty($fullName[0])) {
            $this->setLastname($fullName[0]);
        }

        if (! empty($fullName[1])) {
            $this->setFirstname($fullName[1]);
        }

        if (! empty($fullName[2])) {
            $this->setMiddlename($fullName[2]);
        }

        return $this;
    }

    /**
     * Установлено хотя бы одно из значений фамилии, имени или отчества?
     *
     * @return bool
     */
    public function hasAnyName(): bool
    {
        return ! empty($this->lastname)
            || ! empty($this->firstname)
            || ! empty($this->middlename);
    }

    /**
     * Установлены вместе фамилия, имя и отчество?
     *
     * @return bool
     */
    public function hasFullName(): bool
    {
        return ! empty($this->lastname)
            && ! empty($this->firstname)
            && ! empty($this->middlename);
    }

    /**
     * Формат имени "Фамилия И.О."
     *
     * @return string|null
     */
    public function getShortName(): ?string
    {
        return $this->getFullName('%Ll %F1.%M1.');
    }

    /**
     * Инициалы.
     *
     * @return string|null
     */
    public function getInitials(): ?string
    {
        $initials = null;

        if ($this->hasFirstname()) {
            $initials = $this->getFirst('firstname', 'u') . '.';

            if ($this->hasMiddlename()) {
                $initials .= $this->getFirst('middlename', 'u') . '.';
            }
        }

        return $initials;
    }

    /**
     * Формат имени "Фамилия Имя Отчество".
     *
     * @return string
     */
    public function getFullNameUcFirst(): string
    {
        return $this->getFullName('%Ll %Ff %Mm');
    }

    /**
     * Формат имени "ФАМИЛИЯ ИМЯ ОТЧЕСТВО".
     *
     * @return string
     */
    public function getFullNameUpper(): string
    {
        return $this->getFullName('%LL %FF %MM');
    }

    /**
     * Формат имени "фамилия имя отчество"
     *
     * @return string
     */
    public function getFullNameLower(): string
    {
        return $this->getFullName('%ll %ff %mm');
    }

    /**
     * Первая буква фамилии, имени или отчества.
     *
     * @param string $property
     * @param string|null $format
     * @return string|null
     */
    private function getFirst(string $property, string $format = null): ?string
    {
        $firstLetter = ! empty($this->{$property}) && is_string($this->{$property})
            ? mb_substr($this->{$property}, 0, 1)
            : null;

        if (empty($firstLetter)) {
            return null;
        }

        switch ($format) {
            case 'u': return mb_strtoupper($firstLetter);
            case 'l': return mb_strtolower($firstLetter);
            default: return null;
        }
    }

    /**
     * Список спецификаторов для форматирования.
     *
     * @return array
     */
    private function getFormatValues(): array
    {
        return [
            '%Ll' => Str::ucFirstAll($this->lastname), // Фамилия
            '%Ff' => Str::ucFirstAll($this->firstname), // Имя
            '%Mm' => Str::ucFirstAll($this->middlename), // Отчество
            '%LL' => mb_strtoupper($this->lastname), // ФАМИЛИЯ
            '%FF' => mb_strtoupper($this->firstname), // ИМЯ
            '%MM' => mb_strtoupper($this->middlename), // ОТЧЕСТВО
            '%ll' => mb_strtolower($this->lastname), // фамилия
            '%ff' => mb_strtolower($this->firstname), // имя
            '%mm' => mb_strtolower($this->middlename), // отчество
            '%L1' => $this->getFirst('lastname', 'u'), // Ф
            '%F1' => $this->getFirst('firstname', 'u'), // И
            '%M1' => $this->getFirst('middlename', 'u'), // О
            '%l1' => $this->getFirst('lastname', 'l'), // ф
            '%f1' => $this->getFirst('firstname', 'l'), // и
            '%m1' => $this->getFirst('middlename', 'l'), // о
            '%l' => $this->lastname, // изначальное значение фамилии
            '%f' => $this->firstname, // изначальное значение имени
            '%m' => $this->middlename, // изначальное значение отчества
        ];
    }
}