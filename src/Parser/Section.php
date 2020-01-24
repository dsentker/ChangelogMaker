<?php

namespace ChangelogMaker\Parser;

class Section
{
    /** @var array */
    private $sectionLines;

    public function __construct()
    {
        $this->sectionLines = [];
    }

    public function addLine(string $identifier, string $value)
    {
        $this->sectionLines[$identifier] = $value;
    }

    public function getSectionLines(): array
    {
        return $this->sectionLines;
    }

    public function __toString(): string
    {
        $outLines = [];
        foreach ($this->sectionLines as $key => $sectionLine) {
            $outLines[] = sprintf('%s: %s', $key, $sectionLine);
        }

        return implode(PHP_EOL, $outLines);
    }
}