<?php

namespace Inilim\Tool\Method\Zip;

/**
 * @internal Inilim\Tool\Method\Zip
 * @return \Inilim\Internal\ZipState
 */
function __state()
{
    static $o = null;

    if ($o === null) {
        $o = new class()
        {
            /**
             * @var bool
             */
            var $existsExtZipArchive;
        };

        $o->existsExtZipArchive = \extension_loaded('zip');
    }
    return $o;
}
