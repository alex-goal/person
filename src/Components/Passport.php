<?php

namespace AlexGoal\Person\Components;

use AlexGoal\Person\Helpers\Str;
use AlexGoal\Person\Traits\HasDate;
use AlexGoal\Person\Traits\HasDocType;
use AlexGoal\Person\Traits\HasFullNumber;

class Passport
{
    use HasFullNumber,
        HasDate,
        HasDocType;

    /** @var string */
    protected $department;

    /** @var string */
    protected $depCode;

    /** @var string */
    protected $birthPlace;

    /**
     * Passport Constructor.
     *
     * @param string|null $fullNumber
     */
    public function __construct(?string $fullNumber = null)
    {
        if (! empty($fullNumber)) {
            $this->setFullNumber($fullNumber);
        }
    }

    /**
     * Create Passport.
     *
     * @param string|null $fullNumber
     * @return Passport
     */
    public static function create(?string $fullNumber = null): Passport
    {
        return new self($fullNumber);
    }

    /**
     * @return string
     */
    public function getDepartment(): ?string
    {
        return $this->department;
    }

    /**
     * @param string $department
     * @return Passport
     */
    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasDepartment(): bool
    {
        return ! empty($this->department);
    }

    /**
     * @return string
     */
    public function getDepCode(): ?string
    {
        return $this->depCode;
    }

    /**
     * @param string $depCode
     * @return Passport
     */
    public function setDepCode(string $depCode): self
    {
        $this->depCode = Str::onlyNumeric($depCode, 6);

        if (mb_strlen($this->depCode) == 6) {
            $this->depCode = substr_replace($this->depCode, '-', 3, 0);
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasDepCode(): bool
    {
        return ! empty($this->depCode);
    }

    /**
     * @return string
     */
    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    /**
     * @param string $birthPlace
     * @return Passport
     */
    public function setBirthPlace(string $birthPlace): self
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasBirthPlace(): bool
    {
        return ! empty($this->birthPlace);
    }


}