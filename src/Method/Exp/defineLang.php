<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author inilim
 * 
 * @return string[]
 */
function defineLang(string $text): array
{
    if ($text === '') {
        return [];
    }
    // берем только буквы
    $text = \preg_replace('/[^\p{L}]/u', '', $text);
    if ($text === null) {
        throw new \Error(\preg_last_error_msg(), \preg_last_error());
    }
    if ($text === '') {
        return [];
    }

    $result = [];
    foreach (\Inilim\Tool\Method\Data\regexLang() as $name => $regex) {
        $len = \strlen($text);
        $text = \preg_replace('/' . $regex . '/u', '', $text);
        if ($text === null) {
            throw new \Error(\preg_last_error_msg(), \preg_last_error());
        }
        if ($len !== \strlen($text)) {
            $result[] = $name;
        }

        if ($text === '') {
            break;
        }
    }

    return $result;
}
