<?php

namespace PhpSolution\StdLib\Helper;

/**
 * Helper
 */
class Helper
{
    /**
     * @param string $field
     *
     * @return string
     */
    public static function getSetter($field): string
    {
        return 'set' . ucfirst($field);
    }

    /**
     * @param string $field
     *
     * @return string
     */
    public static function getGetter($field): string
    {
        return 'get' . ucfirst($field);
    }

    /**
     * @param string $string
     * @param bool   $capitalizeFirstChar
     *
     * @return string
     */
    public static function underscoreToCamelCase(string $string, bool $capitalizeFirstChar = false): string
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        if (!$capitalizeFirstChar) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public static function getType($value): string
    {
        return is_object($value) ? get_class($value) : gettype($value);
    }

    /**
     * @param array  $list
     * @param string $field
     *
     * @return array
     */
    public static function extractByField(array $list, string $field): array
    {
        $result = [];
        foreach ($list as $item) {
            $result[] = self::getItemValue($item, $field);
        }

        return $result;
    }

    /**
     * @param array  $list
     * @param string $field
     *
     * @return array
     */
    public static function indexListByField(array $list, string $field): array
    {
        $result = [];
        foreach ($list as $item) {
            $result[self::getItemValue($item, $field)] = $item;
        }

        return $result;
    }

    /**
     * @param object|array $item
     * @param string       $field
     *
     * @return mixed
     */
    private static function getItemValue($item, string $field)
    {
        return is_object($item) ? $item->{$field}() : $item[$field];
    }

    /**
     * @param array $list
     * @param int   $page
     * @param int   $limit
     *
     * @return array
     */
    public static function paginateList(array $list, int $page, int $limit): array
    {
        $result = [];
        $i = 0;
        $offset = ($page - 1) * $limit;
        foreach ($list as $item) {
            if ($i++ < $offset) {
                continue;
            }
            $result[] = $item;
            if ($i >= $offset + $limit) {
                break;
            }
        }

        return $result;
    }
}