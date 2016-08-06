<?php

namespace Util\Checker;

use Symfony\Component\DomCrawler\Crawler;
use Util\SourceCode\SourceCodeReader;
use Util\Checker\CheckerInterface;

class JQueryChecker implements CheckerInterface
{
    private $crawler;

    public function check($url)
    {
        $this->initCrawler($url);
        $script_blocks = $this->findScriptBlocks();
        return $this->containsJQuery($script_blocks);
    }

    private function initCrawler($url)
    {
        $sourceCode = SourceCodeReader::getSourceCode($url);
        $this->crawler = new Crawler($sourceCode);
    }

    private function findScriptBlocks()
    {
        return $this->crawler->filter('script')
            ->each(function(Crawler $node) {
                return $node->text();
            });
    }

    private function containsJQuery($blocks)
    {
        foreach($blocks as $block) {
            // if block contains something like $(...)
            if(preg_match('/\$\(.+\)[\.|{|\s]/', $block))
                return true;
        }

        return false;
    }
}

?>
