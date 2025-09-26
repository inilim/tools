<?php

namespace Inilim\Tool;

class Zip
{
        
    static function open(string $filename, int $flags = 0): ?ZipArchive {}

        /**
 * @todo tests
 * @param string|\ZipArchive $zip path to file-zip OR ZipArchive object
 * @throws \Exception
 * @throws \InvalidArgumentException
 * @return list<array{name:string,index:int,crc:int,size:int,mtime:int,comp_size:int,comp_method:int,encryption_method:int}>
 */
    static function scan($zip): array {}

        /**
 * @todo tests
 * @param string|\ZipArchive $zip path to file-zip OR ZipArchive object
 * @throws \Exception
 * @throws \InvalidArgumentException
 * @return \Generator<int,array{name:string,index:int,crc:int,size:int,mtime:int,comp_size:int,comp_method:int,encryption_method:int}>
 */
    static function scanAsGenerator($zip): Generator {}

    }