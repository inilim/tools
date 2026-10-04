<?php

namespace Inilim\Tool\Method\Path{function info(string $pathTo,bool $throw=true){$t=\realpath($pathTo);if($t===false){if($throw){throw new \Exception(\sprintf('"%s" not found',$pathTo));}return null;}$t=\Inilim\Tool\Method\Path\normalize($t);$pathTo=$t;$t=\pathinfo($t,\PATHINFO_ALL);$t['extension']??= '';return['pathDir'=>$t['dirname'],'nameDir'=>\basename($t['dirname']),'isFile'=>$isFile=\is_file($pathTo),'isDir'=>!$isFile,'isLink'=>\is_link($pathTo),'ext'=>$t['extension'],'withoutExt'=>$t['extension']==='','name'=>$t['filename'],'emptyName'=>$t['filename']==='','fullName'=>$t['basename'],'fullPathTo'=>$pathTo];}if(!\Inilim\Tool\Path::__definedIfNot('normalize')){
    function normalize(string $path):string{$path=\strtr($path,'\\','/');$path=\Inilim\Tool\Method\Str\deduplicate($path,'/');if(':'===\Inilim\Tool\Method\LarStr\substr($path,1,1)){$path=\Inilim\Tool\Method\LarStr\ucfirst($path);}return $path;}
    }}namespace Inilim\Tool\Method\Str{if(!\Inilim\Tool\Str::__definedIfNot('deduplicate')){
    function deduplicate(string $string,string $character=' '){return \preg_replace('/'.\preg_quote($character,'/').'+/u',$character,$string);}
    }}namespace Inilim\Tool\Method\LarStr{if(!\Inilim\Tool\LarStr::__definedIfNot('substr')){
    function substr($string,$start,$length=null,$encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('ucfirst')){
    function ucfirst($string){return \mb_ucfirst($string,'UTF-8');}
    }}