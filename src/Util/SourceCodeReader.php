<?php

namespace Util\SourceCode;

class SourceCodeReader
{
    public static function getSourceCode($url)
    {
        $sourceCode = self::readSourceCode($url);
        self::sourceCodeValidation($sourceCode);

        return $sourceCode;
    }

    private static function readSourceCode($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }

    private static function sourceCodeValidation($sourceCode)
    {
        if("" === $sourceCode)
            die("Error! Try another URL format.\n");
    }
}

?>
