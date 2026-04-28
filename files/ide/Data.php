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
    static function URLProtocolsAsClosure(): Closure {}

        /**
 * @return \Generator<string>
 */
    static function URLProtocolsAsGenerator(): Generator {}

        
    static function URLProtocolsAsString(string $separator = ''): string {}

        /**
 * @author https://github.com/shipfastlabs/agent-detector/
 * @author vercel/detect-agent
 * @author https://github.com/pulumi/pulumi/blob/7db25a5b6c31ba4ddca523d8761c7153ca38c3e4/pkg/cmd/pulumi/metadata/metadata.go
 * @author inilim
 * 
 * @return \Generator<string,string[]>
 */
    static function agentsEnvVars(): Generator {}

        /**
 * @return \Closure():string[]
 * @ext mbstring
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
 * @template TKey of 'COOKIE'|'ISO8601'|'RFC822'|'RFC850'|'RFC1036'|'RFC1123'|'RFC7231'|'RFC2822'|'RFC3339'|'RFC3339_EXTENDED'|'RSS'|'W3C'|'ISO8601_EXPANDED'|'SQL_FORMAT'
 * @return array<TKey,string>
 */
    static function dateTimePatterns(): array {}

        /**
 * @author inilim
 * @see https://raw.githubusercontent.com/jshttp/mime-db/master/db.json
 * 
 * @tags data
 */
    static function getMimeTypeByExt(string $extension): ?string {}

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
 * @return \Generator<string>
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

        /**
 * @return \Generator<string>
 */
    static function magicMethodsAsGenerator(): Generator {}

        /**
 * @return string
 */
    static function magicMethodsAsString(string $separator = '') {}

        /**
 * @author inilim
 * @author guzzle/guzzle
 * @see https://raw.githubusercontent.com/jshttp/mime-db/master/db.json
 * 
 * extension => content-type
 *
 * @return \Generator<string,string>
 * 
 * @tags generator,data
 */
    static function mimeTypeAsGenerator(): Generator {}

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

        /**
 * @return \Generator<string>
 */
    static function numericEntitiesAsGenerator(): Generator {}

        /**
 * @return string
 */
    static function numericEntitiesAsString(string $separator = ',') {}

        /**
 * @see https://www.regular-expressions.info/refunicodescript.html
 * 
 * 147 position
 * 
 * @example 'latin' => '\p{Latin}';
 * 
 * @return \Generator<string,string>
 */
    static function regexLang(): Generator {}

        /**
 * @return \Closure():string[]
 */
    static function symbolsAsClosure() {}

    }