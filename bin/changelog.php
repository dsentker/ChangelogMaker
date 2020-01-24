#!/usr/bin/env php
<?php
require __DIR__ . '/../vendor/autoload.php';

use ChangelogMaker\ChangelogMaker;
use ChangelogMaker\Command\GenerateChangelogCommand;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new GenerateChangelogCommand(new ChangelogMaker()));

$application->run();