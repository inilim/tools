<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Path{function getProjectDirUsingComposer():?string{$dir=\Inilim\Tool\Method\Path\getVendorDirUsingComposer();return $dir?\dirname($dir,1):null;}if(!\Inilim\Tool\Path::__definedIfNot('getVendorDirUsingComposer')){
    function getVendorDirUsingComposer():?string{static $cacheDir=null;if($cacheDir!==null){return $cacheDir;}if(\class_exists($class=\Composer\InstalledVersions :: class,true)&&\method_exists($class,'getRootPackage')&&\is_array($result=$class :: getRootPackage())&&\is_string($result=$result['install_path']?? null)&&\is_string($result=\realpath($result))){return $cacheDir=\Inilim\Tool\Method\Path\normalize($result.'/vendor');}return null;}
    }if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
    function normalize(string $path):string{$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\Str\substr($path,1,1)){$path=\Inilim\Tool\Method\Str\ucfirst($path);}return $path;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string):string{return \Inilim\Tool\Method\Str\upper(\Inilim\Tool\Method\Str\substr($string,0,1)).\Inilim\Tool\Method\Str\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'):string{return \mb_strtoupper($value,$encoding);}
    }}