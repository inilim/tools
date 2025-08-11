<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Zip{function scan($zip){if(!\Inilim\Tool\Method\Other\extPhp('zip')){throw new \RuntimeException('ext "zip" not found');}if(\is_string($zip)){$rp=\realpath($zip);if(!$rp){throw new \Exception(\sprintf('File "%s", not found',$zip));}$rp=\Inilim\Tool\Method\Path\normalize($rp);$zip=new \ZipArchive();$status=$zip -> open($rp,\ZipArchive :: RDONLY);if($status!==true){throw new \Exception(\sprintf('File "%s", not open. Code: %s',$rp,$status===false?'false':$status));}}elseif($zip -> filename===''){throw new \Exception('Uninitialized zip');}$result=[];for($i=0;$i<$zip -> numFiles;$i++){$ri=$zip -> statIndex($i);if($ri===false){continue;}$result[]=$ri;}return $result;}}namespace Inilim\Tool\Method\Path{if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
    function normalize(string $path):string{$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\Str\substr($path,1,1)){$path=\Inilim\Tool\Method\Str\ucfirst($path);}return $path;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string):string{return \Inilim\Tool\Method\Str\upper(\Inilim\Tool\Method\Str\substr($string,0,1)).\Inilim\Tool\Method\Str\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'):string{return \mb_strtoupper($value,$encoding);}
    }}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&!$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }}