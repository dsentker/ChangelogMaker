<?php

namespace ChangelogMaker\Writer;

interface LogfileWriter
{

    public function setPath(string $path): LogfileWriter;

    public function write(array $sections): bool;
}