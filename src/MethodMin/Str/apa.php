<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Str{function apa(string $value){$minorWords=['and','as','but','for','if','nor','or','so','yet','a','an','the','at','by','for','in','of','off','on','per','to','up','via'];$endPunctuation=['.','!','?',':','—',','];$words=\preg_split('/\s+/',$value,-1,\PREG_SPLIT_NO_EMPTY);$words[0]=\ucfirst(\mb_strtolower($words[0]));for($i=0;$i<\sizeof($words);$i++){$lowercaseWord=\mb_strtolower($words[$i]);if(\Inilim\Tool\Method\PF\str_contains($lowercaseWord,'-')){$hyphenatedWords=\explode('-',$lowercaseWord);$hyphenatedWords=\array_map(static function($part)use($minorWords){return \in_array($part,$minorWords)&&\mb_strlen($part)<=3?$part:\ucfirst($part);},$hyphenatedWords);$words[$i]=\implode('-',$hyphenatedWords);}elseif(\in_array($lowercaseWord,$minorWords)&&\mb_strlen($lowercaseWord)<=3&&!($i===0||\in_array(\mb_substr($words[$i-1],-1),$endPunctuation))){$words[$i]=$lowercaseWord;}else{$words[$i]=\ucfirst($lowercaseWord);}}return \implode(' ',$words);}}namespace Inilim\Tool\Method\Check{if(!\Inilim\Tool\Check::__definedIfNot('php80')){
    function php80(){return \PHP_VERSION_ID>=80000?true:false;}
    }}namespace Inilim\Tool\Method\PF{if(!\Inilim\Tool\PF::__definedIfNot('str_contains')){
    function str_contains(string $haystack,string $needle){if(\Inilim\Tool\Method\Check\php80()){return \str_contains($haystack,$needle);}return ''===$needle||false!==\strpos($haystack,$needle);}
    }}