<?php

namespace Inilim\Tool\Test;

use Inilim\Tool\Other;

class Assert
{
    static function arrayHasKey($key, $array, string $message = '')
    {
        $status = (\is_int($key) || \is_string($key)) && \is_array($array) && \array_key_exists($key, $array);
        $data = [
            'name'          => __FUNCTION__,
            'status'        => $status,
            'message'       => $message,
            'args'          => [
                '$key'   => self::varInfo($key),
                '$array' => self::varInfo($array),
            ]
        ];
        self::_assert($data);
    }

    static function same($expected, $actual, string $message = '')
    {
        $data = [
            'name'          => __FUNCTION__,
            'status'        => $expected === $actual,
            'expected'      => \print_r($expected, true),
            'expected_type' => Other::getType($expected),
            'actual'        => \print_r($actual, true),
            'actual_type'   => Other::getType($actual),
            'message'       => $message,
            'args'          => [
                '$expected' => self::varInfo($expected),
                '$actual' => self::varInfo($actual),
            ],
        ];
        self::_assert($data);
    }

    static function isTrue($condition, string $message = '')
    {
        $data = [
            'name'        => __FUNCTION__,
            'status'      => $condition === true,
            'message'     => $message,
            'args'          => [
                '$condition' => self::varInfo($condition),
            ],
        ];
        self::_assert($data);
    }

    /**
     * @param Countable|iterable $haystack
     */
    static function count(int $expectedCount, $haystack, string $message = '')
    {
        $data = [
            'name'          => __FUNCTION__,
            'status'        => \is_iterable($haystack) && \count($haystack) === $expectedCount,
            'expected'      => \print_r($expectedCount, true),
            'expected_type' => Other::getType($expectedCount),
            'message'       => $message,
            'args'          => [
                '$expectedCount' => self::varInfo($expectedCount),
                '$haystack'      => self::varInfo($haystack),
            ],
        ];
        self::_assert($data);
    }

    static function isArray($actual, string $message = '')
    {
        $data = [
            'name'        => __FUNCTION__,
            'status'      => \is_array($actual),
            'actual'      => \print_r($actual, true),
            'actual_type' => Other::getType($actual),
            'message'     => $message,
            'args'          => [
                '$actual'      => self::varInfo($actual),
            ],
        ];
        self::_assert($data);
    }

    static function isString($actual, string $message = '')
    {
        $data = [
            'name'        => __FUNCTION__,
            'status'      => \is_string($actual),
            'actual'      => \print_r($actual, true),
            'actual_type' => Other::getType($actual),
            'message'     => $message,
            'args'          => [
                '$actual'      => self::varInfo($actual),
            ],
        ];
        self::_assert($data);
    }

    static function nullOrString($actual, string $message = '')
    {
        $data = [
            'name'        => __FUNCTION__,
            'status'      => $actual === null || \is_string($actual),
            'actual'      => \print_r($actual, true),
            'actual_type' => Other::getType($actual),
            'message'     => $message,
            'args'          => [
                '$actual'      => self::varInfo($actual),
            ],
        ];
        self::_assert($data);
    }

    static function nullOrInteger($actual, string $message = '')
    {
        $data = [
            'name'        => __FUNCTION__,
            'status'      => $actual === null || \is_int($actual),
            'actual'      => \print_r($actual, true),
            'actual_type' => Other::getType($actual),
            'message'     => $message,
            'args'          => [
                '$actual'      => self::varInfo($actual),
            ],
        ];
        self::_assert($data);
    }

    static function isFalse($condition, string $message = '')
    {
        $data = [
            'name'        => __FUNCTION__,
            'status'      => $condition === false,
            'message'     => $message,
            'args'          => [
                '$condition' => self::varInfo($condition),
            ],
        ];
        self::_assert($data);
    }

    static function isNull($actual, string $message = '')
    {
        $data = [
            'name'        => __FUNCTION__,
            'status'      => $actual === null,
            'actual'      => \print_r($actual, true),
            'actual_type' => Other::getType($actual),
            'message'     => $message,
            'args'          => [
                '$actual' => self::varInfo($actual),
            ],
        ];
        self::_assert($data);
    }

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    protected static function varInfo($value): array
    {
        return [
            'print' => \print_r($value, true),
            'type'  => Other::getType($value),
        ];
    }

    protected static function _assert(array $data)
    {
        $data['line'] = \debug_backtrace(\DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['line'] ?? -1;
        echo \sprintf(
            '<assert data="%s" />',
            \base64_encode(\json_encode($data))
        );
    }
}
