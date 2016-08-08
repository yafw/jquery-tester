<?php
namespace JQueryTester\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use anlutro\cURL\cURL;
use JQueryTester\Checker\CheckerFactory;
use JQueryTester\SourceCode\SourceCodeFactory;

class CheckCommand extends Command
{
    protected function configure()
    {
        $this->setName('check');
        $this->setDescription('Chech if site use JQuery.');
        $this->setHelp($this->getManual());
        $this->addArgument('url', InputArgument::REQUIRED, 'URL address');
        $this->addArgument('technology', InputArgument::OPTIONAL, 'Technology');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $url = $input->getArgument('url');
        $technology = $input->getArgument('technology');

        if (null === $technology) {
            $technology = 'JQuery';
        }

        $curl = new cURL();
        $reader = SourceCodeFactory::createReader($curl, $url);

        $sourceCode = $reader->read();
        $crawler = new Crawler($sourceCode);
        $checker = CheckerFactory::createChecker($technology, $crawler);

        $isUsed = $checker->check();

        echo $this->getMessage($technology, $isUsed);
    }

    private function getManual()
    {
        $manualPath = dirname(__DIR__, 2).'/manual/check.manual';
        $errorMessage = "Opening file was failed!\n";

        $file = fopen($manualPath, 'r') or die($errorMessage);
        $content = fread($file, filesize($manualPath));

        fclose($file);

        return $content;
    }

    private function getMessage($technology, $isUsed)
    {
        if (false === $isUsed) {
            return $technology." is NOT used.\n";
        }

        return $technology." is used.\n";
    }
}
