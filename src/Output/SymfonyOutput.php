<?php

namespace Artisanize\Output;

use Symfony\Component\Console\Output\OutputInterface;

class SymfonyOutput extends Output
{
    /**
     * Symfony command output.
     */
    protected OutputInterface $output;

    /**
     * Construct.
     */
    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * Write a message.
     */
    public function write(string $message): void
    {
        if ($this->verbosity) {
            $this->output->writeln($message);
        }
    }

    /**
     * Get the Symfony output class.
     */
    public function getOutput(): OutputInterface
    {
        return $this->output;
    }
}
