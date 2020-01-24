<?php

namespace ChangelogMaker\Caller;

use ChangelogMaker\Parser\ParserConfiguration;

class LogCaller
{

    public const BASE_COMMAND = 'git log';

    public function getLog(ParserConfiguration $configuration, string $fromVersion, ?string $toVersion): string
    {
        exec($this->getCommand($configuration, $fromVersion, $toVersion), $output);
        return implode('', $output);
    }

    public function getCommand(ParserConfiguration $configuration, string $fromVersion, ?string $toVersion)
    {
        $fromTo = sprintf('%s..%s', $fromVersion, $toVersion ?? '');

        $formatInstructions = '';
        foreach ($configuration->getFieldsToParse() as $fieldName => $logFormat) {
            $formatInstructions .= sprintf(
                '%s%s%s%s',
                $fieldName,
                $configuration->getKeyValueSeparator(),
                $logFormat,
                $configuration->getFieldSeparator()
            );
        }
        $formatInstructions .= $configuration->getSectionDelimiter();

        return sprintf('%s --format="%s" %s 2>&1', static::BASE_COMMAND, $formatInstructions, $fromTo);
    }

}