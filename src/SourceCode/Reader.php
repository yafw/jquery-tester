<?php

namespace App\Util;

use anlutro\cURL\cURL;

class SourceCodeReader
{
    public function getSourceCode($url)
    {
        $sourceCode = $this->read($url);
        $this->validation($sourceCode);

        return $sourceCode;
    }

    private function read($url)
    {
        $curl = new cURL();
        $sourceCode = $curl->get($url)->body;

        return $sourceCode;
    }

    private static function sourceCodeValidation($sourceCode)
    {
        if("" === $sourceCode)
            die("Error! Try another URL format.\n");
    }
}
