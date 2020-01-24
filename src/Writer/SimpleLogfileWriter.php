<?php

namespace ChangelogMaker\Writer;

use ChangelogMaker\Parser\Section;

class SimpleLogfileWriter implements LogfileWriter
{

    private $path;

    public function setPath(string $path): LogfileWriter
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param Section[] $sections
     *
     * @return bool
     */
    public function write(array $sections): bool
    {
        echo realpath($this->path);
        return (bool)file_put_contents($this->path, implode($sections));
    }
}