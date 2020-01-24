<?php

namespace ChangelogMaker\Writer;

use ChangelogMaker\Parser\Section;
use DateTime;
use Exception;

class MarkdownGroupByDateWriter extends AbstractWriter
{

    /** @var string */
    private $groupDateFormat;

    /**
     * @param string $groupDateFormat The format which is used for grouping the commit dates.
     */
    public function __construct(string $groupDateFormat = 'Y-m-d')
    {
        $this->groupDateFormat = $groupDateFormat;
    }

    public function getFieldDefinition(): array
    {
        return [
            'DATE'    => '%aI', // author date, strict ISO 8601 format
            'AUTHOR'  => '%cl', // author email local-part (the part before the '@' sign)
            'MESSAGE' => '%B', // raw body (unwrapped subject and body)
            'HASH'    => '%h', // abbreviated commit hash
        ];
    }

    /**
     * @param DateTime  $date
     * @param Section[] $sections
     *
     * @return string
     */
    private function createCommitsForGroup(DateTime $date, array $sections): string
    {
        $dateFormatted = $date->format($this->groupDateFormat);
        $commitMessages = [];
        foreach ($sections as $section) {
            $commitMessages[] = sprintf('* %s (%s:%s)', $section->getLine('MESSAGE'), $section->getLine('HASH'), $section->getLine('AUTHOR'));
        }
        return sprintf('## %s%s%s', $dateFormatted, PHP_EOL, implode(PHP_EOL, $commitMessages));
    }

    /**
     * @param Section[] $sections
     *
     * @return bool
     * @throws NotWriteable
     */
    public function write(array $sections): bool
    {
        $sectionsByDate = [];

        foreach ($sections as $section) {

            if (!$section->hasLine('DATE')) {
                throw NotWriteable::requiredFieldsNotPreset('DATE', $section);
            }

            try {
                $date = new DateTime($section->getLine('DATE'));
                $groupKey = $date->format($this->groupDateFormat);
                if (!array_key_exists($groupKey, $sectionsByDate)) {
                    $sectionsByDate[$groupKey] = [];
                }
                $sectionsByDate[$groupKey][] = $section;
            } catch (Exception $e) {
                throw NotWriteable::requiredFieldNotValid('DATE', $e->getMessage());
            }
        }

        uksort($sectionsByDate, function ($dateA, $dateB) {
            return strtotime($dateA) <=> strtotime($dateB);
        });

        $out = [];
        foreach ($sectionsByDate as $dateString => $sections) {
            $date = new DateTime($dateString);
            $out[] = $this->createCommitsForGroup($date, $sections);
        }

        return file_put_contents($this->path, implode(PHP_EOL, $out));
    }
}
