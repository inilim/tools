<?php

declare(strict_types=1);

namespace Inilim\Tool\Method\Exp;

/**
 * @author https://token-calculator.net/token-calculator
 * @see https://huggingface.co/microsoft/Phi-3-small-8k-instruct/blob/main/cl100k_base.tiktoken
 * @psalm-import-type Return_tokenCalculator from \TypeExp
 * 
 * 
 * 
 * @build_skip
 * BPE cl100k_base
 * @return Return_tokenCalculator
 */
function tokenCalcCL100KBaseOnce(string $text, bool $withoutArrayTokens = false): array
{
    return \Inilim\Tool\Method\Exp\tokenCalcCL100KBase()($text, $withoutArrayTokens);
}
