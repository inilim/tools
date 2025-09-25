<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 */
function colorRgbToHex(int $red, int $green, int $blue, bool $withGrid = false): string
{
    // Ensure values are within the valid range (0-255)
    $r = \max(0, \min(255, $red));
    $g = \max(0, \min(255, $green));
    $b = \max(0, \min(255, $blue));

    // Convert each decimal component to its hexadecimal equivalent
    $hexR = \dechex($r);
    $hexG = \dechex($g);
    $hexB = \dechex($b);

    // Pad single-digit hex values with a leading zero
    $hexR = \str_pad($hexR, 2, '0', \STR_PAD_LEFT);
    $hexG = \str_pad($hexG, 2, '0', \STR_PAD_LEFT);
    $hexB = \str_pad($hexB, 2, '0', \STR_PAD_LEFT);

    // Combine the hex values and prefix with '#'
    return ($withGrid ? '#' : '') . $hexR . $hexG . $hexB;
}
