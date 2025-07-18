<?php

namespace Artisanize\Output;

abstract class Output
{
    /**
     * Output verbosity.
     */
    protected bool $verbosity = true;

    /**
     * Write a message.
     */
    abstract public function write(string $message): void;

    /**
     * Write an info message.
     */
    public function writeInfo(string $message): void
    {
        $this->write("<info>{$message}</info>");
    }

    /**
     * Write an error message.
     */
    public function writeError(string $message): void
    {
        $this->write("<error>{$message}</error>");
    }

    /**
     * Write a comment message.
     */
    public function writeComment(string $message): void
    {
        $this->write("<comment>{$message}</comment>");
    }

    /**
     * Set the output verbosity.
     *
     *
     * @return $this
     */
    public function setVerbosity(bool $verbosity): static
    {
        $this->verbosity = $verbosity;

        return $this;
    }
}
