<?php

namespace AlexGoal\Person\Components;

use AlexGoal\Person\Helpers\Date;
use AlexGoal\Person\Helpers\Str;
use Carbon\Carbon;
use DateTimeInterface;

class Inn
{
    /** @var string */
    protected $number;

    /** @var Carbon */
    protected $date;

    public function __construct(string $number = null)
    {
        if (! empty($number)) {
            $this->setNumber($number);
        }
    }

    /**
     * @param string|null $number
     * @return Inn
     */
    public static function create(string $number = null): Inn
    {
        return new self($number);
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return self
     */
    public function setNumber(string $number): self
    {
        $this->number = Str::onlyNumeric($number, 12);

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
    public function getDate(): Carbon
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
     * @return self
     */
    public function setDate($date): self
    {
        $this->date = Date::createCarbon($date)->startOfDay();

        return $this;
    }

    /**
     * @return bool
     */
    public function hasDate(): bool
    {
        return ! empty($this->date);
    }
}