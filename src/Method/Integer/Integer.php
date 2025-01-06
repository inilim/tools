<?php

use NumberFormatter;
use RuntimeException;

class Integer
{




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
   // function between(string|int $value, int $min, int $max): bool
   // {
   //    $v = \intval($value);
   //    return $v >= $min && $v <= $max;
   // }









   // ------------------------------------------------------------------
   // ___
   // ------------------------------------------------------------------















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
}
