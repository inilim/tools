<?php

namespace Inilim\Tool;

class ID
{
        /**
 * uniqid(more_entropy:true)
 * @see https://www.php.net/manual/ru/function.uniqid.php
 */
    static function uniqEntropy(string $prefix = ''): string {}

        /**
 */
    static function uuidFromHex(string $uhex, int $version): string {}

        /**
 * @return array{0:string,1:string,2:string,3:string,4:string}|null
 */
    static function uuidSplit(string $uuid): ?array {}

        /**
 * @throws \InvalidArgumentException
 */
    static function uuidToBytes(string $uuid): string {}

        
    static function uuidv4(): string {}

        
    static function uuidv7(): string {}

    }