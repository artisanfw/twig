# Twig
A lightweight wrapper for the Twig templating engine, designed for simplicity and modularity.

This service allows you to easily load one or more template directories and render views, particularly useful in modular projects where templates are distributed across multiple components.

## Install
```bash
composer require twig/twig
```
## Instantiatting the Service
### Single path
```php
$twig = new Twig(PROJECT_DIR . '/src/templates');
```

### Multiple paths
```php
$twig = new Twig([
    PROJECT_DIR. '/src/templates',
    PROJECT_DIR. '/src/modules/accounts/templates',
]);
```

### Configuration options
You can also pass Twig configuration options as the second argument (e.g., enable caching):
```php
$twig = new Twig($paths, ['cache' => '/tmp/twig_cache']);
```

## Render a Template
```php
$content = $twig->render('registration.email.twig', [
    'username' => $user->getName(),
    'validation_url' => 'https://example.com/validate/' . $token,
]);
```

## Access the Raw Twig Environment (optional)
If needed, you can get direct access to Twig's native Environment instance:
```php
$twig->getEnvironment()->addFilter(...);
$twig->getEnvironment()->addGlobal(...);
```
