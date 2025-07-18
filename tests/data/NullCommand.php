<?php

namespace Tests\data;

use Artisanize\Command;

class NullCommand extends Command
{
    protected ?string $name;

    protected string $description = '';

    protected array $options = [];

    protected array $arguments = [];

    public function __construct(?string $name = null)
    {
        $this->name = $name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function setDescription(string $description): static
    {
        return $this;
    }

    public function addArgument(string $name, ?int $mode = null, ?string $description = '', mixed $default = null, array|\Closure $suggestedValues = []): static
    {
        $this->arguments[] = [
            'name' => $name,
            'mode' => $mode,
            'description' => $description,
            'default' => $default,
        ];

        return $this;
    }

    public function addOption(string $name, string|array|null $shortcut = null, ?int $mode = null, ?string $description = '', mixed $default = null, array|\Closure $suggestedValues = []): static
    {
        $this->options[] = [
            'name' => $name,
            'shortcut' => $shortcut,
            'mode' => $mode,
            'description' => $description,
            'default' => $default,
        ];

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getOptions(): array
    {
        return $this->options;
    }
}
