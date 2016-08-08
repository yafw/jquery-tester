<?php
namespace JQueryTester\Checker;

class CheckerFactory
{
    public static function createChecker($technology, $crawler)
    {
        try {
            $className = 'JQueryTester\\Checker\\'.$technology.'Checker';

            return new $className($crawler);
        } catch (Exception $e) {
            die("Command don't support this technology\n");
        }
    }
}
