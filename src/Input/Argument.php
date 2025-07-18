<?php

namespace Artisanize\Input;

use Symfony\Component\Console\Input\InputArgument;

class Argument extends Input
{
    /**
     * Default arguement value.
     */
    protected ?string $default = null;

    /**
     * Parse the set argument string.
     *
     * @return $this
     */
    public function parse(): static
    {
        return $this->setDescription()
            ->setArray('IS_ARRAY')
            ->setOptional()
            ->setDefault()
            ->setRequired()
            ->calculateMode(InputArgument::class)
            ->setName();
    }

    /**
     * Set optional argument mode.
     *
     * @return $this
     */
    protected function setOptional(): static
    {
        if (substr($this->input, -1) === '?') {
            $this->modeArray[] = 'OPTIONAL';

            $this->input = str_replace('?', '', $this->input);
        }

        return $this;
    }

    /**
     * Set default option value.
     *
     * @return $this
     */
    protected function setDefault(): static
    {
        if (strpos($this->input, '=')) {
            [$this->input, $this->default] = explode('=', $this->input);

            $this->modeArray[] = 'OPTIONAL';
        }

        return $this;
    }

    /**
     * Set required mode if optional not already set.
     *
     * @return $this
     */
    protected function setRequired(): static
    {
        if (! in_array('OPTIONAL', $this->modeArray)) {
            $this->modeArray[] = 'REQUIRED';
        }

        return $this;
    }

    /**
     * Get the argument attributes.
     */
    public function getAttributes(): array
    {
        return [
            'name' => $this->name,
            'mode' => $this->mode,
            'description' => $this->description,
            'default' => $this->default,
        ];
    }
}
