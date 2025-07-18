<?php

namespace Artisanize;

use Artisanize\Input\Argument;
use Artisanize\Input\Option;

class SignatureParser
{
    /**
     * The command to build.
     */
    protected Command $command;

    /**
     * Construct.
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Parse the command signature.
     */
    public function parse(string $signature): void
    {
        $this->setName($signature);

        $argumentsOptions = $this->extractArgumentsOptions($signature);

        foreach ($argumentsOptions as $value) {
            if (substr($value, 0, 2) !== '--') {
                $input = new Argument($value);
            } else {
                $input = new Option(trim($value, '--'));
            }

            $this->command->addInput($input->parse());
        }
    }

    /**
     * Set the command name.
     */
    protected function setName(string $signature): void
    {
        $this->command->setName(preg_split('/\s+/', $signature)[0]);
    }

    /**
     * Extract arguments and options from signature.
     */
    protected function extractArgumentsOptions(string $signature): array
    {
        preg_match_all('/{(.*?)}/', $signature, $argumentsOption);

        return array_map(function ($item) {
            return trim($item, '{}');
        }, $argumentsOption[1]);
    }
}
