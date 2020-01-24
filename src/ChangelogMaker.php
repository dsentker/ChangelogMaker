<?php
namespace ChangelogMaker;

use ChangelogMaker\Caller\LogCaller;
use ChangelogMaker\Parser\OutputParser;
use ChangelogMaker\Parser\ParserConfiguration;
use ChangelogMaker\Writer\LogfileWriter;
use ChangelogMaker\Writer\SimpleLogfileWriter;

class ChangelogMaker
{

    /** @var LogCaller */
    private $logCaller;

    /** @var OutputParser */
    private $outputParser;

    /** @var LogfileWriter */
    private $logfileWriter;

    /** @var ParserConfiguration */
    private $configuration;

    public function __construct(?ParserConfiguration $parserConfiguration = null)
    {
        $this->configuration = $parserConfiguration ?? new ParserConfiguration();
        $this->logCaller = new LogCaller();
        $this->outputParser = new OutputParser();
        $this->logfileWriter = new SimpleLogfileWriter();
    }

    public function getLogCaller(): LogCaller
    {
        return $this->logCaller;
    }

    public function setLogCaller(LogCaller $logCaller): void
    {
        $this->logCaller = $logCaller;
    }

    public function getOutputParser(): OutputParser
    {
        return $this->outputParser;
    }

    public function setOutputParser(OutputParser $outputParser): void
    {
        $this->outputParser = $outputParser;
    }

    public function getLogfileWriter(): LogfileWriter
    {
        return $this->logfileWriter;
    }

    public function setLogfileWriter(LogfileWriter $logfileWriter): void
    {
        $this->logfileWriter = $logfileWriter;
    }

    public function getConfiguration(): ParserConfiguration
    {
        return $this->configuration;
    }

    public function writeChangelog(string $filePath, string $fromVersion, ?string $toVersion): bool
    {
        $logOutput = $this->getLogCaller()->getLog($this->configuration, $fromVersion, $toVersion);
        $sections = $this->getOutputParser()->parse($this->configuration, $logOutput);
        return $this->getLogfileWriter()->setPath($filePath)->write($sections);
    }

}