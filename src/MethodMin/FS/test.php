<?php

namespace Inilim\Tool\Method\FS{function getRecursiveIteratorFilesAsObj(string $dir,bool $skipDots=true){$dir=\realpath($dir);if($dir===false||!\is_dir($dir)){return null;}$dir=\Inilim\Tool\Method\Path\normalizePath($dir);$flags=\FilesystemIterator :: KEY_AS_FILENAME|\FilesystemIterator :: CURRENT_AS_FILEINFO|\FilesystemIterator :: UNIX_PATHS;if($skipDots){$flags |= \FilesystemIterator :: SKIP_DOTS;}$rdi=new \RecursiveDirectoryIterator($dir,$flags);$rii=new \RecursiveIteratorIterator($rdi,\RecursiveIteratorIterator :: SELF_FIRST);return $rii;}}namespace Inilim\Tool\Method\Path{if(!\Inilim\Tool\Path::__definedIfNot('normalizePath')){
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