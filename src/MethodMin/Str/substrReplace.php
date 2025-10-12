<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Str;

function substrReplace($string,$replace,$offset=0,$length=null){if($length===null){$length=\strlen($string);}return \substr_replace($string,$replace,$offset,$length);}