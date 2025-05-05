<?php

namespace Inilim\Tool;

class Data
{
        /**
 * @return string[]
 */
    static function URLProtocolsAsArray() {}

        /**
 * @return \Closure():string[]
 */
    static function URLProtocolsAsClosure() {}

        
    static function URLProtocolsAsGenerator(): Generator {}

        /**
 * @return string
 */
    static function URLProtocolsAsString(string $separator = '') {}

        /**
 * @return \Closure():string[]
 */
    static function arabicAlphabetAsClosure() {}

        /**
 * [ 'А' => '%D0%90' ...]
 * 
 * @return \Closure():array<string,string>
 */
    static function cyrillicAlphabetAndUrlEncodeAsClosure(bool $upper = false) {}

        /**
 * @return string[]
 */
    static function cyrillicAlphabetAsArray(bool $upper = false) {}

        /**
 * @return \Closure():string[]
 */
    static function cyrillicAlphabetAsClosure(bool $upper = false) {}

        /**
 * @return string
 */
    static function cyrillicAlphabetAsString(string $separator = "", bool $upper = false) {}

        /**
 * @return string[]
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 */
    static function htmlEntitiesAsArray() {}

        /**
 * @return \Closure():string[]
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 */
    static function htmlEntitiesAsClosure() {}

        /**
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 */
    static function htmlEntitiesAsGenerator(): Generator {}

        /**
 * @return string
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 */
    static function htmlEntitiesAsString(string $separator = ',') {}

        /**
 * @return string[]
 */
    static function latinAlphabetAsArray(bool $upper = false) {}

        /**
 * @return \Closure():string[]
 */
    static function latinAlphabetAsClosure(bool $upper = false) {}

        /**
 * @return string
 */
    static function latinAlphabetAsString(string $separator = "", bool $upper = false) {}

        /**
 * @return string[]
 */
    static function magicMethodsAsArray() {}

        /**
 * @return \Closure():string[]
 */
    static function magicMethodsAsClosure() {}

        
    static function magicMethodsAsGenerator(): Generator {}

        /**
 * @return string
 */
    static function magicMethodsAsString(string $separator = '') {}

        /**
 * @return int[]
 */
    static function numbersAsArray() {}

        /**
 * @return \Closure():int[]
 */
    static function numbersAsClosure() {}

        /**
 * @return string
 */
    static function numbersAsString(string $separator = '') {}

        /**
 * @return string[]
 */
    static function numericEntitiesAsArray() {}

        /**
 * @return \Closure():string[]
 */
    static function numericEntitiesAsClosure() {}

        
    static function numericEntitiesAsGenerator(): Generator {}

        /**
 * @return string
 */
    static function numericEntitiesAsString(string $separator = ',') {}

        /**
 * @return \Closure():string[]
 */
    static function symbolsAsClosure() {}

    }