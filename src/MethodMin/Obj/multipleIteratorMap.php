<?php

declare(strict_types=1);namespace Inilim\Tool\Method\Obj;

function multipleIteratorMap(iterable ... $iterables):\Generator{if($iterables===[]){return;}$mIt=new \MultipleIterator(\MultipleIterator :: MIT_NEED_ANY|\MultipleIterator :: MIT_KEYS_NUMERIC);foreach($iterables as $iterable){if(\is_array($iterable)){$mIt -> attachIterator(new \ArrayIterator($iterable));}else{if($mIt -> containsIterator($iterable)){throw new \InvalidArgumentException('Iterator already attached');}$mIt -> attachIterator($iterable);}}foreach($mIt as $items){yield $items;}}