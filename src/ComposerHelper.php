<?php

namespace ComposerUI;

use Symfony\Component\Process\Process;

class ComposerHelper
{

    public function composer()
    {
        $process = new Process('composer');
        $process->setTimeout(3600);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        return $process->getOutput();
    }

    public function update()
    {
        $process = new Process('composer update');
        $process->setTimeout(3600);
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo '<pre>ERR > ' . $buffer . '</pre>';
            } else {
                echo '<pre>OUT > ' . $buffer . '</pre>';
            }
        });

        return $process;
    }

    public function requirePackage($package, $version)
    {
        $process = new Process('composer require ' . $package . ':' . $version);
        $process->setTimeout(3600);
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo '<pre>ERR > ' . $buffer . '</pre>';
            } else {
                echo '<pre>OUT > ' . $buffer . '</pre>';
            }
        });
        return $process;
    }

    public function removePackage($package)
    {
        $process = new Process('composer remove ' . $package);
        $process->setTimeout(3600);
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo '<pre>ERR > ' . $buffer . '</pre>';
            } else {
                echo '<pre>OUT > ' . $buffer . '</pre>';
            }
        });

        $this->update();
    }

}