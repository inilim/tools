<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Obj;

function peekBackIterator(iterable $iterator):\Generator{if(\is_array($iterator)){$iterator=new \ArrayIterator($iterator);}$bufferKey=null;$bufferValue=null;$hasBuffer=false;$prevValue=null;foreach($iterator as $key=>$value){if(!$hasBuffer){$bufferKey=$key;$bufferValue=$value;$hasBuffer=true;continue;}yield $bufferKey=>['before'=>$prevValue,'current'=>$bufferValue,'after'=>$value];$prevValue=$bufferValue;$bufferKey=$key;$bufferValue=$value;}if($hasBuffer){yield $bufferKey=>['before'=>$prevValue,'current'=>$bufferValue,'after'=>null];}}