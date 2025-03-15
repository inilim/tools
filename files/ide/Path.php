<?php

namespace Inilim\Tool;

class Path
{
   /**
    * advanced pathinfo() function
    * @param string $pathTo
    * @param bool $throw
    * @return array{
    * pathDir:string,
    * nameDir:string,
    * isFile:bool,
    * isDir:bool,
    * isLink:bool,
    * ext:string,
    * name:string,
    * fullName:string,
    * withoutExt:bool,
    * emptyName:bool,
    * fullPathTo:string
    * }|null
    * @throws \Exception
    */
   static function info(string $pathTo, bool $throw = true) {}

   /**
    * @return string
    */
   static function normalizePath(string $path) {}
}
