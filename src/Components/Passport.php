<?php

namespace AlexGoal\Person\Components;

use AlexGoal\Person\Helpers\Date;
use AlexGoal\Person\Helpers\Format;
use AlexGoal\Person\Helpers\Str;
use AlexGoal\Person\Traits\HasDocType;
use Carbon\Carbon;
use DateTimeInterface;

class Passport
{
    use HasDocType;

    /** @var string */
    protected $series;

    /** @var string */
    protected $number;

    /** @var Carbon */
    protected $date;

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
     * @return string|null
     */
    public function getFullNumber(): ?string
    {
        return $this->hasFullNumber()
            ? $this->series . $this->number
            : null;
    }

    /**
     * @param string $format
     * @return string
     */
    public function getFullNumberByFormat(string $format = 'XX XX XXXXXX'): ?string
    {
        return $this->hasFullNumber()
            ? Format::get($this->getFullNumber(), $format)
            : null;
    }

    /**
     * @param string $fullNumber
     * @return Passport
     */
    public function setFullNumber(string $fullNumber): self
    {
        $fullNumber = Str::onlyNumeric($fullNumber, 10);

        if (mb_strlen($fullNumber) == 10) {
            $this->series = mb_substr($fullNumber, 0, 4);
            $this->number = mb_substr($fullNumber, 4, 6);
        }

        return $this;
    }

    /**
     * @return void
     */
    protected function updateFullNumber(): void
    {
        if ($this->hasSeries() && $this->hasNumber()) {
            $this->setFullNumber($this->series . $this->number);
        }
    }

    /**
     * @return bool
     */
    public function hasFullNumber(): bool
    {
        return ! empty($this->series)
            && ! empty($this->number);
    }

    /**
     * @return bool
     */
    public function isValidFullNumber(): bool
    {
        return $this->hasFullNumber()
            && mb_strlen($this->getFullNumber()) == 10;
    }

    /**
     * @return string
     */
    public function getSeries(): string
    {
        return $this->series;
    }

    /**
     * @param string $series
     * @return Passport
     */
    public function setSeries(string $series): self
    {
        $this->series = Str::onlyNumeric($series, 4);

        $this->updateFullNumber();

        return $this;
    }

    /**
     * @return bool
     */
    public function hasSeries(): bool
    {
        return ! empty($this->series);
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Passport
     */
    public function setNumber(string $number): self
    {
        $this->number = Str::onlyNumeric($number, 6);

        $this->updateFullNumber();

        return $this;
    }

    /**
     * @return bool
     */
    public function hasNumber(): bool
    {
        return ! empty($this->number);
    }

    /**
     * @return Carbon
     */
    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    /**
     * @param string $format
     * @return string|null
     */
    public function getDateByFormat(string $format = 'Y-m-d'): ?string
    {
        return Date::getDateByFormat($this->date, $format);
    }

    /**
     * @param DateTimeInterface|string $date
     * @param string|null $format
     * @return Passport
     */
    public function setDate($date, ?string $format = null): self
    {
        $this->date = Date::createCarbon($date, $format)->startOfDay();

        return $this;
    }

    /**
     * @return bool
     */
    public function hasDate(): bool
    {
        return ! empty($this->date);
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