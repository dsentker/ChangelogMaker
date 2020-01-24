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
     * @param array|null $fieldsToParse     An array which defines the fields to parse. The array value represents the
     *                                      git log placeholder (defined here:
     *                                      https://git-scm.com/docs/pretty-formats),
     *                                      while the array key is a unique identifier to get the value for the
     *                                      placeholder.
     * @param string     $keyValueSeparator The string that separates $fieldsToParse key and value, e.g. key::::value
     * @param string     $fieldDelimiter    The string that separates fields, e.g.
     *                                      keyValuePair1||||keyValuePair2||||keyValuePair3...
     * @param string     $sectionDelimiter  The string that separates new log entries
     *
     */
    public function __construct(array $fieldsToParse = [], string $keyValueSeparator = '::::', string $fieldDelimiter = '||||', string $sectionDelimiter = '>>>>')
    {
        $this->fieldsToParse = !empty($fieldsToParse) ? $fieldsToParse : self::getDefaultFieldsToParse();
        $this->keyValueSeparator = $keyValueSeparator;
        $this->fieldSeparator = $fieldDelimiter;
        $this->sectionDelimiter = $sectionDelimiter;
    }

    private static function getDefaultFieldsToParse(): array
    {
        return [
            'DATE'    => '%as',
            'AUTHOR'  => '%cl',
            'MESSAGE' => '%B',
            'HASH'    => '%h',
        ];
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

    public function getFieldsToParse(): array
    {
        return $this->fieldsToParse;
    }

    public function setFieldsToParse(array $fieldsToParse): void
    {
        $this->fieldsToParse = $fieldsToParse;
    }

}