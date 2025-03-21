<?php

namespace Inilim\Tool;

class ID
{
        /**
 * uniqid(more_entropy:true)
 * @see https://www.php.net/manual/ru/function.uniqid.php
 * @return string
 */
    static function uniqEntropy(string $prefix = '') {}

        /**
 * @return string
 */
    static function uuidFromHex(string $uhex, int $version) {}

        /**
 * @return array{0:string,1:string,2:string,3:string,4:string}|null
 */
    static function uuidSplit(string $uuid) {}

        /**
 * @return string
 * @throws \InvalidArgumentException
 */
    static function uuidToBytes(string $uuid) {}

        /**
 * @return string
 */
    static function uuidv4() {}

        /**
 * @return string
 */
    static function uuidv7() {}

    }