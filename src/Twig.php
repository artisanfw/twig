<?php

namespace Artisan\Services;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Twig
{
    private Environment $twig;

    /**
     * @throws LoaderError
     */
    public function __construct(string $path, array $options = [])
    {
        $loader = new FilesystemLoader();
        $loader->addPath($path);
        $this->twig = new Environment($loader, $options);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function render(string $template, array $context = []): string
    {
        return $this->twig->render($template, $context);
    }

    public function getEnvironment(): Environment
    {
        return $this->twig;
    }
}
