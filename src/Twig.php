<?php

namespace Artisan\Services;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class Twig
{
    private static array $globalPaths = [];
    private static array $globalOptions = [];
    private static array $globalFunctions = [];

    private Environment $twig;

    public static function load(array $config): void
    {
        self::$globalPaths = $config['paths'] ?? [];
        self::$globalOptions = $config['options'] ?? [];

        self::$globalFunctions = [];

        if (!empty($config['functions']) && is_array($config['functions'])) {
            foreach ($config['functions'] as $function) {
                if ($function instanceof \Twig\TwigFunction) {
                    self::$globalFunctions[] = $function;
                }
            }
        }
    }

    /**
     * @throws LoaderError
     */
    public function __construct(?string $path = null, array $options = [])
    {
        $loader = new FilesystemLoader();

        foreach (self::$globalPaths as $globalPath) {
            $loader->addPath($globalPath);
        }
        if ($path) {
            $loader->addPath($path);
        }

        $mergedOptions = array_merge(self::$globalOptions, $options);

        $this->twig = new Environment($loader, $mergedOptions);

        foreach (self::$globalFunctions as $function) {
            $this->twig->addFunction($function);
        }
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
