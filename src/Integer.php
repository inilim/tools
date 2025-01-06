<?php

namespace Inilim\Tool;

final class Integer extends \Inilim\LazyMethod\LazyMethodAbstract
{
    protected const NAMESPACE   = 'Inilim\Tool\Method\Integer',
        PATH_TO_DIR             = __DIR__ . '/Method/Integer',
        ALIAS                   = [];

    // TINYINT: представляет целые числа от -128 до 127, занимает 1 байт
    // TINYINT UNSIGNED: представляет целые числа от 0 до 255, занимает 1 байт
    const TINY_INT_MAX = 127,
        TINY_INT_MIN = -127,
        TINY_INT_UNSIGNED_MAX = 255,
        TINY_INT_UNSIGNED_MIN = 0,
        TINY_INT_MAX_LENGHT = 3,
        TINY_INT_MIN_LENGHT = 3,
        TINY_INT_UNSIGNED_MAX_LENGHT = 3,
        TINY_INT_UNSIGNED_MIN_LENGHT = 1,
        // SMALLINT: представляет целые числа от -32768 до 32767, занимает 2 байтa
        // SMALLINT UNSIGNED: представляет целые числа от 0 до 65535, занимает 2 байтa
        SMALL_INT_MAX = 32767,
        SMALL_INT_MIN = -32768,
        SMALL_INT_UNSIGNED_MAX = 65535,
        SMALL_INT_UNSIGNED_MIN = 0,
        SMALL_INT_MAX_LENGHT = 5,
        SMALL_INT_MIN_LENGHT = 5,
        SMALL_INT_UNSIGNED_MAX_LENGHT = 5,
        SMALL_INT_UNSIGNED_MIN_LENGHT = 1,
        // MEDIUMINT: представляет целые числа от -8388608 до 8388607, занимает 3 байта
        // MEDIUMINT UNSIGNED: представляет целые числа от 0 до 16777215, занимает 3 байта
        MEDIUM_INT_MAX = 8388607,
        MEDIUM_INT_MIN = -8388608,
        MEDIUM_INT_UNSIGNED_MAX = 16777215,
        MEDIUM_INT_UNSIGNED_MIN = 0,
        MEDIUM_INT_MAX_LENGHT = 7,
        MEDIUM_INT_MIN_LENGHT = 7,
        MEDIUM_INT_UNSIGNED_MAX_LENGHT = 8,
        MEDIUM_INT_UNSIGNED_MIN_LENGHT = 1,
        // INT: представляет целые числа от -2147483648 до 2147483647, занимает 4 байта
        // INT UNSIGNED: представляет целые числа от 0 до 4294967295, занимает 4 байта
        INT_MAX = 2147483647,
        INT_MIN = -2147483648,
        INT_MAX_LENGHT = 10,
        INT_MIN_LENGHT = 10,
        INT_MAX_UNSIGNED_LENGHT = 10,
        INT_MIN_UNSIGNED_LENGHT = 1,
        // BIGINT: представляет целые числа от -9223372036854775808 до 9223372036854775807, занимает 8 байт
        // BIGINT UNSIGNED: представляет целые числа от 0 до 18446744073709551615, занимает 8 байт
        BIG_INT_MAX_LENGHT = 19,
        BIG_INT_MIN_LENGHT = 19,
        BIG_INT_MAX_UNSIGNED_LENGHT = 20,
        BIG_INT_MIN_UNSIGNED_LENGHT = 1,
        MAX_LEN_32_BIT = 10;
}
