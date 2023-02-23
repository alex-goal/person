<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Components\Inn;
use AlexGoal\Person\Components\Passport;
use AlexGoal\Person\Components\Snils;

trait HasDocType
{
    /**
     * @return bool
     */
    public function isPassport(): bool
    {
        return $this instanceof Passport;
    }

    /**
     * @return bool
     */
    public function isInn(): bool
    {
        return $this instanceof Inn;
    }

    /**
     * @return bool
     */
    public function isSnils(): bool
    {
        return $this instanceof Snils;
    }
}