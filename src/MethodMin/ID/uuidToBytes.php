<?php

declare(strict_types=1);namespace Inilim\Tool\Method\ID{function uuidToBytes(string $uuid):string{$spl=\Inilim\Tool\Method\ID\uuidSplit($uuid);if($spl===null){throw new \InvalidArgumentException('Invalid UUID string: '.$uuid);}return \pack('H*',\strtolower(\implode('',$spl)));}if(!\Inilim\Tool\ID::__definedIfNot('uuidSplit')){
    function uuidSplit(string $uuid):?array{if(\preg_match('/^(?:urn:)?(?:uuid:)?(\{)?([0-9a-f]{8})\-?([0-9a-f]{4})'.'\-?([0-9a-f]{4})\-?([0-9a-f]{4})\-?([0-9a-f]{12})(?(1)\}|)$/i',$uuid,$m)!==1){return null;}return[$m[2],$m[3],$m[4],$m[5],$m[6]];}
    }}