<?php

namespace Artisanize\Input;

use Symfony\Component\Console\Input\InputOption;

class Option extends Input
{
    /**
     * Option shortcut.
     */
    protected ?string $shortcut = null;

    /**
     * Default option value.
     */
    protected ?string $default = null;

    /**
     * Parse the set input string.
     *
     * @return $this
     */
    public function parse(): static
    {
        return $this->setDescription()
            ->setArray('VALUE_IS_ARRAY')
            ->setValue()
            ->setEmptyMode()
            ->setShortcut()
            ->calculateMode(InputOption::class)
            ->setName();
    }

    /**
     * Parse option value and value default.
     *
     * @return $this
     */
    protected function setValue(): static
    {
        if (strpos($this->input, '=') !== false) {
            if (substr($this->input, -1) === '=') {
                $this->input = str_replace('=', '', $this->input);

                $this->modeArray[] = 'VALUE_REQUIRED';
            } else {
                [$this->input, $this->default] = explode('=', $this->input);

                $this->modeArray[] = 'VALUE_OPTIONAL';
            }
        }

        return $this;
    }

    /**
     * If mode is empty, set VALUE_NONE.
     *
     * @return $this
     */
    protected function setEmptyMode(): static
    {
        $this->modeArray = empty($this->modeArray) ? ['VALUE_NONE'] : $this->modeArray;

        return $this;
    }

    /**
     * Set option shortcut.
     *
     * @return $this
     */
    protected function setShortcut(): static
    {
        if (strpos($this->input, '|') !== false) {
            [$this->shortcut, $this->input] = explode('|', $this->input);
        }

        return $this;
    }

    /**
     * Get the option attributes.
     */
    public function getAttributes(): array
    {
        return [
            'name' => $this->name,
            'shortcut' => $this->shortcut,
            'mode' => $this->mode,
            'description' => $this->description,
            'default' => $this->default,
        ];
    }
}
