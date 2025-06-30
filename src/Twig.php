<?php

namespace Artisan\Services;

use Twig\Error\LoaderError;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class Twig
{
    private Environment $twig;

    /**
     * @throws LoaderError
     */
    public function __construct(string|array $paths, array $options = [])
    {
        $loader = new FilesystemLoader();

        // Puedes pasar una ruta o un array de rutas
        foreach ((array)$paths as $path) {
            $loader->addPath($path);
        }

        $this->twig = new Environment($loader, $options);
    }

    public function render(string $template, array $context = []): string
    {
        return $this->twig->render($template, $context);
    }

    public function getEnvironment(): Environment
    {
        return $this->twig;
    }
}
