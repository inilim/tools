<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path;

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
function info(string $pathTo, bool $throw = true)
{
    $t = \realpath($pathTo);
    if ($t === false) {
        return $throw ? throw new \Exception(\sprintf(
            '"%s" not found',
            $pathTo
        )) : null;
    }

    $t = \Inilim\Tool\Method\Path\normalizePath($t);
    $pathTo = $t;
    $t = \pathinfo($t, \PATHINFO_ALL);
    $t['extension'] ??= '';
    return [
        'pathDir'    => $t['dirname'],
        'nameDir'    => \basename($t['dirname']),
        'isFile'     => $isFile = \is_file($pathTo),
        'isDir'      => !$isFile,
        'isLink'     => \is_link($pathTo),
        'ext'        => $t['extension'],
        'withoutExt' => $t['extension'] === '',
        'name'       => $t['filename'],
        'emptyName'  => $t['filename'] === '',
        'fullName'   => $t['basename'],
        'fullPathTo' => $pathTo,
    ];
}
