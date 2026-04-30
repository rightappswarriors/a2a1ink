<?php

namespace App\Core;

use Exception;

class View 
{
    protected array $sections = [];
    protected ?string $layout = null;
    protected ?string $currentSection = null;

    public function extends(string $layout): void
    {
        $this->layout = $layout;
    }

    public function section(string $name): void
    {
        $this->currentSection = $name;
        ob_start();
    }

    public function endsection(): void
    {
        if (!$this->currentSection)
        {
            throw new Exception('No section started');
        }

        $this->sections[$this->currentSection] = ob_get_clean();
        $this->currentSection = null;
    }

    public function yield(string $name, string $default = ''): void
    {
        echo $this->sections[$name] ?? $default;
    }

    public function render(string $viewPage, array $data = []): void
    {
        extract($data);

        $view = $this;

        require __DIR__."/../../public/views/{$viewPage}.php";

        if ($this->layout)
        {
            require __DIR__."/../../public/views/{$this->layout}.php";
        }
    }

    public static function make(): self
    {
        return new self;
    }

}