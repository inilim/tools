<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Xml{function createEl(string $qualifiedName,?string $value=null,string $encoding='UTF-8',string $namespace=''){\Inilim\Tool\Method\Assert\extPhp('dom');$doc=new \DOMDocument('1.0',$encoding);$el=new \DOMElement($qualifiedName,$value,$namespace);$root=@$doc -> createElement('root');if($root===false){throw new \DOMException('Failed DOMDocument::createElement("root")');}$doc -> appendChild($root);$root -> appendChild($el);return $el;}}namespace Inilim\Tool\Method\Other{if(!\Inilim\Tool\Other::__definedIfNot('extPhp')){
    function extPhp(string $ext,bool $rechecking=false):bool{static $o=null;$o ??=[];if(isset($o[$ext])&&false===$rechecking){return $o[$ext];}return $o[$ext]=\extension_loaded($ext);}
    }}namespace Inilim\Tool\Method\Assert{if(!\Inilim\Tool\Assert::__definedIfNot('extPhp')){
    function extPhp(string $nameExt,string $message=''){if(false===\Inilim\Tool\Method\Other\extPhp($nameExt)){throw new \InvalidArgumentException(\sprintf($message?:'PHP Extension "%s" not found',$nameExt));}}
    }}