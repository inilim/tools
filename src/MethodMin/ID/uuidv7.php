<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\ID{function uuidv7(){$uhex=\substr(\str_pad(\dechex(\Inilim\Tool\Method\Time\unixMs()),12,'0',\STR_PAD_LEFT),-12);$uhex .= \bin2hex(\random_bytes(10));return \Inilim\Tool\Method\ID\uuidFromHex($uhex,7);}if(!\Inilim\Tool\ID::__definedIfNot('uuidFromHex')){
    function uuidFromHex(string $uhex,int $version){return \sprintf('%08s-%04s-%04x-%04x-%12s',\substr($uhex,0,8),\substr($uhex,8,4),\hexdec(\substr($uhex,12,4))&0xfff|$version << 12,\hexdec(\substr($uhex,16,4))&0x3fff|0x8000,\substr($uhex,20,12));}
    }}namespace Inilim\Tool\Method\Time{if(!\Inilim\Tool\Time::__definedIfNot('unixMs')){
    function unixMs(){$timestamp=\microtime(false);return \intval(\substr($timestamp,11),10)*1000+\intval(\substr($timestamp,2,3),10);}
    }}