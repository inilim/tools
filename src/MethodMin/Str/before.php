<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str;

function before(string $subject,string $search):string{if($search===''){return $subject;}$result=\strstr($subject,$search,true);return $result===false?$subject:$result;}