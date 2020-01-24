<?php

namespace ChangelogMaker\Writer;

use ChangelogMaker\Parser\ParserConfiguration;

abstract class AbstractWriter implements LogfileWriter
{

    protected $path = 'CHANGELOG.txt';

    /** @var null|ParserConfiguration */
    protected $configuration;

    public function setPath(string $path): LogfileWriter
    {
        $this->path = $path;
        return $this;
    }

    public function setConfiguration(ParserConfiguration $configuration): void
    {
        $this->configuration = $configuration;
    }
}
