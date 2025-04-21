<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Json;

function prettyPrint(string $json){$result='';$level=0;$inQuotes=false;$inEscape=false;$endsLineLevel=NULL;$jsonLength=\strlen($json);for($i=0;$i<$jsonLength;$i++){$char=$json[$i];$newLineLevel=NULL;$post="";if($endsLineLevel!==NULL){$newLineLevel=$endsLineLevel;$endsLineLevel=NULL;}if($inEscape){$inEscape=false;}elseif($char==='"'){$inQuotes=!$inQuotes;}elseif(!$inQuotes){switch($char){case '}':case ']':$level--;$endsLineLevel=NULL;$newLineLevel=$level;break;case '{':case '[':$level++;case ',':$endsLineLevel=$level;break;case ':':$post=" ";break;case " ":case "\t":case "\n":case "\r":$char="";$endsLineLevel=$newLineLevel;$newLineLevel=NULL;break;}}elseif($char==='\\'){$inEscape=true;}if($newLineLevel!==NULL){$result .= "\n".\str_repeat("\t",$newLineLevel);}$result .= $char.$post;}return $result;}