<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Check;

function multiLineString($value):bool{return \is_string($value)&&\preg_match("/\r\n|\n|\r|".\base64_decode('4oCo',true)."|".\base64_decode('4oCp',true)."/",$value)===1;}