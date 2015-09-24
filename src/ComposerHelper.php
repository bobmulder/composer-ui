<?php

namespace ComposerUI;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessUtils;

class ComposerHelper
{

    /**
     * The working path to regenerate from.
     *
     * @var string
     */
    protected $workingPath;

    /**
     * Create a new ComposerHelper instance.
     *
     * @param  string $workingPath
     */
    public function __construct($workingPath = null)
    {
        set_time_limit(0);

        $this->workingPath = $workingPath;
    }

    /**
     * Call composer command.
     *
     * @return string
     */
    public function composer()
    {
        $process = $this->getProcess();
        $process->setCommandLine($this->findComposer());

        return $this->runProcess($process);
    }

    /**
     * Install composer packages.
     *
     * @return Process
     */
    public function install()
    {
        $process = $this->getProcess();
        $process->setCommandLine($this->findComposer() . 'install');

        return $this->runProcess($process);
    }

    /**
     * Generates zip/tar
     * @return Process
     */
    public function archive()
    {
        $process = $this->getProcess();
        $process->setCommandLine($this->findComposer() . 'archive');

        return $this->runProcess($process);
    }

    /**
     * Update composer packages.
     *
     * @return Process
     */
    public function update()
    {
        $process = $this->getProcess();
        $process->setCommandLine($this->findComposer() . 'update');

        return $this->runProcess($process);
    }

    /**
     * Require one or multiple packages.
     *
     * @param array $packages Package name.
     * @return Process
     */
    public function requirePackages(array $packages)
    {
        $packageString = $this->normalizePackages($packages);

        $process = $this->getProcess();
        $process->setCommandLine($this->findComposer() . 'require ' . $packageString);

        return $this->runProcess($process);
    }

    /**
     * Remove one or more packages.
     *
     * @param array $packages Package name.
     * @return Process
     */
    public function removePackages(array $packages)
    {
        $packageString = $this->normalizePackages($packages, [
            'packageVersion' => false
        ]);

        $process = $this->getProcess();
        $process->setCommandLine($this->findComposer() . 'remove ' . $packageString);

        return $this->runProcess($process);
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (!file_exists($this->workingPath . '/composer.phar')) {
            return 'composer ';
        }

        $binary = ProcessUtils::escapeArgument((new PhpExecutableFinder)->find(false));

        if (defined('HHVM_VERSION')) {
            $binary .= ' --php';
        }

        return "{$binary} composer.phar ";
    }

    /**
     * Get a new Symfony process instance.
     *
     * @return \Symfony\Component\Process\Process
     */
    protected function getProcess()
    {
        return (new Process('', $this->workingPath))->setTimeout(null);
    }

    /**
     * Runs the process and debugs result.
     *
     * @param Process $process
     * @return Process
     */
    protected function runProcess(Process $process)
    {
        $process->mustRun(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo '<pre>ERR > ' . $buffer . '</pre>';
            } else {
                echo '<pre>OUT > ' . $buffer . '</pre>';
            }
        });
        return $process;
    }

    /**
     * Returns a list of packages into a string to use in composer call.
     *
     * Example input: [
     *      'symfony/yaml' => 'dev-master',
     *      'symfony/config'
     * ];
     *
     * Example output: "symfony/yaml:dev-master" "symfony/config"
     *
     * ### Options
     * - `packageVersion` - Add package version into the string. If false, only the package name will be used.
     *
     * @param array $packages
     * @param array $options
     * @return string
     */
    protected function normalizePackages(array $packages, array $options = [])
    {
        $_options = [
            'packageVersion' => true
        ];
        $options = array_merge($_options, $options);

        $packageList = [];
        foreach ((array)$packages as $packageName => $packageVersion) {
            if (is_int($packageName)) {
                $packageName = $packageVersion;
                $packageVersion = false;
            }
            if ($options['packageVersion'] === false) {
                $packageVersion = false;
            }
            $packageList[] = escapeshellarg($packageName . (($packageVersion) ? ":" . $packageVersion : ""));
        }
        return implode(" ", $packageList);
    }

    /**
     * Set the working path used by the class.
     *
     * @param  string $path
     * @return $this
     */
    public function setWorkingPath($path)
    {
        $this->workingPath = realpath($path);

        return $this;
    }

}