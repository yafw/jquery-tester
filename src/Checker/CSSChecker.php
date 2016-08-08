<?php

namespace JQueryTester\Checker;

use Symfony\Component\DomCrawler\Crawler;

class CSSChecker implements CheckerInterface
{
    private $crawler;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    public function check()
    {
        $html = $this->crawler->html();
        return $this->containsCSS($html);
    }

    private function containsCSS($html)
    {
        if(preg_match('/\.css/', $html))
                return true;

        return false;
    }
}
