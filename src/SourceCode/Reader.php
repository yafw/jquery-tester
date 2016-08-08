<?php

namespace JQueryTester\SourceCode;

use anlutro\cURL\cURL;

class Reader
{
    private $curl;
    private $url;

    public function __construct(cURL $curl, $url)
    {
        $this->curl = $curl;
        $this->url = $url;
    }

    public function read()
    {
        $sourceCode = $this->curl->get($this->url)->body;
        $this->validation($sourceCode);

        return $sourceCode;
    }

    private function validation($sourceCode)
    {
        if("" === $sourceCode)
            die("Error! Try another URL format.\n");
    }
}
