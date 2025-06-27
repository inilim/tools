<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Path{function getVendorDirByPath(?string $path=null):?string{static $cacheDirForSelf=null;$self=$path===null;if($self&&$cacheDirForSelf!==null){return $cacheDirForSelf;}$result=null;$path ??= __DIR__;$path=\Inilim\Tool\Method\Path\normalize($path.'/');if(\Inilim\Tool\Method\PF\str_contains($path,'/vendor/')){$path=\Inilim\Tool\Method\Str\beforeLast($path,'/vendor/');$result=\Inilim\Tool\Method\Path\normalize($path.'/vendor');}elseif(\is_dir($path.'vendor')){$result=$path.'vendor';}else{$path=\Inilim\Tool\Method\Path\normalize(\dirname($path).'/');if(\is_dir($path.'vendor')){$result=$path.'vendor';}}if($self&&$result!==null){$cacheDirForSelf=$result;}return $result;}if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
    function normalize(string $path):string{$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\Str\substr($path,1,1)){$path=\Inilim\Tool\Method\Str\ucfirst($path);}return $path;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('beforeLast')){
    function beforeLast(string $subject,string $search):string{if($search===''){return $subject;}$pos=\mb_strrpos($subject,$search);if($pos===false){return $subject;}return \Inilim\Tool\Method\Str\substr($subject,0,$pos);}
    }if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string){return \Inilim\Tool\Method\Str\upper(\Inilim\Tool\Method\Str\substr($string,0,1)).\Inilim\Tool\Method\Str\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'){return \mb_strtoupper($value,$encoding);}
    }}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80():bool{return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle):bool{if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}