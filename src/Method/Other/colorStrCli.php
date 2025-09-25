<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Other;

/**
 * @author inilim
 *
 * @param string $colorHexText
 * @param string|null $colorHexBackground
 * @param 'bold'|'un_bold'|'dim'|'un_dim'|'underlined'|'un_underlined'|'blink'|'un_blink'|'reverse'|'un_reverse'|'hidden'|'un_hidden'|null $style
 */
function colorStrCli(string $text, string $colorHexText, ?string $colorHexBackground = null, ?string $style = null): string
{
    $c = \Inilim\Tool\Method\Other\colorHexToRgb($colorHexText);

    $result = \sprintf("\033[38;2;%s;%s;%sm", $c['red'], $c['green'], $c['blue']);

    if ($colorHexBackground !== null) {
        $b = \Inilim\Tool\Method\Other\colorHexToRgb($colorHexBackground);
        $result .= \sprintf("\033[48;2;%s;%s;%sm", $b['red'], $b['green'], $b['blue']);
    }

    if ($style !== null) {
        $style = \strtolower($style);
        $styles = [
            'bold' => "\e[1m",
            'un_bold' => "\e[21m",
            'dim' => "\e[2m",
            'un_dim' => "\e[22m",
            'underlined' => "\e[4m",
            'un_underlined' => "\e[24m",
            'blink' => "\e[5m",
            'un_blink' => "\e[25m",
            'reverse' => "\e[7m",
            'un_reverse' => "\e[27m",
            'hidden' => "\e[8m",
            'un_hidden' => "\e[28m",
        ];

        $s = $styles[$style] ?? null;
        if ($s === null) {
            throw new \InvalidArgumentException('Value error $style');
        }
        $result .= $s;
    }

    return $result . $text . "\033[0m";
}
