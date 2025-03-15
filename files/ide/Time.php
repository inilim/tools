<?php

namespace Inilim\Tool;

class Time
{
   /**
    * @param null|int|\DateInterval $ttl
    * @return int
    */
   static function lifeTime($ttl, int $default = 3600) {}

   /**
    * @return void
    */
   static function sleepMilSecs(int $v) {}

   /**
    * @return void
    */
   static function sleepRndMilSecs(int $min, int $max) {}

   /**
    * @return void
    */
   static function sleepRndSecs(int $min, int $max) {}

   /**
    * @return int
    */
   static function unixMs() {}
}
