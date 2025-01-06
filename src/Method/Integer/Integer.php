<?php

namespace Inilim\Integer;

use Inilim\FuncCore\FuncCore;
use NumberFormatter;
use RuntimeException;

class Integer
{
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

   function checkPositive(int $value): bool
   {
      return $value > -1;
   }

   function checkNegative(int $value): bool
   {
      return $value < 1;
   }

   function checkEqual(int $value, int $equal): bool
   {
      return $value === $equal;
   }

   function checkMax(int $value, int $max): bool
   {
      return $value <= $max;
   }

   function checkMin(int $value, int $min): bool
   {
      return $value >= $min;
   }

   function checkLenMax(int $value, int $max): bool
   {
      return $this->checkMax(\strlen(\strval($value)), $max);
   }

   function checkLenMin(int $value, int $min): bool
   {
      return $this->checkMin(\strlen(\strval($value)), $min);
   }

   function checkLenBetween(int $value, int $from_to, int $to_from): bool
   {
      return $this->checkBetween(\strlen(\strval($value)), $from_to, $to_from);
   }

   function checkLenEqual(int $value, int $equal): bool
   {
      return $this->checkEqual(\strlen(\strval($value)), $equal);
   }

   /**
    * @param numeric-string|int $value
    */
   function checkBetween(string|int $value, int $from_to, int $to_from): bool
   {
      if (\is_string($value) && !$this->isNumeric($value)) {
         throw new \TypeError('bad value: ' . $value);
      }

      $v = \intval($value);

      if ($from_to > $to_from) {
         list($to_from, $from_to) = [$from_to, $to_from];
      }
      return $v >= $from_to && $v <= $to_from;
   }

   /**
    * @param numeric-string|int $value
    */
   // function between(string|int $value, int $min, int $max): bool
   // {
   //    $v = \intval($value);
   //    return $v >= $min && $v <= $max;
   // }

   /**
    * -9223372036854775808 <> 9223372036854775807
    */
   function isBigInt(mixed $value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      $len = $this->getLen($value);
      if ($len < self::BIG_INT_MAX_LENGHT) return true;
      if ($len > self::BIG_INT_MAX_LENGHT) return false;
      // длина 19
      $last = \str_starts_with($value, '-') ? 8 : 7;
      return $this->compare(\str_split(\trim($value, '-')), [9, 2, 2, 3, 3, 7, 2, 0, 3, 6, 8, 5, 4, 7, 7, 5, 8, 0, $last]);
   }

   /**
    * 0 <> 18446744073709551615
    */
   function isBigIntUnsigned(mixed $value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      if (\str_starts_with($value, '-')) return false;
      $len = $this->getLen($value);
      if ($len < self::BIG_INT_MAX_UNSIGNED_LENGHT) return true;
      if ($len > self::BIG_INT_MAX_UNSIGNED_LENGHT) return false;
      // длина 20
      return $this->compare(\str_split($value), [1, 8, 4, 4, 6, 7, 4, 4, 0, 7, 3, 7, 0, 9, 5, 5, 1, 6, 1, 5]);
   }

   /**
    * -2147483648 <> 2147483647
    */
   function isInt(mixed $value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      $len = $this->getLen($value);
      if ($len < self::MAX_LEN_32_BIT) return true;
      if ($len > self::MAX_LEN_32_BIT) return false;
      // длина 10
      $last = \str_starts_with($value, '-') ? 8 : 7;
      return $this->compare(\str_split(\trim($value, '-')), [2, 1, 4, 7, 4, 8, 3, 6, 4, $last]);
   }

   /**
    * 
    * 0 <> 4_294_967_295
    */
   function isIntUnsigned(mixed $value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      if (\str_starts_with($value, '-')) return false;
      $len = $this->getLen($value);
      if ($len < self::MAX_LEN_32_BIT) return true;
      if ($len > self::MAX_LEN_32_BIT) return false;
      // длина 10
      return $this->compare(\str_split($value), [4, 2, 9, 4, 9, 6, 7, 2, 9, 5]);
   }

   // ------------------------------------------------------------------
   // ___
   // ------------------------------------------------------------------

   /**
    */
   function isMediumInt(mixed $value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      if ($this->getLen($value) > self::MEDIUM_INT_MAX_LENGHT) return false;
      return $this->checkBetween($value, self::MEDIUM_INT_MIN, self::MEDIUM_INT_MAX);
   }

   /**
    */
   function isMediumIntUnsigned(mixed $value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      if ($this->getLen($value) > self::MEDIUM_INT_UNSIGNED_MAX_LENGHT) return false;
      return $this->checkBetween($value, self::MEDIUM_INT_UNSIGNED_MIN, self::MEDIUM_INT_UNSIGNED_MAX);
   }

