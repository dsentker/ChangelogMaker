<?php

namespace ChangelogMaker\Writer;

use ChangelogMaker\Parser\ParserConfiguration;
use ChangelogMaker\Parser\Section;

interface LogfileWriter
{

    public function setPath(string $path): LogfileWriter;

    /**
     * @param Section[] $sections
     *
     * @return bool
     */
    public function write(array $sections): bool;

    public function setConfiguration(ParserConfiguration $configuration): void;

    /**
     * @return array An array which defines the fields to parse. The array value represents the git log placeholder
     *               (defined here https://git-scm.com/docs/pretty-formats), while the array key is a unique identifier
     *               to get the value for the placeholder.
     */
    public function getFieldDefinition(): array;
}