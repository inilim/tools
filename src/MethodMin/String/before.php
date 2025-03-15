<?php

namespace Inilim\Tool\Method\String;

function before(string $subject,string $search):string{if($search===''){return $subject;}$result=\strstr($subject,$search,true);return $result===false?$subject:$result;}