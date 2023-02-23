<?php

namespace AlexGoal\Person\Traits;

use AlexGoal\Person\Components\Inn;
use AlexGoal\Person\Components\Passport;

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
}