   /**
    */
   function isSmallInt(mixed $value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      if ($this->getLen($value) > self::SMALL_INT_MAX_LENGHT) return false;
      return $this->checkBetween($value, self::SMALL_INT_MIN, self::SMALL_INT_MAX);
   }

   /**
    */
   function isSmallIntUnsigned(mixed $value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      if ($this->getLen($value) > self::SMALL_INT_UNSIGNED_MAX_LENGHT) return false;
      return $this->checkBetween($value, self::SMALL_INT_UNSIGNED_MIN, self::SMALL_INT_UNSIGNED_MAX);
   }

   /**
    * @param mixed $value
    */
   function isTinyInt($value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      if ($this->getLen($value) > self::TINY_INT_MAX_LENGHT) return false;
      return $this->checkBetween($value, self::TINY_INT_MIN, self::TINY_INT_MAX);
   }

   /**
    */
   function isTinyIntUnsigned(mixed $value): bool
   {
      if (!$this->isNumeric($value)) return false;
      /** @var int|float|string $value */
      $value = \strval($value);
      /** @var string $value */
      if ($this->getLen($value) > self::TINY_INT_UNSIGNED_MAX_LENGHT) return false;
      return $this->checkBetween($value, self::TINY_INT_UNSIGNED_MIN, self::TINY_INT_UNSIGNED_MAX);
   }

   /**
    * функция не проверяет длину значения, будет true даже с bigint и более.
    */
   function isNumeric(mixed $v): bool
   {
      return FuncCore::isNumeric($v);
   }

   /**
    * проверка int для php, 32bit или 64bit
    * может ли значение стать integer без изменений
    */
   function isIntPHP(mixed $v): bool
   {
      if ($this->isNumeric($v)) {
         /** @var string $v */
         if (\strval(\intval($v)) == \strval($v)) return true;
         return false;
      }
      return false;
   }

   function getRandomIntByLength(int $length): int
   {
      return FuncCore::getRandomIntByLength($length);
   }

   function getCurLenMaxInt(): int
   {
      return FuncCore::getCurLenMaxInt();
   }

   // ------------------------------------------------------------------
   // ------------------------------------------------------------------
   // ------------------------------------------------------------------
   // Laravel 11
   // ------------------------------------------------------------------
   // ------------------------------------------------------------------
   // ------------------------------------------------------------------

   /**
    * The current default locale.
    */
   protected string $locale = 'en';

   /**
    * Format the given number according to the current locale.
    */
   function format(int|float $number, ?int $precision = null, ?int $max_precision = null, ?string $locale = null): string|false
   {
      $this->ensureIntlExtensionIsInstalled();

      $formatter = new NumberFormatter($locale ?? $this->locale, NumberFormatter::DECIMAL);

      if ($max_precision !== null) {
         $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $max_precision);
      } elseif ($precision !== null) {
         $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
      }

