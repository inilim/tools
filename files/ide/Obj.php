<?php

namespace Inilim\Tool;

class Obj
{
   /**
    * @phpstan-import-type getCollectionThrowable_return from \Obj
    * @return getCollectionThrowable_return
    */
   static function getCollectionThrowable(string $message = '', int $code = 0, ?int $line = null, ?string $file = null, \Throwable $previous = null) {}

   /**
    * @template T of \Throwable
    * @param T $e
    * @return T
    */
   static function rewriteLocationException(\Throwable $e, string $file, int $line) {}
}
