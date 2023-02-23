<?php

namespace AlexGoal\Person\Helpers;

class Format
{
    /**
     * @param string $string
     * @param string $format
     * @return string
     */
    public static function get(string $string, string $format): string
    {
        $format = mb_strtoupper($format);

        for ($i = 0; $i < strlen($string); $i++) {
            $format = Str::replaceFirst('X', $string[$i], $format);
        }

        return $format;
    }
}