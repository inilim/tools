<?php


/**
 * Общие типы
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 * @psalm-type Main_1 = \Exception&\ArrayAccess&\Countable
 * @psalm-type Main_Countable = mixed[]\Countable|\ResourceBundle|\SimpleXMLElement
 * 
 */
class TypeMain {}

/**
 * -------------- [IMPORTS] -------------- 
 * @example psalm-import-type NameType from \ClassName as NewNameType
 * 
 * @psalm-import-type Main_1 from \TypeMain as _2_Main_1
 * 
 * 
 * 
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 * 
 * -----File::get()
 * 
 * @psalm-type THROW_get_0 = _2_Main_1&\IteratorAggregate<int,\ErrorException>
 * 
 * @psalm-type Return_get = array{result:null|string,exception:null|THROW_get_0,http_response_header?:string[]}
 * 
 * 
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
 * ---- walkRecursive
 * @psalm-type Param_1_walkRecursive = object|mixed[]
 * @psalm-type Param_2_walkRecursive = callable(mixed, string|int, int):void
 * @psalm-type Return_walkRecursive  = Closure(Param_1_walkRecursive, Param_2_walkRecursive):void
 * 
 */
class TypeArr {}

/**
 * -------------- [IMPORTS] -------------- 
 * @example psalm-import-type NameType from \ClassName as NewNameType
 * 
 * @psalm-import-type Main_1 from \TypeMain as _2_Main_1
 * 
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 * Obj::getCollectionThrowable()
 * 
 * @psalm-type Return_getCollectionThrowable = _2_Main_1&\IteratorAggregate<int,\Throwable>
 */
class TypeObj {}

/**
 * -------------- [IMPORTS] -------------- 
 * @example psalm-import-type NameType from \ClassName as NewNameType
 * 
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 * ------- fgcSend()
 * 
 * TODO cookies
 * 
 * @psalm-type SubParamOptions_multipart = array{name:string,contents:resource|string,filename?:string,headers?:array<string,string>|string[]}[]
 * @psalm-type SubParamOptions_auth = string|string[]
 * @psalm-type SubParamOptions_timeout = int<0,max>|float
 * @psalm-type SubParamOptions_headers = array<string,string|string[]>
 * @psalm-type SubParamOptions_query = string|array<string,string>|string[]
 * @psalm-type SubParamOptions_verify = string|bool
 * @psalm-type SubParamOptions_json = string|mixed[]
 * 
 * @psalm-type ParamOptions = array{method:string,proxy?:string,debug?:bool,allow_redirects?:bool,allow_redirects.max?:int<1,max>,auth?:SubParamOptions_auth,delay?:int<0,max>,headers?:SubParamOptions_headers,multipart?:SubParamOptions_multipart,query?:SubParamOptions_query,verify?:SubParamOptions_verify,timeout?:SubParamOptions_timeout,version?:float,body?:string,form_params?:mixed[],json?:SubParamOptions_json}
 * 
 * @psalm-type SubReturn_response = array{body:null|string,headers:string[],code:int,size:int,time:int}
 * @psalm-type SubReturn_request = array{url:string,method:string,headers:string}
 * 
 * @psalm-type Return_fgcSend = array{response:SubReturn_response,request:SubReturn_request}
 * 
 * ----- normalizeHeaders
 * @psalm-type Param_1_normalizeHeaders = array<string,string|string[]>|string[]
 * @psalm-type Return_normalizeHeaders = array<string,string[]>
 * 
 * ----- multipart
 * @psalm-type Param_1_multipart = array<array{contents:resource|string,name:string,headers?:string[]|array<string,string>,filename?:string}>
 * @psalm-type Param_2_multipart = array{boundary?:string}
 * 
 */
class TypeExp {}



/**
 * 
 * -------------- [IMPORTS] -------------- 
 * @example psalm-import-type NameType from \ClassName as NewNameType
 * 
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 */
class TypeStr {}


/**
 * 
 * -------------- [IMPORTS] -------------- 
 * @example psalm-import-type NameType from \ClassName as NewNameType
 * 
 * -------------- [Define] -------------- 
 * @example psalm-type NameType = string
 * 
 */
class TypePath {}
