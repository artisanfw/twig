# Twig
A lightweight wrapper for the Twig templating engine, designed for simplicity and modularity.

This service allows you to easily load one or more template directories and render views, particularly useful in modular projects where templates are distributed across multiple components.

## Install
```bash
composer require artisanfw/twig

```
## Load Global Configuration (Optional)
```php
$conf = [
    'paths' => [
        PROJECT_DIR . '/src/Shared/Templates',
        PROJECT_DIR . '/src/Emails/Templates',
    ],
    'options' => [
        'cache' => __DIR__ . '/../.cache/twig/',
        'debug' => true,
    ],
    'functions' => [
        Language::getTwigFunction(), // Optional Twig function from another service
    ]
];

\Artisan\Services\Twig::load($conf);
```
## Create a Twig renderer
```php
$twig = new \Artisan\Services\Twig();
```

### Configuration options
You can also pass a specific templates folder and environment options as arguments:
```php
$twig = new Twig(PROJECT_DIR . '/Accounts/Templates', ['cache' => '/tmp/twig_cache']);
```
* The provided template path will be added alongside the global template paths from the configuration.
* The options will be merged with the global ones. Any overlapping options will be overridden.

## Render a Template
```php
$content = $twig->render('registration.email.twig', [
    'username' => $user->getName(),
    'validation_url' => 'https://example.com/validate/' . $token,
]);
```

## Access the Raw Twig Environment (optional)
If needed, you can access Twig’s native Environment instance:
```php
$twig->getEnvironment()->addFilter(...);
$twig->getEnvironment()->addGlobal(...);
```
