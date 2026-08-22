<?php

namespace Inilim\Tool\Build;

class Helper
{
    static function replaceFirst(string $search, string $replace, string $subject): string
    {
        if ($search === '') return $subject;

        $position = \strpos($subject, $search);

        if ($position !== false) {
            return \substr_replace($subject, $replace, $position, \strlen($search));
        }

        return $subject;
    }

    /**
     * @return class-string[]
     */
    static function getDepsFromDoc(string $codeRaw): array
    {
        if (\str_contains($codeRaw, '@deps(')) {

            \preg_match_all('#@deps\(([a-z\d\_' . \preg_quote('\\') . ']{1,})\)#i', $codeRaw, $depsMatches);

            if (!$depsMatches) {
                de([
                    __FILE__,
                    __LINE__,
                    '$codeRaw' => $codeRaw,
                ]);
            }

            return \array_map(static fn($d) => \trim($d, '\\'), $depsMatches[1]);
        }

        return [];
    }
}
