<?php

namespace App\Checker;

use Symfony\Component\DomCrawler\Crawler;
use App\SourceCode\SourceCodeReader;
use App\Checker\CheckerInterface;

class CSSChecker implements CheckerInterface
{
    public function check($url)
    {
        $sourceCode = SourceCodeReader::getSourceCode($url);
        return $this->containsCSS($sourceCode);
    }

    private function containsCSS($sourceCode)
    {
        if(preg_match('/\.css/', $sourceCode))
                return true;

        return false;
    }
}
