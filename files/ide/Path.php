<?php

namespace Inilim\Tool;

class Path
{
        /**
 * @todo tests
 * @author inilim
 * via Path::getVendorDirByPath()
 */
    static function getProjectDirByPath(?string $path = null): ?string {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author inilim
 * via Path::getVendorDirUsingComposer()
 */
    static function getProjectDirUsingComposer(): ?string {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author inilim
 */
    static function getVendorDirByPath(?string $path = null): ?string {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author inilim
 */
    static function getVendorDirUsingComposer(): ?string {
        throw new \Exception;
    }

        /**
 * @todo tests
 * @author inilim
 */
    static function getVendorDirUsingComposer_m2(): ?string {
        throw new \Exception;
    }

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
    static function info(string $pathTo, bool $throw = true) {
        throw new \Exception;
    }

        
    static function normalize(string $path): string {
        throw new \Exception;
    }

        /**
 * @deprecated use Path::normalize
 */
    static function normalizePath(string $path): string {
        throw new \Exception;
    }

        /**
 * @author inilim
 */
    static function realPath(string $path): ?string {
        throw new \Exception;
    }

    }