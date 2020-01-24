<?php

namespace ChangelogMaker\Writer;

use ChangelogMaker\Parser\Section;

class SimpleLogfileWriter extends AbstractWriter
{

    /**
     * @param Section[] $sections
     *
     * @return bool
     */
    public function write(array $sections): bool
    {
        return (bool)file_put_contents($this->path, implode($sections));
    }

    public function getFieldDefinition(): array
    {
        return [
            'DATE'    => '%aI',
            'AUTHOR'  => '%cl',
            'MESSAGE' => '%B',
            'HASH'    => '%h',
        ];
    }


}