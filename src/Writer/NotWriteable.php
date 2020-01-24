<?php

namespace ChangelogMaker\Writer;

use ChangelogMaker\Parser\Section;
use Exception;

class NotWriteable extends Exception
{
    public static function requiredFieldsNotPreset(string $requiredFieldName, Section $section): NotWriteable
    {
        return new self(sprintf(
            'Cannot write the file because the required field "%s" is missing (given: %s).',
            $requiredFieldName,
            $section->__toString()
        ));
    }

    public static function requiredFieldNotValid(string $requiredFieldName, string $additionalContext = ''): NotWriteable
    {
        return new self(
            sprintf('Cannot write the file - "%s" field is not valid (%s)', $requiredFieldName, $additionalContext)
        );
    }
}