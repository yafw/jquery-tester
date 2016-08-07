<?php

namespace Util\Checker;

use Symfony\Component\DomCrawler\Crawler;
use Util\SourceCode\SourceCodeReader;
use Util\Checker\CheckerInterface;

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

?>
