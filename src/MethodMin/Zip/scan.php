<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip{function scan($zip){if(!\Inilim\Tool\Method\Zip\__state()-> existsExtZipArchive){throw new \RuntimeException('ext "zip" not found');}if(\is_string($zip)){$rp=\realpath($zip);if(!$rp){throw new \ValueError(\sprintf('File "%s", not found',$zip));}$rp=\Inilim\Tool\Method\Path\normalizePath($rp);$zip=new \ZipArchive();$status=$zip -> open($rp,\ZipArchive :: RDONLY);if($status!==true){throw new \ValueError(\sprintf('File "%s", not open. Code: %s',$rp,$status===false?'false':$status));}}elseif($zip -> filename===''){throw new \ValueError('Uninitialized zip');}$result=[];for($i=0;$i<$zip -> numFiles;$i++){$ri=$zip -> statIndex($i);if($ri===false){continue;}$result[]=$ri;}return $result;}if(!\Inilim\Tool\Zip::__definedIfNot('__state')){
    function __state(){static $o=null;if($o===null){$o=new class{var $existsExtZipArchive;};$o -> existsExtZipArchive=\extension_loaded('zip');}return $o;}
    }}namespace Inilim\Tool\Method\Path{if(!\Inilim\Tool\Path::__definedIfNot('normalizePath')){
    function normalizePath(string $path){$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\Str\substr($path,1,1)){$path=\Inilim\Tool\Method\Str\ucfirst($path);}return $path;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string):string{return \Inilim\Tool\Method\Str\upper(\Inilim\Tool\Method\Str\substr($string,0,1)).\Inilim\Tool\Method\Str\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'){return \mb_strtoupper($value,$encoding);}
    }}