<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author guzzle/guzzle
 * Safely opens a PHP stream resource using a filename.
 *
 * When fopen fails, PHP normally raises a warning. This function adds an
 * error handler that checks for errors and throws an exception instead.
 *
 * @param string $filename File to open
 * @param string $mode     Mode used to open the file
 *
 * @return resource
 *
 * @throws \RuntimeException if the file cannot be opened
 */
function tryFopen(string $filename, string $mode)
{
    $errstr = '';
    $resource = \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static fn() => \fopen($filename, $mode),
        static function ($_, $msg) use (&$errstr) {
            $errstr = $msg;
        }
    );

    if (!\is_resource($resource)) {
        throw new \RuntimeException(sprintf(
            'Unable to open "%s" using mode "%s": %s',
            $filename,
            $mode,
            $errstr
        ));
    }

    return $resource;
}
