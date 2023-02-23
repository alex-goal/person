<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Components\Driver;
use AlexGoal\Person\Components\Inn;
use AlexGoal\Person\Components\Passport;
use AlexGoal\Person\Components\Snils;

trait HasDocType
{
    /**
     * @param string $type
     * @return bool
     */
    private function isType(string $type): bool
    {
        return $this instanceof $type;
    }

    /**
     * @return bool
     */
    public function isPassport(): bool
    {
        return $this->isType(Passport::class);
    }

    /**
     * @return bool
     */
    public function isInn(): bool
    {
        return $this->isType(Inn::class);
    }

    /**
     * @return bool
     */
    public function isSnils(): bool
    {
        return $this->isType(Snils::class);
    }

    /**
     * @return bool
     */
    public function isDriver(): bool
    {
        return $this->isType(Driver::class);
    }
}