      return $formatter->format($number);
   }

   /**
    * Spell out the given number in the given locale.
    */
   function spell(int|float $number, ?string $locale = null, ?int $after = null, ?int $until = null): string
   {
      $this->ensureIntlExtensionIsInstalled();

      if ($after !== null && $number <= $after) {
         return $this->format($number, locale: $locale);
      }

      if ($until !== null && $number >= $until) {
         return $this->format($number, locale: $locale);
      }

      $formatter = new NumberFormatter($locale ?? $this->locale, NumberFormatter::SPELLOUT);

      return $formatter->format($number);
   }

   /**
    * Spell out the given number in the given locale in ordinal form.
    *
    * @param  int|float  $number
    * @param  string|null  $locale
    * @return string
    */
   function spellOrdinal($number, ?string $locale = null): string
   {
      $this->ensureIntlExtensionIsInstalled();

      $formatter = new NumberFormatter($locale ?? static::$locale, NumberFormatter::SPELLOUT);

      $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, '%spellout-ordinal');

      return $formatter->format($number);
   }

   /**
    * Convert the given number to ordinal form.
    * @param int|float $number
    */
   function ordinal($number, ?string $locale = null): string
   {
      $this->ensureIntlExtensionIsInstalled();

      $formatter = new NumberFormatter($locale ?? $this->locale, NumberFormatter::ORDINAL);

      return $formatter->format($number);
   }

   /**
    * Convert the given number to its percentage equivalent.
    */
   function percentage(int|float $number, int $precision = 0, ?int $max_precision = null, ?string $locale = null): string|false
   {
      $this->ensureIntlExtensionIsInstalled();

      $formatter = new NumberFormatter($locale ?? $this->locale, NumberFormatter::PERCENT);

      if ($max_precision !== null) {
         $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $max_precision);
      } else {
         $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
      }

      return $formatter->format($number / 100);
   }

   /**
    * Convert the given number to its currency equivalent.
    */
   function currency(int|float $number, string $in = 'USD', ?string $locale = null): string|false
   {
      $this->ensureIntlExtensionIsInstalled();

      $formatter = new NumberFormatter($locale ?? $this->locale, NumberFormatter::CURRENCY);

      return $formatter->formatCurrency($number, $in);
   }

   /**
    * Convert the given number to its file size equivalent.
    */
   function fileSize(int|float $bytes, int $precision = 0, ?int $max_precision = null): string
   {
      $units = [
         'B',
         'KB',
         'MB',
         'GB',
         'TB',
         'PB',
         'EB',
         'ZB',
         'YB'
      ];

      for ($i = 0; ($bytes / 1024) > 0.9 && ($i < \sizeof($units) - 1); $i++) {
         $bytes /= 1024;
      }

      return \sprintf(
         '%s %s',
         $this->format($bytes, $precision, $max_precision),
         $units[$i]
      );
   }

   /**
    * Convert the number to its human-readable equivalent.
    */
   function abbreviate(int|float $number, int $precision = 0, ?int $max_precision = null): bool|string
   {
      return $this->forHumans($number, $precision, $max_precision, abbreviate: true);
   }

   /**
    * Convert the number to its human-readable equivalent.
    */
   function forHumans(int|float $number, int $precision = 0, ?int $max_precision = null, bool $abbreviate = false): bool|string
   {
      return $this->summarize($number, $precision, $max_precision, $abbreviate ? [
         3 => 'K',
         6 => 'M',
         9 => 'B',
         12 => 'T',
         15 => 'Q',
      ] : [
         3 => ' thousand',
         6 => ' million',
         9 => ' billion',
         12 => ' trillion',
         15 => ' quadrillion',
      ]);
   }

   /**
    * Convert the number to its human-readable equivalent.
    */
   protected function summarize(int|float $number, int $precision = 0, ?int $max_precision = null, array $units = []): string|false
   {
      if (empty($units)) {
         $units = [
            3 => 'K',
            6 => 'M',
            9 => 'B',
            12 => 'T',
            15 => 'Q',
         ];
      }

      switch (true) {
         case \floatval($number) === 0.0:
            return $precision > 0 ? $this->format(
               0,
               $precision,
               $max_precision
            ) : '0';
         case $number < 0:
            return \sprintf('-%s', $this->summarize(\abs($number), $precision, $max_precision, $units));
         case $number >= 1e15:
            return \sprintf('%s' . \end($units), $this->summarize($number / 1e15, $precision, $max_precision, $units));
      }

      $number_exponent = \floor(\log10($number));
      $display_exponent = $number_exponent - ($number_exponent % 3);
      $number /= \pow(10, $display_exponent);

      return \trim(\sprintf('%s%s', $this->format($number, $precision, $max_precision), $units[$display_exponent] ?? ''));
   }

   /**
    * Clamp the given number between the given minimum and maximum.
    */
   function clamp(int|float $number, int|float $min, int|float $max): int|float
   {
      return FuncCore::clamp($number, $min, $max);
   }

   /**
    * Set the default locale.
    */
   function useLocale(string $locale): void
   {
      $this->locale = $locale;
   }

   /**
    * Ensure the "intl" PHP extension is installed.
    */
   protected function ensureIntlExtensionIsInstalled(): void
   {
      if (!\extension_loaded('intl')) {
         $method = \debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];

         throw new RuntimeException('The "intl" PHP extension is required to use the [' . $method . '] method.');
      }
   }

   // ------------------------------------------------------------------
   // ------------------------------------------------------------------
   // ------------------------------------------------------------------
   // End Laravel 11
   // ------------------------------------------------------------------
   // ------------------------------------------------------------------
   // ------------------------------------------------------------------

   // ------------------------------------------------------------------
   // protected
   // ------------------------------------------------------------------

   /**
    * @param string[] $value
    * @param int[] $array_int
    */
   protected function compare(array $value, array $array_int): bool
   {
      $combine = \array_map(null, $value, $array_int);
      foreach ($combine as $c) {
         list($v, $a) = $c;
         $v = \intval($v);
         if ($v > $a) return false;
         elseif ($v < $a) return true;
      }
      return true;
   }

   /**
    */
   protected function getLen(string $value): int
   {
      return \strlen(\trim($value, '-'));
   }
}
