<?php
namespace JQueryTester\SourceCode;

use anlutro\cURL\cURL;

class SourceCodeFactory
{
    public static function createReader(cURL $curl, $url)
    {
        return new Reader($curl, $url);
    }
}
