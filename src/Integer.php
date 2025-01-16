<?php

namespace Inilim\Tool;

/**
 * @method  static  bool checkBetween(numeric-string|int $num, numeric-string|int $fromTo, numeric-string|int $toFrom) 
 * @see \Inilim\Tool\Method\Integer\checkBetween()
 * 
 * @method  static  bool checkLenBetween(numeric-string|int $num, numeric-string|int $fromTo, numeric-string|int $toFrom) 
 * @see \Inilim\Tool\Method\Integer\checkLenBetween()
 * 
 * @method  static  bool checkLenMax(numeric-string|int $num, numeric-string|int $max) 
 * @see \Inilim\Tool\Method\Integer\checkLenMax()
 * 
 * @method  static  bool checkLenMin(numeric-string|int $num, numeric-string|int $min) 
 * @see \Inilim\Tool\Method\Integer\checkLenMin()
 * 
 * @method  static  bool checkMax(numeric-string|int $num, numeric-string|int $max) 
 * @see \Inilim\Tool\Method\Integer\checkMax()
 * 
 * @method  static  bool checkMin(numeric-string|int $num, numeric-string|int $min) 
 * @see \Inilim\Tool\Method\Integer\checkMin()
 * 
 * @method  static  int|float clamp(int|float $number, int|float $min, int|float $max) 
 * @see \Inilim\Tool\Method\Integer\clamp()
 * 
 * @method  static  bool equals(numeric-string|int $num1, numeric-string|int $num2) 
 * @see \Inilim\Tool\Method\Integer\equals()
 * 
 * @method  static  int getCurLenMaxInt() 
 * @see \Inilim\Tool\Method\Integer\getCurLenMaxInt()
 * 
 * @method  static  int getRandomIntByLength(int $length) 
 * @see \Inilim\Tool\Method\Integer\getRandomIntByLength()
 * 
 * @method  static  bool isBigInt(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isBigInt()
 * 
 * @method  static  bool isBigIntUnsigned(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isBigIntUnsigned()
 * 
 * @method  static  bool isInt(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isInt()
 * 
 * @method  static  bool isIntPHP(mixed $v) 
 * @see \Inilim\Tool\Method\Integer\isIntPhp()
 * 
 * @method  static  bool isIntUnsigned(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isIntUnsigned()
 * 
 * @method  static  bool isMediumInt(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isMediumInt()
 * 
 * @method  static  bool isMediumIntUnsigned(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isMediumIntUnsigned()
 * 
 * @method  static  bool isNegative(numeric-string|int $num) 
 * @see \Inilim\Tool\Method\Integer\isNegative()
 * 
 * @method  static  bool isNumeric(mixed $v) 
 * @see \Inilim\Tool\Method\Integer\isNumeric()
 * 
 * @method  static  bool isPositive(numeric-string|int $num) 
 * @see \Inilim\Tool\Method\Integer\isPositive()
 * 
 * @method  static  bool isSmallInt(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isSmallInt()
 * 
 * @method  static  bool isSmallIntUnsigned(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isSmallIntUnsigned()
 * 
 * @method  static  bool isTinyInt(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isTinyInt()
 * 
 * @method  static  bool isTinyIntUnsigned(mixed $value) 
 * @see \Inilim\Tool\Method\Integer\isTinyIntUnsigned()
 * 
 * @method  static  bool lenEquals(numeric-string|int $num, numeric-string|int $equal) 
 * @see \Inilim\Tool\Method\Integer\lenEquals()
 * 
 * @method  static  int lenNumeric(numeric-string|int $num) 
 * @see \Inilim\Tool\Method\Integer\lenNumeric()
 * 
 */
final class Integer extends \Inilim\LazyMethod\LazyMethodAbstract
{
    protected const NAMESPACE   = 'Inilim\Tool\Method\Integer',
        PATH_TO_DIR             = __DIR__ . '/Method/Integer';

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
