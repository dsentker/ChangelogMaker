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

    public function hasLine($identifier): bool
    {
        return array_key_exists($identifier, $this->sectionLines);
    }

    public function getLine(string $identifier): ?string
    {
        return $this->hasLine($identifier)
            ? $this->sectionLines[$identifier]
            : null;
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