# Filament Trustbird

Optional Filament admin panel for [Trustbird's Laravel core package](https://github.com/Trustbird/laravel-trustbird).

This package only contains Filament UI concerns. Domain logic, models, migrations, actions, events, policies and contracts belong in `trustbird/laravel-trustbird`.

## Installation

```bash
composer require trustbird/laravel-trustbird trustbird/filament-trustbird
```

Publish the configuration file when you want to customize the panel integration:

```bash
php artisan vendor:publish --tag="filament-trustbird-config"
```

## Usage

Register the plugin in your Filament panel provider:

```php
use Trustbird\Filament\TrustbirdPanelPlugin;

public function panel(Panel $panel): Panel
{
    return $panel
        ->plugin(TrustbirdPanelPlugin::make());
}
```

## Architecture

`trustbird/laravel-trustbird` is the headless Laravel core. This package is intentionally optional, so developers can use Trustbird with Filament or integrate the core into their own UI.

Keep these boundaries strict:

- Core package: domain models, migrations, services, actions, events, policies, contracts and APIs.
- Filament package: resources, pages, widgets, forms, tables, actions and panel registration.

## Testing

```bash
composer test
```

## Code style

```bash
composer format
```

## Security

Please review [SECURITY.md](SECURITY.md) for responsible disclosure details.

## License

The MIT License (MIT). Please see [LICENSE.md](LICENSE.md) for more information.
