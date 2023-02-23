<?php

namespace AlexGoal\Person\Helpers;

class Phone
{
    /**
     * Проверка соответствия телефонного номера определенному формату.
     *
     * @param  string  $phone
     * @param  string  $format
     * @return bool
     */
    public static function isCorrect(string $phone, string $format = '+7 (XXX) XXX-XX-XX'): bool
    {
        return self::transform($phone, $format) !== null;
    }

    /**
     * Преобразование телефонного номера согласно шаблону.
     *
     * @param  string  $phone
     * @param  string  $format
     * @return string|null
     */
    public static function transform(string $phone, string $format = '+7 (XXX) XXX-XX-XX'): ?string
    {
        $format = mb_strtoupper($format);
        $phoneNumber = Str::onlyNumeric($phone);
        $phoneLength = strlen($phoneNumber);

        if (! in_array($phoneLength, [10, 11])) {
            return null;
        }

        if ($phoneLength == 11) {
            if ($phoneNumber[0] != '7' && $phoneNumber[0] != '8') {
                return null;
            }

            $phoneNumber = substr($phoneNumber, 1, 10);
        }

        for ($i = 0; $i < strlen($phoneNumber); $i++) {
            $format = Str::replaceFirst('X', $phoneNumber[$i], $format);
        }

        if (mb_strpos($format, 'X') !== false) {
            return null;
        }

        return $format;
    }
}
