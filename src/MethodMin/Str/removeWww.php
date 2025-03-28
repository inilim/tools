<?php

namespace Inilim\Tool\Method\Str;

function removeWww(string $url){$res=\preg_replace('#^(www\.)#i','',$url);if(!\is_string($res)){return $url;}$res=\preg_replace('#(\:\/\/www\.)#i','://',$res);if(!\is_string($res)){return $url;}return $res;}