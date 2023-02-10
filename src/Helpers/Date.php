<?php

namespace AlexGoal\Person\Helpers;

use Carbon\Carbon;
use DateTimeInterface;

class Date
{
    /**
     * @param DateTimeInterface|string $date
     * @param string|null $format
     * @return Carbon|false
     */
    public static function createCarbon($date, string $format = null)
    {
        return ! empty($format)
            ? Carbon::createFromFormat($format, $date)
            : Carbon::parse($date);
    }

    /**
     * @param DateTimeInterface|string|null $date
     * @param string|null $format
     * @return Carbon|false
     */
    public static function createCarbonOrNow($date = null, string $format = null)
    {
        return ! empty($date)
            ? self::createCarbon($date, $format)
            : Carbon::now();
    }
}