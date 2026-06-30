<?php

namespace Inilim\Tool\Method\LarStr{function studly($value,bool $normalize=false){if($normalize){$value=\preg_replace_callback('/(^|[-_ \s])([A-Z]+)(?=[-_ \s]|$)/u',static fn($m)=>$m[1].\Inilim\Tool\Method\LarStr\lower($m[2]),$value);}$key=$value;$studlyCache=&\Inilim\Tool\Method\LarStr\__state()-> studlyCache;if(isset($studlyCache[$key])){return $studlyCache[$key];}$words=\preg_split('/\s+/u',\Inilim\Tool\Method\LarStr\replace(['-','_'],' ',$value),-1,\PREG_SPLIT_NO_EMPTY);$studlyWords=\array_map(static fn($word)=>\Inilim\Tool\Method\LarStr\ucfirst($word),$words);return $studlyCache[$key]=\implode('',$studlyWords);}if(!\Inilim\Tool\LarStr::__definedIfNot('__state')){
    function __state(){static $o=null;return $o ??= new class{const INVISIBLE_CHARACTERS='\x{0009}\x{0020}\x{00A0}\x{00AD}\x{034F}\x{061C}\x{115F}\x{1160}\x{17B4}\x{17B5}\x{180E}\x{2000}\x{2001}\x{2002}\x{2003}\x{2004}\x{2005}\x{2006}\x{2007}\x{2008}\x{2009}\x{200A}\x{200B}\x{200C}\x{200D}\x{200E}\x{200F}\x{202F}\x{205F}\x{2060}\x{2061}\x{2062}\x{2063}\x{2064}\x{2065}\x{206A}\x{206B}\x{206C}\x{206D}\x{206E}\x{206F}\x{3000}\x{2800}\x{3164}\x{FEFF}\x{FFA0}\x{1D159}\x{1D173}\x{1D174}\x{1D175}\x{1D176}\x{1D177}\x{1D178}\x{1D179}\x{1D17A}\x{E0020}';public $snakeCache=[];public $camelCache=[];public $studlyCache=[];public $uuidFactory;public $ulidFactory;public $randomStringFactory;};}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('lower')){
    function lower($value){return \mb_strtolower($value,'UTF-8');}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('replace')){
    function replace($search,$replace,$subject,$caseSensitive=true){if($search instanceof \Traversable){$search=\iterator_to_array($search);}if($replace instanceof \Traversable){$replace=\iterator_to_array($replace);}if($subject instanceof \Traversable){$subject=\iterator_to_array($subject);}return $caseSensitive?\str_replace($search,$replace,$subject):\str_ireplace($search,$replace,$subject);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('substr')){
    function substr($string,$start,$length=null,$encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('ucfirst')){
    function ucfirst($string){return \Inilim\Tool\Method\LarStr\upper(\Inilim\Tool\Method\LarStr\substr($string,0,1)).\Inilim\Tool\Method\LarStr\substr($string,1);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('upper')){
    function upper($value){return \mb_strtoupper($value,'UTF-8');}
    }}