<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * @todo
 * @build_skip
 * @return string[]
 */
function characterTextSplitter_v0(
    string &$text,
    int $chunkSize = 50
): array {

    \Inilim\Tool\Method\Assert\positiveInteger($chunkSize);

    // ---------------------------------------------
    // 
    // ---------------------------------------------

    $results = [];
    $generator = \Inilim\Tool\Method\Str\toCharsGenerator();

    $tChunk = '';

    foreach ($generator($text, $chunkSize, ['nextChunkSize' => 25]) as $opts => $chunk) {
        $chunk .= $opts['nextChunk'];
        $chunk = \Inilim\Tool\Method\Str\trim($chunk);
        $chunk = \Inilim\Tool\Method\Str\limit($chunk, $chunkSize, '', true);
        de($opts, $chunk);
        $chunkLen = \Inilim\Tool\Method\Str\length($chunk);

        // 
    }

    $results[] = \ltrim($tChunk);

    de($results);

    return $results;
}
