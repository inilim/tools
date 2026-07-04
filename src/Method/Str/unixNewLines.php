<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

/**
 * Converts line endings to \n used on Unix-like systems.
 * Line endings are: \n, \r, \r\n, U+2028 line separator, U+2029 paragraph separator.
 */
function unixNewLines(string $s, string $replacement = "\n"): string
{
    // "Warning: preg_replace(): Compilation failed: PCRE2 does not support \F, \L, \l, \N{name}, \U, or \u at offset 2"
    // "\u{2028}" > "4oCo"
    // "\u{2029}" > "4oCp"
    // после билдера, символы "\u{...}" преобразуются, нужно разбиратся, хз кто виноват, минификатор или еще кто.
    // base64_decode кастыль для решения проблемы
    return \preg_replace(
        // \r\n|\n|\r|\u{2028}|\u{2029}
        "/\r\n|\n|\r|" . \base64_decode('4oCo', true) . "|" . \base64_decode('4oCp', true) . "/",
        $replacement,
        $s
    );
}
