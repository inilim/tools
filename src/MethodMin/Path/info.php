<?php

namespace Inilim\Tool\Method\Path{function info(string $pathTo,bool $throw=true){$t=\realpath($pathTo);if($t===false){return $throw?throw new \Exception(\sprintf('"%s" not found',$pathTo)):null;}$t=\Inilim\Tool\Method\Path\normalizePath($t);$pathTo=$t;$t=\pathinfo($t,\PATHINFO_ALL);$t['extension']??= '';return['pathDir'=>$t['dirname'],'nameDir'=>\basename($t['dirname']),'isFile'=>$isFile=\is_file($pathTo),'isDir'=>!$isFile,'isLink'=>\is_link($pathTo),'ext'=>$t['extension'],'withoutExt'=>$t['extension']==='','name'=>$t['filename'],'emptyName'=>$t['filename']==='','fullName'=>$t['basename'],'fullPathTo'=>$pathTo];}if(!\Inilim\Tool\Path::__definedIfNot('normalizePath')){
    function normalizePath(string $path){$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\String\deduplicate($path,'/');/*// Windows paths should uppercase the drive letter.*/if(':'===\Inilim\Tool\Method\String\substr($path,1,1)){$path=\Inilim\Tool\Method\String\ucfirst($path);}return $path;}
    }}namespace Inilim\Tool\Method\String{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }if(!\Inilim\Tool\Str::__definedIfNot('substr')){
    function substr(string $string,int $start,?int $length=null,string $encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\Str::__definedIfNot('ucfirst')){
    function ucfirst(string $string):string{return \Inilim\Tool\Method\String\upper(\Inilim\Tool\Method\String\substr($string,0,1)).\Inilim\Tool\Method\String\substr($string,1);}
    }if(!\Inilim\Tool\Str::__definedIfNot('upper')){
    function upper(string $value,?string $encoding='UTF-8'){return \mb_strtoupper($value,$encoding);}
    }}