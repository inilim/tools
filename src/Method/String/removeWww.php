<?php

namespace Inilim\Method\String;

function removeWww(string $url): string
{
    $res = \preg_replace('#^(www\.)#i', '', $url);
    if (!\is_string($res)) return $url;
    $res = \preg_replace('#(\:\/\/www\.)#i', '://', $res);
    if (!\is_string($res)) return $url;
    return $res;
}
