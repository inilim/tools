<?php

namespace Inilim\Tool;

class Data
{
        /**
 * @return string[]
 */
    static function URLProtocolsAsArray() {
        throw new \Exception;
    }

        /**
 * @return \Closure():string[]
 */
    static function URLProtocolsAsClosure(): Closure {
        throw new \Exception;
    }

        /**
 * @return \Generator<string>
 */
    static function URLProtocolsAsGenerator(): Generator {
        throw new \Exception;
    }

        
    static function URLProtocolsAsString(string $separator = ''): string {
        throw new \Exception;
    }

        /**
 * @author https://github.com/shipfastlabs/agent-detector/
 * @author vercel/detect-agent
 * @author https://github.com/pulumi/pulumi/blob/7db25a5b6c31ba4ddca523d8761c7153ca38c3e4/pkg/cmd/pulumi/metadata/metadata.go
 * 
 * @author inilim
 * 
 * @return \Generator<string,string[]>
 */
    static function agentsEnvVars(): Generator {
        throw new \Exception;
    }

        /**
 * @return \Closure():string[]
 * @ext mbstring
 */
    static function arabicAlphabetAsClosure() {
        throw new \Exception;
    }

        /**
 * [ 'А' => '%D0%90' ...]
 * 
 * @return \Closure():array<string,string>
 */
    static function cyrillicAlphabetAndUrlEncodeAsClosure(bool $upper = false) {
        throw new \Exception;
    }

        /**
 * @return string[]
 */
    static function cyrillicAlphabetAsArray(bool $upper = false) {
        throw new \Exception;
    }

        /**
 * @return \Closure():string[]
 */
    static function cyrillicAlphabetAsClosure(bool $upper = false) {
        throw new \Exception;
    }

        /**
 * @return string
 */
    static function cyrillicAlphabetAsString(string $separator = "", bool $upper = false) {
        throw new \Exception;
    }

        /**
 * @template TKey of 'COOKIE'|'ISO8601'|'RFC822'|'RFC850'|'RFC1036'|'RFC1123'|'RFC7231'|'RFC2822'|'RFC3339'|'RFC3339_EXTENDED'|'RSS'|'W3C'|'ISO8601_EXPANDED'|'SQL_FORMAT'
 * @return array<TKey,string>
 */
    static function dateTimePatterns(): array {
        throw new \Exception;
    }

        /**
 * @author inilim
 * @see https://raw.githubusercontent.com/jshttp/mime-db/master/db.json
 * 
 * @tags data
 */
    static function getMimeTypeByExt(string $extension): ?string {
        throw new \Exception;
    }

        /**
 * @return string[]
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 */
    static function htmlEntitiesAsArray() {
        throw new \Exception;
    }

        /**
 * @return \Closure():string[]
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 */
    static function htmlEntitiesAsClosure() {
        throw new \Exception;
    }

        /**
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 * @return \Generator<string>
 */
    static function htmlEntitiesAsGenerator(): Generator {
        throw new \Exception;
    }

        /**
 * @return string
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsString()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsArray()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsClosure()
 * @see \Inilim\Tool\Method\Data\htmlEntitiesAsGenerator()
 */
    static function htmlEntitiesAsString(string $separator = ',') {
        throw new \Exception;
    }

        /**
 * @return string[]
 */
    static function latinAlphabetAsArray(bool $upper = false) {
        throw new \Exception;
    }

        /**
 * @return \Closure():string[]
 */
    static function latinAlphabetAsClosure(bool $upper = false) {
        throw new \Exception;
    }

        /**
 * @return string
 */
    static function latinAlphabetAsString(string $separator = "", bool $upper = false) {
        throw new \Exception;
    }

        /**
 * @return string[]
 */
    static function magicMethodsAsArray() {
        throw new \Exception;
    }

        /**
 * @return \Closure():string[]
 */
    static function magicMethodsAsClosure() {
        throw new \Exception;
    }

        /**
 * @return \Generator<string>
 */
    static function magicMethodsAsGenerator(): Generator {
        throw new \Exception;
    }

        /**
 * @return string
 */
    static function magicMethodsAsString(string $separator = '') {
        throw new \Exception;
    }

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
    static function mimeTypeAsGenerator(): Generator {
        throw new \Exception;
    }

        /**
 * @return int[]
 */
    static function numbersAsArray() {
        throw new \Exception;
    }

        /**
 * @return \Closure():int[]
 */
    static function numbersAsClosure() {
        throw new \Exception;
    }

        /**
 * @return string
 */
    static function numbersAsString(string $separator = '') {
        throw new \Exception;
    }

        /**
 * @return string[]
 */
    static function numericEntitiesAsArray() {
        throw new \Exception;
    }

        /**
 * @return \Closure():string[]
 */
    static function numericEntitiesAsClosure() {
        throw new \Exception;
    }

        /**
 * @return \Generator<string>
 */
    static function numericEntitiesAsGenerator(): Generator {
        throw new \Exception;
    }

        /**
 * @return string
 */
    static function numericEntitiesAsString(string $separator = ',') {
        throw new \Exception;
    }

        /**
 * @see https://www.regular-expressions.info/refunicodescript.html
 * 
 * 147 position
 * 
 * @example 'latin' => '\p{Latin}';
 * 
 * @return \Generator<string,string>
 */
    static function regexLang(): Generator {
        throw new \Exception;
    }

        /**
 * @return \Closure():string[]
 */
    static function symbolsAsClosure() {
        throw new \Exception;
    }

    }