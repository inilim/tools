<?php

namespace Inilim\Tool;

class Path
{
        /**
 * @todo tests
 * @author inilim
 * via Path::getVendorDirByPath()
 */
    static function getProjectDirByPath(?string $path = null): ?string {}

        /**
 * @todo tests
 * @author inilim
 * via Path::getVendorDirUsingComposer()
 */
    static function getProjectDirUsingComposer(): ?string {}

        /**
 * @todo tests
 * @author inilim
 */
    static function getVendorDirByPath(?string $path = null): ?string {}

        /**
 * @todo tests
 * @author inilim
 */
    static function getVendorDirUsingComposer(): ?string {}

        /**
 * @author Inilim
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

        
    static function normalize(string $path): string {}

        /**
 * @deprecated use Path::normalize
 */
    static function normalizePath(string $path): string {}

        /**
 * @author inilim
 */
    static function realPath(string $path): ?string {}

    }