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
     * @param string $str
     * @param int|null $length
     * @return string
     */
    public static function onlyNumeric(string $str, int $length = null): string
    {
        $numeric = preg_replace("/[^0-9]/", '', $str);

        return $length ? mb_substr($numeric, 0, $length) : $numeric;
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

    /**
     * Склонение существительных в зависимости от числительных.
     *
     * @param  mixed  $value  Значение
     * @param  array  $words  Массив вариантов, например: ['год', 'года', 'лет']
     * @param  bool  $show  Включает значение $value в результирующею строку
     * @return string
     */
    public static function numWithWord($value, array $words, bool $show = true): string
    {
        $value = (int) $value;

        $num = $value % 100;

        if ($num > 19) {
            $num = $num % 10;
        }

        $out = $show ?  ($value . ' ') : '';

        switch ($num) {
            case 1:  $out .= $words[0]; break;
            case 2:
            case 3:
            case 4:  $out .= $words[1]; break;
            default: $out .= $words[2]; break;
        }

        return $out;
    }
}