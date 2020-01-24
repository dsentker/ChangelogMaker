#!/usr/bin/env php
<?php
require __DIR__ . '/../vendor/autoload.php';

use ChangelogMaker\ChangelogMaker;
use ChangelogMaker\Command\GenerateDateGroupedChangeLogCommand;
use ChangelogMaker\Command\GenerateSimpleChangeLogCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new GenerateSimpleChangeLogCommand(new ChangelogMaker()));
$application->add(new GenerateDateGroupedChangeLogCommand(new ChangelogMaker()));
$application->run();