<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Components\Passport;
use AlexGoal\Person\Helpers\Date;
use Carbon\Carbon;
use DateTimeInterface;

trait HasDate
{
    /** @var Carbon */
    protected $date;


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

}