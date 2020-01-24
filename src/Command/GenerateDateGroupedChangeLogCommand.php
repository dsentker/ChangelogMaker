<?php

namespace ChangelogMaker\Command;

use ChangelogMaker\ChangelogMaker;
use ChangelogMaker\Writer\MarkdownGroupByDateWriter;

class GenerateDateGroupedChangeLogCommand extends AbstractChangeLogGeneratorCommand
{

    protected static $defaultName = 'generate:grouped:date';

    public function __construct(ChangelogMaker $changelogMaker)
    {
        parent::__construct($changelogMaker);
        $this->changelogMaker->setLogfileWriter(new MarkdownGroupByDateWriter('Y-m-d'));
    }
}
