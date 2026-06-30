<?php

namespace Inilim\Tool\Method\LarStr{function ucfirst($string){return \Inilim\Tool\Method\LarStr\upper(\Inilim\Tool\Method\LarStr\substr($string,0,1)).\Inilim\Tool\Method\LarStr\substr($string,1);}if(!\Inilim\Tool\LarStr::__definedIfNot('substr')){
    function substr($string,$start,$length=null,$encoding='UTF-8'){return \mb_substr($string,$start,$length,$encoding);}
    }if(!\Inilim\Tool\LarStr::__definedIfNot('upper')){
    function upper($value){return \mb_strtoupper($value,'UTF-8');}
    }}