<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Components\Birthday;
use Carbon\Carbon;
use DateTimeInterface;

trait HasBirthday
{
    /** @var Birthday|null */
    protected $birthday;

    /**
     * Получить дату рождения.
     *
     * @return Birthday|null
     */
    public function getBirthday(): ?Birthday
    {
        return $this->birthday;
    }

    /**
     * Получить дату рождения в указанном формате.
     *
     * @param string $format
     * @return string|null
     */
    public function getBirthdayByFormat(string $format = 'Y-m-d'): ?string
    {
        return $this->hasBirthday()
            ? $this->birthday->getDateByFormat($format)
            : null;
    }

    /**
     * @return Carbon|null
     */
    public function getBirthdayDate(): ?Carbon
    {
        return $this->hasBirthday()
            ? $this->birthday->getDate()
            : null;
    }

    /**
     * Установить дату рождения.
     *
     * @param string|DateTimeInterface|Birthday $birthday
     * @param string|null $format
     * @return self
     */
    public function setBirthday($birthday, string $format = null): self
    {
        $this->birthday = $birthday instanceof Birthday
            ? $birthday
            : Birthday::create($birthday, $format);

        return $this;
    }

    /**
     * Установлена ли дата рождения?
     *
     * @return bool
     */
    public function hasBirthday(): bool
    {
        return ! empty($this->birthday);
    }

    /**
     * Получить возраст.
     *
     * @param DateTimeInterface|string|null $date Дата, на которую получить возраст.
     * @return int|null
     */
    public function getAge($date = null): ?int
    {
        return $this->hasBirthday() 
            ? $this->getBirthday()->getAge($date)
            : null;
    }

    /**
     * Является совершеннолетним?
     *
     * @param DateTimeInterface|string|null $date Дата, на которую проверять.
     * @return bool
     */
    public function isAdult($date = null): bool
    {
        return $this->hasBirthday()
            && $this->getBirthday()->isAdult($date);
    }
}