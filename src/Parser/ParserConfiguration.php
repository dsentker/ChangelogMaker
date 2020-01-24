<?php

namespace ChangelogMaker\Parser;

class ParserConfiguration
{

    /** @var string */
    private $keyValueSeparator;

    /** @var string */
    private $fieldSeparator;

    /** @var string */
    private $sectionDelimiter;

    /** @var array */
    private $fieldsToParse;

    /**
     * @param string $keyValueSeparator     The string that separates $fieldsToParse key and value, e.g. key::::value
     * @param string $fieldDelimiter        The string that separates fields, e.g.
     *                                      keyValuePair1||||keyValuePair2||||keyValuePair3...
     * @param string $sectionDelimiter      The string that separates new log entries
     *
     */
    public function __construct(string $keyValueSeparator = '::::', string $fieldDelimiter = '||||', string $sectionDelimiter = '>>>>')
    {
        $this->keyValueSeparator = $keyValueSeparator;
        $this->fieldSeparator = $fieldDelimiter;
        $this->sectionDelimiter = $sectionDelimiter;
    }

    public function getKeyValueSeparator(): string
    {
        return $this->keyValueSeparator;
    }

    public function setKeyValueSeparator(string $keyValueSeparator): void
    {
        $this->keyValueSeparator = $keyValueSeparator;
    }

    public function getFieldSeparator(): string
    {
        return $this->fieldSeparator;
    }

    public function setFieldSeparator(string $fieldSeparator): void
    {
        $this->fieldSeparator = $fieldSeparator;
    }

    public function getSectionDelimiter(): string
    {
        return $this->sectionDelimiter;
    }

    public function setSectionDelimiter(string $sectionDelimiter): void
    {
        $this->sectionDelimiter = $sectionDelimiter;
    }

    /**
     * @return array
     */
    public function getFieldsToParse(): array
    {
        return $this->fieldsToParse;
    }

    /**
     * @param array $fieldsToParse
     *
     * @internal This method is not meant to be changed from the developer. It is called from ChangelogMaker class with
     *           data provided by the writer.
     */
    public function setFieldsToParse(array $fieldsToParse): void
    {
        $this->fieldsToParse = $fieldsToParse;
    }
}
