<?php

namespace ChangelogMaker\Command;

use ChangelogMaker\ChangelogMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateChangelogCommand extends Command
{

    protected static $defaultName = 'generate:simple';

    /** @var ChangelogMaker */
    private $changelogMaker;

    public function __construct(ChangelogMaker $changelogMaker)
    {
        $this->changelogMaker = $changelogMaker;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates a changelog file based on your git commit history')
            ->setHelp('Creates a changelog file based on your git commit history')
            ->addArgument('fileName', InputArgument::REQUIRED, 'The file to save the changelog to.')
            ->addArgument('startTag', InputArgument::REQUIRED, 'From which version do you want to start?')
            ->addArgument('endTag', InputArgument::OPTIONAL, 'Up to which tag name should the changelog be generated?', null);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'CHANGELOG GENERATOR',
        ]);

        $filePath = $input->getArgument('fileName');
        if ($this->changelogMaker->writeChangelog(
            $filePath,
            $input->getArgument('startTag'),
            $input->getArgument('endTag')
        )) {
            $output->writeln(sprintf('Changelog created: %s', $filePath));
        }

        return 0;

    }


}