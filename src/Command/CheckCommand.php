<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class CheckCommand extends Command
{
    protected function configure()
    {
        $this->setName("check");
        $this->setDescription("Chech if site use JQuery.");
        $this->setHelp($this->getManual());
        $this->addArgument("url", InputArgument::REQUIRED, "URL address");
        $this->addArgument("technology", InputArgument::OPTIONAL, "Technology");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument("url");
        $technology = $input->getArgument("technology");

        if(null === $technology)
            $technology = "JQuery";

        try {
            $checker = $this->loadClass($technology);
            $isUsed = $checker->check($url);
            echo($this->getMessage($technology, $isUsed));
        } catch(Exception $e) {
            die("Command don't support this technology\n");
        }
    }

    private function loadClass($technology)
    {
        $class_name = "\\App\\Checker\\" . $technology . "Checker";
        return new $class_name();
    }

    private function getManual()
    {
        $manual_path = dirname(__DIR__, 2) . "/manual/check.manual";
        $error_message = "Opening file was failed!\n";

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
