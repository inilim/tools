<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function excerpt(string $text,string $phrase='',array $options=[]){$radius=$options['radius']?? 100;$omission=$options['omission']?? '...';\preg_match('/^(.*?)('.\preg_quote($phrase,'/').')(.*)$/iu',$text,$matches);if(empty($matches)){return null;}$start=\Inilim\Tool\Method\Str\ltrim($matches[1]);$startWithRadius=\Inilim\Tool\Method\Str\ltrim(\mb_substr($start,\max(\mb_strlen($start,'UTF-8')-$radius,0),$radius,'UTF-8'));if($startWithRadius!==$start){$startWithRadius=$omission.$startWithRadius;}$end=\Inilim\Tool\Method\Str\rtrim($matches[3]);$endWithRadius=\Inilim\Tool\Method\Str\rtrim(\mb_substr($end,0,$radius,'UTF-8'));if($endWithRadius!==$end){$endWithRadius .= $omission;}return $startWithRadius.$matches[2].$endWithRadius;}if(!\Inilim\Tool\Str::__definedIfNot('ltrim')){
    function ltrim($value,$charlist=null){if($charlist===null){$ltrimDefaultCharacters=" \n\r\t\v\x00";return \preg_replace('~^[\s\x{FEFF}\x{200B}\x{200E}'.$ltrimDefaultCharacters.']+~u','',$value)?? \ltrim($value);}return \ltrim($value,$charlist);}
    }if(!\Inilim\Tool\Str::__definedIfNot('rtrim')){
    function rtrim($value,$charlist=null){if($charlist===null){$rtrimDefaultCharacters=" \n\r\t\v\x00";return \preg_replace('~[\s\x{FEFF}\x{200B}\x{200E}'.$rtrimDefaultCharacters.']+$~u','',$value)?? \rtrim($value);}return \rtrim($value,$charlist);}
    }}