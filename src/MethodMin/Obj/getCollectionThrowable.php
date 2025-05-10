<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Obj;

function getCollectionThrowable(string $message='',int $code=0,?int $line=null,?string $file=null,\Throwable $previous=null){return new class($message,$code,$line,$file,$previous)extends \Exception implements \ArrayAccess,\IteratorAggregate,\Countable{protected $a=[];function __construct($message,$code,$line,$file,$previous){parent :: __construct($message,$code,$previous);$this -> line=$line ??-1;$this -> file=$file ?? '';}function getIterator():\Traversable{return new \ArrayIterator($this -> a);}function offsetExists($offset):bool{return isset($this -> a[$offset]);}function offsetGet($offset){return $this -> a[$offset]?? null;}function offsetSet($offset,$e){if(!$e instanceof \Throwable){throw new \Exception('Value must be of type object<\Throwable>');}if($offset===null){$this -> a[]=$e;}else{$this -> a[$offset]=$e;}}function offsetUnset($offset){unset($this -> a[$offset]);}function count():int{return \sizeof($this -> a);}};return $e;}