<?php

namespace Inilim\Tool\Method\Str;

function remove($search,$subject,bool $caseSensitive=true){return $caseSensitive?\str_replace($search,'',$subject):\str_ireplace($search,'',$subject);}