<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Xml;

/**
 * @link https://php.net/manual/en/domdocument.load.php
 * @return null|\DOMDocument
 */
function loadFile(string $filename, int $options = 0): ?object
{
    \Inilim\Tool\Method\Assert\extPhp('dom');
    $_filename = \Inilim\Tool\Method\Path\realPath($filename);
    if ($_filename === null) {
        throw new \InvalidArgumentException(\sprintf(
            'The path "%s" is not a file.',
            $filename
        ));
    }
    $_filename = \Inilim\Tool\Method\Path\normalize($_filename);

    return \Inilim\Tool\Method\Other\tryCallWithErrHandler(
        static function () use ($_filename, $options) {
            $doc = new \DOMDocument;
            if ($doc->load($_filename, $options) === false) {
                \Inilim\Tool\Method\Other\__setErrorLast(
                    -1,
                    \sprintf('DOMDocument::load("%s") "%s"', $_filename),
                    $_filename,
                    -1
                );
                return null;
            }
            return $doc;
        },
        null
    );
}
