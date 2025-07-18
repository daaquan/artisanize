<?php

namespace Artisanize\Output;

class Logger extends Output
{
    /**
     * Log of received messages.
     */
    protected array $log = [];

    /**
     * Write a message.
     */
    public function write(string $message): void
    {
        if ($this->verbosity) {
            $this->log[] = $message;
        }
    }

    /**
     * Return the log array.
     */
    public function getLog(?int $index = null): array
    {
        if (is_null($index)) {
            return $this->log;
        }

        return $this->log[$index];
    }

    /**
     * Return true if log contains message.
     */
    public function hasMessage(string $message): bool
    {
        return in_array($message, $this->getLog());
    }

    /**
     * Clear the log.
     */
    public function clearLog(): void
    {
        $this->log = [];
    }
}
