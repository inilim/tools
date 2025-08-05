<?php

/**
 * -------------- [IMPORTS] -------------- 
 * @example psalm-import-type NameType from \ClassName as NewNameType
 * 
 * @psalm-import-type Return_getCollectionThrowable from \TypeObj as _2_Return_getCollectionThrowable
 * 
 * 
 * 
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 *    psalm-type THROW_get_0 = _2_Return_getCollectionThrowable&\IteratorAggregate<\ErrorException>
 *    psalm-type THROW_get_0 = _2_Return_getCollectionThrowable<\ErrorException>
 * @psalm-type THROW_get_0 = \Exception&\ArrayAccess&\Countable&\IteratorAggregate<int,\ErrorException>
 * 
 * @psalm-type Return_get = array{result:null|string,exception:null|THROW_get_0,http_response_header?:string[]}
 */
class TypeFile {}

/**
 * 
 * -------------- [IMPORTS] -------------- 
 * @example psalm-import-type NameType from \ClassName as NewNameType
 * 
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 */
class TypeArr {}

/**
 * -------------- [IMPORTS] -------------- 
 * @example psalm-import-type NameType from \ClassName as NewNameType
 * 
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 * @psalm-type Return_getCollectionThrowable = \Exception&\ArrayAccess&\Countable&\IteratorAggregate
 */
class TypeObj {}

/**
 * -------------- [IMPORTS] -------------- 
 * @example psalm-import-type NameType from \ClassName as NewNameType
 * 
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 * @psalm-type Return_fgcSend = array{response:array{body:null|string,headers:string[],code:int,size:int,time:int},request:array{url:string,body:null|string,method:string,headers:string}}
 */
class TypeExp {}
