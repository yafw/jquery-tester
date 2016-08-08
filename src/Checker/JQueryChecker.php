<?php

namespace JQueryTester\Checker;

use Symfony\Component\DomCrawler\Crawler;
use JQueryTester\Checker\CheckerInterface;

class JQueryChecker implements CheckerInterface
{
    private $crawler;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function check()
    {
        $html = $this->findScriptBlocks();
        return $this->containsJQuery($html);
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
