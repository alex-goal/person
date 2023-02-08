<?php

namespace AlexGoal\Person\Helpers;

class Str
{
    /**
     * Удаление повторяющихся пробелов в строке.
     *
     * @param string $str
     * @return string
     */
    public static function removingSpaces(string $str): string
    {
        return preg_replace('/[\s]{2,}/', ' ', $str);
    }

    /**
     * Оставляет в строке только те символы,
     * которые могут присутствовать в ФИО.
     *
     * @param string $fio
     * @return string
     */
    public static function onlyFioLetters(string $fio): string
    {
        return trim(self::removingSpaces(
            preg_replace('/[^a-zа-я- ]/ui', '', $fio)
        ));
    }

    /**
     * Оставляет в строке только цифры.
     *
     * @param  string  $str
     * @return string
     */
    public static function onlyNumeric(string $str): string
    {
        return preg_replace("/[^0-9]/", '', $str);
    }

    /**
     * Делает первую букву заглавной.
     *
     * @param string $str
     * @return string
     */
    public static function ucFirst(string $str): string
    {
        return mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr(mb_strtolower($str), 1);
    }

    /**
     * Делает все слова во фразе с заглавной буквы.
     *
     * @param string $name
     * @return string
     */
    public static function ucFirstAll(string $name): string
    {
        return mb_convert_case($name, MB_CASE_TITLE);
    }
}