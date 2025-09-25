<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 */
function colorHexToAnsi(string $hex): int
{
    $r = \Inilim\Tool\Method\Other\colorHexToRgb($hex);
    // Конвертируем в ANSI 256 цвет (xterm colors)
    return (int)(16 + (\round($r['red'] / 51) * 36) + (\round($r['green'] / 51) * 6) + \round($r['blue'] / 51));
}
