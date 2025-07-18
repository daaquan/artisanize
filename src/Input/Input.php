<?php

namespace Artisanize\Input;

abstract class Input
{
    /**
     * Input.
     */
    protected string $input;

    /**
     * Original input string.
     */
    protected string $original;

    /**
     * Input name.
     */
    protected string $name;

    /**
     * Input description.
     */
    protected ?string $description = null;

    /**
     * Array of input modes to apply.
     */
    protected array $modeArray = [];

    /**
     * Argument mode.
     */
    protected int $mode = 0;

    /**
     * Construct.
     *
     * @param  string  $input
     */
    public function __construct($input)
    {
        $this->input = $input;
        $this->original = $input;
    }

    /**
     * Parse the set input string.
     *
     * @return $this
     */
    abstract public function parse(): static;

    /**
     * Get the input attributes.
     */
    abstract public function getAttributes(): array;

    /**
     * Set array modeArray value if value contains *.
     *
     *
     * @return $this
     */
    protected function setArray(string $constant): static
    {
        if (strpos($this->input, '*') !== false) {
            $this->modeArray[] = $constant;

            $this->input = str_replace('*', '', $this->input);
        }

        return $this;
    }

    /**
     * Parse an argument/option description.
     *
     * @return $this
     */
    protected function setDescription(): static
    {
        if (strpos($this->input, ':') !== false) {
            $inputArray = array_map('trim', explode(':', $this->input));

            $this->input = $inputArray[0];

            $this->description = $inputArray[1];
        }

        return $this;
    }

    /**
     * Calculate the mode score.
     *
     *
     * @return $this
     */
    protected function calculateMode(string $class): static
    {
        foreach ($this->modeArray as $constant) {
            $this->mode = $this->mode | constant($class.'::'.$constant);
        }

        return $this;
    }

    /**
     * Set the input name as the input value.
     *
     * @return $this
     */
    protected function setName(): static
    {
        $this->name = $this->input;

        return $this;
    }
}
