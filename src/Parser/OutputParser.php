<?php

namespace ChangelogMaker\Parser;

class OutputParser
{

    /**
     * @param ParserConfiguration $configuration
     * @param string              $output
     *
     * @return Section[]
     */
    public function parse(ParserConfiguration $configuration, string $output): array
    {

        $returnSections = [];
        $sectionsFromCli = explode($configuration->getSectionDelimiter(), $output);

        foreach ($sectionsFromCli as $sectionData) {
            $section = new Section();
            $keyValuePairs = explode($configuration->getFieldSeparator(), $sectionData);
            foreach ($keyValuePairs as $keyValuePair) {
                if (false !== strpos($keyValuePair, $configuration->getKeyValueSeparator())) {
                    [$key, $value] = explode($configuration->getKeyValueSeparator(), $keyValuePair);
                    $section->addLine($key, $value);
                }
            }
            if (count($section->getSectionLines()) > 0) {
                $returnSections[] = $section;
            }

        }

        return $returnSections;
    }
}