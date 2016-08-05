<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

use Config\Config;

class CheckCommand extends Command
{
    protected function configure()
    {
        $this->setName("check");
        $this->setDescription("Chech if site use JQuery");
        $this->setHelp($this->getManual());
        $this->addArgument("url", InputArgument::REQUIRED, "URL address");
        $this->addArgument("technology", InputArgument::OPTIONAL, "Technology");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument("url");
        $technology = $input->getArgument("technology");

        if(NULL === $technology)
            $technology = "JQuery";

        if($this->fileExists($technology)) {
            $checker = $this->loadClass($technology);
            $isUsed = $checker->check($url); // Work in progress!!!
            echo($this->getMessage($technology, $isUsed));
        }
    }

    private function fileExists($technology)
    {
        $class_path = Config::$directory . "/src/Util/";
        $class_path .= $technology . "Checker.php";

        if(!file_exists($class_path))
            return false;

        return true;
    }

    private function loadClass($technology)
    {
        $class_name = "\\Util\\Checker\\" . $technology . "Checker";
        return new $class_name();
    }

    private function getManual()
    {
        $manual_path = Config::$directory . "/manual/check.manual";
        $content = $this->readManual($manual_path);

        return $content;
    }

    private function readManual($manual_path)
    {
        $error_message = "Opening file was failed!";

        $file = fopen($manual_path, 'r') or die($error_message);
        $content = fread($file, filesize($manual_path));

        fclose($file);
        return $content;
    }

    private function getMessage($technology, $isUsed)
    {
        if(false === $isUsed)
            return $technology . " is NOT used.\n";

        return $technology . " is used.\n";
    }
}

?>
