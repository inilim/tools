<?php

return static function ($text) {
    $cls = \Inilim\Tool\Method\PF\__resourceCache('convert_int_to_char_for_ctype');
    /** @var \Closure $cls */
    $text = $cls->__invoke($text, 'ctype_alpha');
    return \is_string($text) && '' !== $text && !\preg_match('/[^A-Za-z]/', $text);
};
