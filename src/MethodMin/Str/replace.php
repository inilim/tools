<?php

namespace Inilim\Tool\Method\Str;

function replace($search,$replace,$subject,bool $caseSensitive=true){return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}