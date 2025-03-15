<?php

namespace Inilim\Tool;

class Integer
{
   /**
    * @param numeric-string|int $num
    * @param numeric-string|int $fromTo
    * @param numeric-string|int $toFrom
    * @return bool
    */
   static function checkBetween($num, $fromTo, $toFrom) {}

   /**
    * @param numeric-string|int $num
    * @param numeric-string|int $fromTo
    * @param numeric-string|int $toFrom
    * @return bool
    */
   static function checkLenBetween($num, $fromTo, $toFrom) {}

   /**
    * @param numeric-string|int $num
    * @param numeric-string|int $max
    * @return bool
    */
   static function checkLenMax($num, $max) {}

   /**
    * @param numeric-string|int $num
    * @param numeric-string|int $min
    * @return bool
    */
   static function checkLenMin($num, $min) {}

   /**
    * @param numeric-string|int $num
    * @param numeric-string|int $max
    * @return bool
    */
   static function checkMax($num, $max) {}

   /**
    * @param numeric-string|int $num
    * @param numeric-string|int $min
    * @return bool
    */
   static function checkMin($num, $min) {}

   /**
    * Clamp the given number between the given minimum and maximum.
    * @param int|float $number
    * @param int|float $min
    * @param int|float $max
    * @return int|float
    */
   static function clamp($number, $min, $max) {}

   /**
    * @param numeric-string|int $num1
    * @param numeric-string|int $num2
    * @return bool
    */
   static function equals($num1, $num2) {}

   /**
    * @return int
    */
   static function getCurLenMaxInt() {}

   /**
    * @return int
    */
   static function getRandomIntByLength(int $length) {}

   /**
    * -9223372036854775808 <> 9223372036854775807
    * @param mixed $value
    * @return bool
    */
   static function isBigInt($value) {}

   /**
    * 0 <> 18446744073709551615
    * @param mixed $value
    * @return bool
    */
   static function isBigIntUnsigned($value) {}

   /**
    * -2147483648 <> 2147483647
    * @param mixed $value
    * @return bool
    */
   static function isInt($value) {}

   /**
    * проверка int для php, 32bit или 64bit
    * может ли значение стать integer без изменений
    * @param mixed $v
    * @return bool
    */
   static function isIntPHP($v) {}

   /**
    * 0 <> 4_294_967_295
    * @param mixed $value
    * @return bool
    */
   static function isIntUnsigned($value) {}

   /**
    * @param mixed $v
    * @return bool
    */
   static function isMediumInt($v) {}

   /**
    * @return bool
    */
   static function isMediumIntUnsigned(mixed $value) {}

   /**
    * @param numeric-string|int $num
    * @return bool
    */
   static function isNegative($num) {}

   /**
    * функция не проверяет длину значения, будет true даже с bigint и более.
    * @param mixed $v
    * @return bool
    */
   static function isNumeric($v) {}

   /**
    * @param numeric-string|int $num
    * @return bool
    */
   static function isPositive($num) {}

   /**
    * @param mixed $value
    * @return bool
    */
   static function isSmallInt($value) {}

   /**
    * @param mixed $value
    * @return bool
    */
   static function isSmallIntUnsigned($value) {}

   /**
    * @param mixed $value
    * @return bool
    */
   static function isTinyInt($value) {}

   /**
    * @param mixed $value
    * @return bool
    */
   static function isTinyIntUnsigned($value) {}

   /**
    * @param numeric-string|int $num
    * @param numeric-string|int $equal
    * @return bool
    */
   static function lenEquals($num, $equal) {}

   /**
    * @param numeric-string|int $num
    * @return int
    */
   static function lenNumeric($num) {}
}
