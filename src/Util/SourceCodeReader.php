<?php

namespace Util\SourceCode;

class SourceCodeReader
{
    private $sourceCode = "";

    public function __construct($url)
    {
        $this->sourceCode = $this->readSourceCode($url);
        $this->sourceCodeValidation();
    }

    private function readSourceCode($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }

    private function sourceCodeValidation()
    {
        if("" === $this->sourceCode)
            die("Error! Try another URL format.\n");
    }

    public function getSourceCode()
    {
        return $this->sourceCode;
    }
}

?>
