<?php

namespace JQueryTester\Checker;

use Symfony\Component\DomCrawler\Crawler;

class CheckerFactory
{
    public static function createChecker($technology, $crawler)
    {
        try {
            $class_name = 'JQueryTester\\Checker\\' . $technology . 'Checker';
            return new $class_name($crawler);
        } catch(Exception $e) {
            die("Command don't support this technology\n");
        }
    }
}
