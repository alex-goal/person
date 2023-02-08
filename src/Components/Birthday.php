<?php

namespace AlexGoal\Person\Components;

use AlexGoal\Person\Helpers\Str;
use Carbon\Carbon;
use DateTimeInterface;

class Birthday
{
    /** @var Carbon|null */
    protected $date;

    /**
     * Birthday Constructor.
     *
     * @param DateTimeInterface|string|null $date
     * @param string|null $format
     */
    public function __construct($date = null, string $format = null)
    {
        if (! empty($date)) {
            $this->setDate($date, $format);
        }
    }

    /**
     * Create Birthday.
     *
     * @param DateTimeInterface|string|null $date
     * @param string|null $format
     * @return Birthday
     */
    public static function create($date = null, string $format = null): Birthday
    {
        return new Birthday($date, $format);
    }

    /**
     * Получить дату рождения.
     *
     * @return Carbon|null
     */
    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    /**
     * Получить дату рождения в указанном формате.
     *
     * @param string|null $format Формат даты ()
     * @return string|null
     * @link https://www.php.net/manual/datetime.format.php
     */
    public function getDateByFormat(string $format = 'Y-m-d'): ?string
    {
        return ! empty($this->date)
            ? $this->date->format($format)
            : null;
    }

    /**
     * Установить дату рождения.
     *
     * @param DateTimeInterface|string $date Дата рождения
     * @param string|null $format Формат, в котором передаётся дата рождения
     * @return $this
     * @link https://www.php.net/manual/datetime.format.php
     */
    public function setDate($date, string $format = null): Birthday
    {
        $this->date = $format
            ? Carbon::createFromFormat($format, $date)->startOfDay()
            : Carbon::parse($date)->startOfDay();

        return $this;
    }

    /**
     * Получить возраст.
     *
     * @param DateTimeInterface|string|null $date Дата, на которую получить возраст.
     * @return int|null
     */
    public function getAge($date = null): ?int
    {
        if (empty($this->date)) {
            return null;
        }

        $date = $date
            ? Carbon::parse($date)->startOfDay()
            : Carbon::now()->startOfDay();

        $age = $this->date->diffInYears($date, false);

        if ($age > 0) {
            return $age;
        } elseif ($age < 0) {
            return null;
        }

        return $this->date->diffInDays($date, false) < 0 ? null : 0;
    }

    /**
     * Получить возраст вместе со словом год|года|лет.
     *
     * @param DateTimeInterface|string|null $date Дата, на которую получить возраст.
     * @return string|null
     */
    public function getAgePhrase($date = null): ?string
    {
        $age = $this->getAge($date);

        if (is_null($age)) {
            return null;
        }

        return Str::numWithWord($age, ['год', 'года', 'лет']);
    }

    /**
     * Является совершеннолетним?
     *
     * @param DateTimeInterface|string|null $date Дата, на которую проверять.
     * @return bool
     */
    public function isAdult($date = null): bool
    {
        return $this->date && $this->getAge($date) >= 18;
    }
}