<?php

namespace App\Checker;

use Symfony\Component\DomCrawler\Crawler;
use anlutro\cURL\cURL;
use App\SourceCode\Reader;
use App\Checker\CheckerInterface;

class CSSChecker implements CheckerInterface
{
    public function check($url)
    {
        $curl = new cURL();
        $sourceCode = $curl->get($url)->body;

        return $this->containsCSS($sourceCode);
    }

    private function containsCSS($sourceCode)
    {
        if(preg_match('/\.css/', $sourceCode))
                return true;

        return false;
    }
}
